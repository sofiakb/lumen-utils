<?php
/**
 * This file contains ExampleController class.
 *
 * Created by PhpStorm on HEADER_FILE_DATE at HEADER_FILE_TIME
 *
 * @author Sofiakb <contact.sofiak@gmail.com>
 */

namespace EXAMPLE_NAMESPACE;

use Sofiakb\Lumen\Utils\Http\Controllers\Controller;
use Sofiakb\Lumen\Utils\Tools\ClassFinder;

/**
 * Class ExampleController
 *
 * @property ExampleService $service
 *
 * @package EXAMPLE_NAMESPACE
 * @author Sofiakb <contact.sofiak@gmail.com>
 */
class ExampleController extends Controller
{
    /**
     * ExampleController constructor.
     */
    public function __construct()
    {
        $serviceClass = ExampleService::class;
        parent::__construct($serviceClass);
        
        $this->setModelNamespace(ClassFinder::namespace(Model::class));
    }
}