<?php
/**
 * This file contains LumenUtilsServiceProvider class.
 * Created by PhpStorm.
 * User: Sofiakb <contact.sofiak@gmail.com>
 * Date: 23/08/2021
 * Time: 12:04
 */

namespace Sofiakb\Lumen\Utils\Providers;

use Illuminate\Support\ServiceProvider;
use Sofiakb\Lumen\Utils\Console\Commands\AppNameCommand;
use Sofiakb\Lumen\Utils\Console\Commands\KeyGenerateCommand;
use Sofiakb\Lumen\Utils\Console\Commands\ServeCommand;
use Sofiakb\Lumen\Utils\Console\Commands\SetEnvCommand;

/**
 * Class LumenUtilsServiceProvider
 * @package Sofiakb\Lumen\Utils\Providers
 * @author Sofiakb <contact.sofiak@gmail.com>
 */
class LumenUtilsServiceProvider extends ServiceProvider
{
    
    public function boot()
    {
        if (!file_exists(app()->basePath() . DIRECTORY_SEPARATOR . 'server.php'))
            copy(__DIR__ . '/../server.php', app()->basePath() . DIRECTORY_SEPARATOR . 'server.php');
    }
    
    /**
     * Register Service Provider.
     *
     */
    public function register()
    {
        $commands = [
            'command.serve'        => new ServeCommand(),
            'command.key.generate' => new KeyGenerateCommand(),
            'command.app.name'     => new AppNameCommand(),
            'command.set.env'      => new SetEnvCommand(),
        ];
        
        foreach ($commands as $command => $singleton) {
            $this->app->singleton(
                $command,
                function ($app) use ($singleton) {
                    return $singleton;
                }
            );
        }
        
        $this->commands(array_keys($commands));
        
    }
    
}