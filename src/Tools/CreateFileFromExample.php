<?php
/**
 * This file contains CreateFileFromExample class.
 * Created by PhpStorm.
 * User: Sofiakb <contact.sofiak@gmail.com>
 * Date: 26/08/2021
 * Time: 15:09
 */

namespace Sofiakb\Lumen\Utils\Tools;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class CreateFileFromExample
{
    
    public static function run($className, $namespace, $example, $filepath, $exampleName)
    {
        File::copy(implode(DIRECTORY_SEPARATOR, $example), $filepath);
        
        return File::put(
            $filepath,
            Str::replace([$exampleName, 'EXAMPLE_NAMESPACE'], [$className, $namespace], File::get($filepath))
        );
    }
    
    public static function service($className, $namespace, $filepath)
    {
        return self::run($className, $namespace, [__DIR__, '..', 'Services', 'ExampleService.php'], $filepath, 'ExampleService');
    }
    
    public static function controller($className, $namespace, $filepath)
    {
        return self::run($className, $namespace, [__DIR__, '..', 'Http', 'Controllers', 'ExampleController.php'], $filepath, 'ExampleController');
    }
    
}