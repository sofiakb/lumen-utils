<?php
/**
 * This file contains AppNameCommand class.
 * Created by PhpStorm.
 * User: Sofiakb <contact.sofiakb@gmail.com>
 * Date: 29/07/2021
 * Time: 13:31
 */

namespace Sofiakb\Lumen\Utils\Console\Commands;

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Str;
use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;

/**
 * Class AppNameCommand
 * @package Sofiakb\Lumen\Utils\Console\Commands
 * @author Sofiakb <contact.sofiak@gmail.com>
 */
class AppNameCommand extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'app:name';
    
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = "Set the application name";
    
    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        if ($this->option('show')) {
            return $this->line('<comment>' . env('APP_NAME') . '</comment>');
        }
        
        Artisan::call('set:env', ['--name' => 'APP_NAME', '--value' => $this->option('name')]);
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
