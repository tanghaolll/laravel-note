<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/1/30 0030
 * Time: 15:52
 */

namespace App;
use Illuminate\Database\Eloquent\Model as BaseModel;

class Model extends BaseModel
{
    // protected  $fillable;  //允许插入的字段名
    protected  $guarded = []; //不许插入的字段名
}