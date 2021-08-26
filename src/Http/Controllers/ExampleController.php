<?php
/**
 * This file contains ExampleController class.
 * Created by PhpStorm.
 * User: Sofiakb <contact.sofiak@gmail.com>
 * Date: HEADER_FILE_DATE
 * Time: HEADER_FILE_TIME
 */

namespace EXAMPLE_NAMESPACE;

use Sofiakb\Lumen\Utils\Http\Controllers\Controller;

class ExampleController extends Controller
{
    public function __construct(string $serviceClass = 'Service')
    {
        $serviceClass = Service::class;
        $this->setModelNamespace('\\Namespace\\To\\Models\\');
        
        parent::__construct($serviceClass);
    }
}