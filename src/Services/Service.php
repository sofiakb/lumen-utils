<?php
/**
 * This file contains Service class.
 * Created by PhpStorm.
 * User: Sofiakb <contact.sofiakb@gmail.com>
 * Date: 18/08/2021
 * Time: 14:27
 */

namespace Sofiakb\Lumen\Utils\Services;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;
use Sofiakb\Utils\Result\Error;
use Sofiakb\Utils\Result\Result;
use Sofiakb\Utils\Result\Success;

/**
 * Class Service
 * @package Sofiakb\Lumen\Utils\Services
 * @author Sofiakb <contact.sofiakb@gmail.com>
 */
class Service
{
    /**
     * @var string
     */
    public string $namespace = '';
    /**
     * @var string
     */
    public string $model = '';
    
    /**
     * @return mixed
     */
    public function all()
    {
        return $this->model::all();
    }
    
    /**
     * @param $id
     * @return mixed
     */
    public function findById($id)
    {
        return $this->model::whereId($id)->first();
    }
    
    /**
     * @param string $column
     * @param $value
     * @return mixed
     */
    public function findBy(string $column, $value)
    {
        return $this->model::where($column, $value)->get();
    }
    
    /**
     * @param $data
     * @return mixed
     */
    public function store($data)
    {
        try {
            return Result::success($this->model::create((array)$data), 201);
        }
        catch (\Exception $e) {
            return Result::error($e->getMessage());
        }
    }
    
    /**
     * @param $id
     * @param $data
     * @return mixed
     */
    public function update($id, $data)
    {
        return $this->updateBy('id', $id, $data);
    }
    
    /**
     * @param string $column
     * @param $value
     * @param $data
     * @return array|Error|Success
     */
    public function updateBy(string $column, $value, $data)
    {
        try {
            $this->model::where($column, $value)->update((array)$data);
            return Result::success(true);
        }
        catch (\Exception $e) {
            return Result::error($e->getMessage());
        }
    }
    
    /**
     * @param $id
     * @param $data
     * @return mixed
     */
    public function destroy($id)
    {
        return $this->destroy('id', $id);
    }
    
    /**
     * @param string $column
     * @param $value
     * @param $data
     * @return array|Error|Success
     */
    public function destroyBy(string $column, $value)
    {
        try {
            $this->model::where($column, $value)->delete();
            return Result::success(true);
        }
        catch (\Exception $e) {
            return Result::error($e->getMessage());
        }
    }
    
    /**
     * @param $query
     * @return mixed
     */
    public function search($query)
    {
        $model = $this->model;
        $object = new $model;
        
        $columns = $object->searchable ?? Schema::connection($object->getConnectionName())->getColumnListing($object->getTable());
        
        $query = "%$query%";
        $queryBD = $model::where($columns[0], 'LIKE', $query);
        
        foreach ($columns as $column)
            $queryBD->orWhere($column, 'LIKE', $query);
        
        return $queryBD->get();
    }
    
    public function paginate($page, $limit)
    {
        $total = $this->model::count();
        $last = ceil($total / $limit);
        $page = (int)$page - 1;
        $limit = (int)$limit;
        
        return [
            'page'   => (int)$page + 1,
            'data'   => $this->model::offset($page * $limit)->limit($limit)->get(),
            'first'  => 0,
            'latest' => $last,
            'per'    => (int)$limit,
            'prev'   => $page <= 0 ? null : $page,
            'next'   => $page + 1 >= $last ? null : $page + 2,
            'total'  => $total
        ];
    }
    
    /*private function model(string $name)
    {
        return $this->namespace . ucfirst(Str::singular(Str::camel($name)));
    }*/
    
    /**
     * @param string $namespace
     */
    public function setNamespace(string $namespace)
    {
        $this->namespace = $namespace;
    }
    
    /**
     * @param string $model
     */
    public function setModel(string $model)
    {
        $this->model = $model;
    }
}
