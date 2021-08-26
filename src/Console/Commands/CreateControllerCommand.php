<?php
/**
 * This file contains CreateControllerCommand class.
 * Created by PhpStorm.
 * User: Sofiakb <contact.sofiakb@gmail.com>
 * Date: 29/07/2021
 * Time: 13:31
 */


namespace Sofiakb\Lumen\Utils\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Sofiakb\Lumen\Utils\Tools\ClassFinder;
use Sofiakb\Lumen\Utils\Tools\CreateFileCommand;
use Sofiakb\Lumen\Utils\Tools\CreateFileFromExample;
use Symfony\Component\Console\Input\InputOption;

/**
 * Class CreateControllerCommand
 * @package Sofiakb\Lumen\Utils\Console\Commands
 * @author Sofiakb <contact.sofiak@gmail.com>
 */
class CreateControllerCommand extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'create:controller';
    
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = "Create new controller class";
    
    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        CreateFileCommand::run($this->option('name'), 'controller', [$this, 'info']);
    }
    
    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return array(
            array('name', null, InputOption::VALUE_REQUIRED, 'Name of the controller (with namespace)'),
        );
    }
}
