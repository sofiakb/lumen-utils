<?php
/**
 * Created by PhpStorm.
 * User: Sofiakb <contact.sofiakb@gmail.com>
 * Date: 18/03/2021
 * Time: 09:49
 */

namespace Sofiakb\Lumen\Utils\Console\Commands;

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Str;
use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;

/**
 * Class KeyGenerateCommand
 * @package Sofiakb\Lumen\Utils\Console\Commands
 * @author Sofiakb <contact.sofiak@gmail.com>
 */
class KeyGenerateCommand extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'key:generate';
    
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = "Set the application key";
    
    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        if ($this->option('show')) {
            return $this->line('<comment>' . env('APP_KEY') . '</comment>');
        }
        
        $key = $this->getRandomKey();
        
        
        Artisan::call('set:env', ['--name' => 'APP_KEY', '--value' => $key]);
        
        // $path = base_path('.env');
        //
        // if (file_exists($path)) {
        //     file_put_contents(
        //         $path,
        //         str_replace('APP_KEY=' . env('APP_KEY'), 'APP_KEY=' . $key, file_get_contents($path))
        //     );
        // }
        //
        // $this->info("Application key [$key] set successfully.");
    }
    
    /**
     * Generate a random key for the application.
     *
     * @return string
     */
    protected function getRandomKey()
    {
        return Str::random(32);
    }
    
    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return array(
            array('show', null, InputOption::VALUE_NONE, 'Simply display the key instead of modifying files.'),
        );
    }
}
