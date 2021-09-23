<?php
/**
 * This file contains ExampleController class.
 * @author Sofiakb <contact.sofiak@gmail.com>
 * Created by PhpStorm on HEADER_FILE_DATE at HEADER_FILE_TIME
 */

namespace EXAMPLE_NAMESPACE;

use Sofiakb\Lumen\Utils\Http\Controllers\Controller;
use Sofiakb\Lumen\Utils\Tools\ClassFinder;

class ExampleController extends Controller
{
    public function __construct(string $serviceClass = 'Service')
    {
        $serviceClass = Service::class;
        parent::__construct($serviceClass);
        
        $this->setModelNamespace(ClassFinder::namespace(Model::class));
    }
}