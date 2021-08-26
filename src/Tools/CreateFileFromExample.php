<?php
/**
 * This file contains CreateFileFromExample class.
 * Created by PhpStorm.
 * User: Sofiakb <contact.sofiak@gmail.com>
 * Date: 26/08/2021
 * Time: 15:09
 */

namespace Sofiakb\Lumen\Utils\Tools;

use Carbon\Carbon;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class CreateFileFromExample
{
    
    public static function run($className, $namespace, $example, $filepath, $exampleName, $callbacks)
    {
        if (File::exists($filepath)) {
            $callbacks['warning']("File $filepath already exists");
            
            $answer = strtolower($callbacks['askWithCompletion']('Do you want to overwrite it ? (Y/n)', ['yes', 'no']));
            
            if ($answer !== 'y' && $answer !== 'o' && $answer !== 'yes' && $answer !== 'oui'){
                $callbacks['error']('aborted');
                die();
            }
        }
        
        File::copy(implode(DIRECTORY_SEPARATOR, $example), $filepath);
        
        return File::put(
            $filepath,
            Str::replace([$exampleName, 'EXAMPLE_NAMESPACE', 'HEADER_FILE_DATE', 'HEADER_FILE_TIME'], [$className, $namespace, Carbon::now()->format('d/m/Y'), Carbon::now()->format('H:i')], File::get($filepath))
        );
    }
    
    public static function service($className, $namespace, $filepath, $callbacks)
    {
        return self::run($className, $namespace, [__DIR__, '..', 'Services', 'ExampleService.php'], $filepath, 'ExampleService', $callbacks);
    }
    
    public static function controller($className, $namespace, $filepath, $callbacks)
    {
        return self::run($className, $namespace, [__DIR__, '..', 'Http', 'Controllers', 'ExampleController.php'], $filepath, 'ExampleController', $callbacks);
    }
    
}