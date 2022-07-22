<?php

/**
 * lumen-utils
 * This file contains Model class.
 *
 * Created by PhpStorm on 27/02/2022 at 17:31
 *
 * @author Sofiakb <contact.sofiakb@gmail.com>
 */

namespace Sofiakb\Lumen\Utils;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model as BaseModel;
use Illuminate\Support\Carbon;

/**
 * Class Model
 * @package Sofiakb\Lumen\Utils
 * @author Sofiakb <contact.sofiakb@gmail.com>
 *
 * @method static Builder|static newModelQuery()
 * @method static Builder|static newQuery()
 * @method static Builder|static query()
 * @method static void truncate()
 * @method static bool insert()
 * @mixin \Illuminate\Database\Query\Builder|Builder
 * @property int $id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Carbon|null $deleted_at
 *
 * @method static Builder|static where($param, $value = null)
 * @method static Builder|static whereId($value)
 * @method static Builder|static whereUpdatedAt($value)
 * @method static Builder|static whereCreatedAt($value)
 * @method static Builder|static whereDeletedAt($value)
 * @method static Builder|static create(array $array)
 * @method static Builder|static whereIn(string $column, mixed $values)
 * @method static int count()
 *
 * @see Model
 * @see Builder
 */
class Model extends BaseModel
{
    public static function findOneBy(string $column, $value)
    {
        return static::where($column, $value)->first();
    }

    public static function findById(int $id)
    {
        return static::findOneBy('id', $id);
    }
}