<?php
/**
 * This file contains CreateServiceCommand class.
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
 * Class CreateServiceCommand
 * @package Sofiakb\Lumen\Utils\Console\Commands
 * @author Sofiakb <contact.sofiak@gmail.com>
 */
class CreateServiceCommand extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'create:service';
    
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = "Create new service class";
    
    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        CreateFileCommand::run($this->option('name'), 'service', ['info' => [$this, 'info'], 'warning' => [$this, 'warn'], 'error' => [$this, 'error'], 'askWithCompletion' => [$this, 'askWithCompletion']]);
    }
    
    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return array(
            array('name', null, InputOption::VALUE_REQUIRED, 'Name of the service (with namespace)'),
        );
    }
}
