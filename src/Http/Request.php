<?php

namespace Sofiakb\Lumen\Utils\Http;

/**
 * This file contains Request class.
 * Created by PhpStorm.
 * User: Sofiakb <contact.sofiakb@gmail.com>
 * Date: 23/08/2021
 * Time: 11:46
 */
class Request
{
    
    /**
     * @param string $param
     * @return mixed|\stdClass
     */
    public static function body(string $param = 'data')
    {
        return json_decode(json_encode($param ? request()->get($param) : request()->all()));
    }
    
}