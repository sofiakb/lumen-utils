<?php
/**
 * This file contains CreateModelCommand class.
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
 * Class CreateModelCommand
 * @package Sofiakb\Lumen\Utils\Console\Commands
 * @author Sofiakb <contact.sofiakb@gmail.com>
 */
class CreateModelCommand extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'create:model';
    
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = "Create new model class";
    
    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        CreateFileCommand::run($this->option('name'), 'model', ['info' => [$this, 'info'], 'warning' => [$this, 'warn'], 'error' => [$this, 'error'], 'askWithCompletion' => [$this, 'askWithCompletion']]);
    }
    
    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return array(
            array('name', null, InputOption::VALUE_REQUIRED, 'Name of the model (with namespace)'),
        );
    }
}
