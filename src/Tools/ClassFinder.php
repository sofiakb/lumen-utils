<?php
/**
 * This file contains ClassFinder class.
 * Created by PhpStorm.
 * User: Sofiakb <contact.sofiakb@gmail.com>
 * Date: 26/08/2021
 * Time: 14:29
 */

namespace Sofiakb\Lumen\Utils\Tools;

class ClassFinder
{
    public static function getClassesInNamespace($namespace)
    {
        $files = scandir(self::getNamespaceDirectory($namespace));
        
        $classes = array_map(function ($file) use ($namespace) {
            return $namespace . '\\' . str_replace('.php', '', $file);
        }, $files);
        
        return array_filter($classes, function ($possibleClass) {
            return class_exists($possibleClass);
        });
    }
    
    private static function getDefinedNamespaces()
    {
        $composerJsonPath = app()->basePath() . DIRECTORY_SEPARATOR . 'composer.json';
        $composerConfig = json_decode(file_get_contents($composerJsonPath));
        
        return (array)$composerConfig->autoload->{'psr-4'};
    }
    
    public static function getNamespaceDirectory($namespace)
    {
        $composerNamespaces = self::getDefinedNamespaces();
        
        $namespaceFragments = explode('\\', $namespace);
        $undefinedNamespaceFragments = [];
        
        while ($namespaceFragments) {
            $possibleNamespace = implode('\\', $namespaceFragments) . '\\';
            
            if (array_key_exists($possibleNamespace, $composerNamespaces)) {
                return app()->basePath() . DIRECTORY_SEPARATOR . $composerNamespaces[$possibleNamespace] . implode('/', $undefinedNamespaceFragments);
            }
            
            array_unshift($undefinedNamespaceFragments, array_pop($namespaceFragments));
        }
        
        return false;
    }
    
    public static function namespace($className)
    {
        $namespaceFragments = explode('\\', $className);
        
        unset($namespaceFragments[count($namespaceFragments) - 1]);
        
        return implode('\\', $namespaceFragments);
    }
}