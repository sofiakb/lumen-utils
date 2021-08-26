<?php
/**
 * This file contains Controller class.
 * Created by PhpStorm.
 * User: Sofiakb <contact.sofiakb@gmail.com>
 * Date: 18/08/2021
 * Time: 14:27
 */

namespace Sofiakb\Lumen\Utils\Http\Controllers;

use Illuminate\Support\Str;
use Laravel\Lumen\Routing\Controller as LumenController;
use Sofiakb\Lumen\Utils\Http\Request;
use Sofiakb\Lumen\Utils\Services\Service;
use Sofiakb\Utils\Response;
use Sofiakb\Utils\Result\Result;

/**
 * Class Controller
 * @package Sofiakb\Lumen\Utils\Http\Controllers
 * @author Sofiakb <contact.sofiak@gmail.com>
 */
class Controller extends LumenController
{
    
    /**
     * @var Service|mixed
     */
    public Service $service;
    
    /**
     * @var string
     */
    public string $namespace;
    
    /**
     * @var string
     */
    public string $model;
    
    /**
     * @var string
     */
    public string $controllerName;
    
    /**
     * @param string $serviceClass
     */
    public function __construct(string $serviceClass = 'Service')
    {
        $this->service = new $serviceClass;
        $this->controllerName = str_replace('Controller', '', get_class($this));
    }
    
    /**
     * @param string $namespace
     */
    public function setModelNamespace(string $namespace)
    {
        $this->namespace = $namespace;
        $this->setModel();
        $this->service->setNamespace($namespace);
    }
    
    /**
     * @param string|null $controllerName
     */
    public function setModel(?string $controllerName = null)
    {
        $this->model = $this->namespace . ucfirst(Str::singular(Str::camel($controllerName ?? $this->controllerName)));
        $this->service->setModel($this->model);
    }
    
    /**
     * @param string $table
     * @return mixed|string
     */
    public function all()
    {
        return Response::unknown($this->service->all());
    }
    
    /**
     * @param string $table
     * @param $id
     * @return mixed|string
     */
    public function findById($id)
    {
        return Response::unknown($this->service->findById($id));
    }
    
    /**
     * @param string $table
     * @param string $column
     * @param $id
     * @return mixed|string
     */
    public function findBy(string $column, $id)
    {
        return Response::unknown($this->service->findBy($column, $id));
    }
    
    /**
     * @return mixed|string
     */
    public function store()
    {
        if (($body = Request::body()) === null)
            return Response::unknown(Result::badRequest());
        unset($body->updated_at);
        unset($body->created_at);
        return Response::unknown($this->service->store($body));
    }
    
    /**
     * @param $id
     * @return mixed|string
     */
    public function update($id)
    {
        if (($body = Request::body()) === null)
            return Response::unknown(Result::badRequest());
        unset($body->updated_at);
        unset($body->created_at);
        return Response::unknown($this->service->update($id, $body));
    }
    
    /**
     * @param $column
     * @param $id
     * @return mixed|string
     */
    public function updateBy($column, $value)
    {
        if (($body = Request::body()) === null)
            return Response::unknown(Result::badRequest());
        unset($body->updated_at);
        unset($body->created_at);
        return Response::unknown($this->service->updateBy($column, $value, $body));
    }
    
    /**
     * @param string $table
     * @return mixed|string
     */
    public function search()
    {
        if (($body = Request::body()) === null || ($query = $body->query) === null || trim($query) === '')
            return Response::unknown(Result::badRequest());
        
        return Response::unknown($this->service->search($query));
    }
    
    public function paginate($page)
    {
        return Response::unknown($this->service->paginate($page, \request()->input('limit') ?? 15));
    }
    
}
