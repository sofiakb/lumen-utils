<?php
/**
 * This file contains CreateFileCommand class.
 * Created by PhpStorm.
 * User: Sofiakb <contact.sofiakb@gmail.com>
 * Date: 29/07/2021
 * Time: 13:31
 */


namespace Sofiakb\Lumen\Utils\Tools;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Sofiakb\Lumen\Utils\Tools\ClassFinder;
use Sofiakb\Lumen\Utils\Tools\CreateFileFromExample;
use Symfony\Component\Console\Input\InputOption;
use function Symfony\Component\Translation\t;

/**
 * Class CreateFileCommand
 * @package Sofiakb\Lumen\Utils\Console\Commands
 * @author Sofiakb <contact.sofiakb@gmail.com>
 */
class CreateFileCommand
{
    public static function run($name, $type, $callbacks)
    {
        $namespaceFragments = explode('\\', $name);
        
        $className = $namespaceFragments[count($namespaceFragments) - 1];
        unset($namespaceFragments[count($namespaceFragments) - 1]);
        
        $namespace = implode('\\', $namespaceFragments);
        
        if (($directory = ClassFinder::getNamespaceDirectory($namespace)) === false)
            throw new \Exception("Cannot find directory for namespace [$namespace]");
        
        File::ensureDirectoryExists($directory);
        
        $filepath = $directory . DIRECTORY_SEPARATOR . $className . ".php";
        
        CreateFileFromExample::$type($className, $namespace, $filepath, $callbacks);
        
        $callbacks['info'](ucfirst($type) . " successfully created : \n\t- Class --> $name\n\t- File --> $filepath");
    }
}
