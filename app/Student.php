<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    //数据库表名
    protected $table = 'content';

    public function comments()
    {
        return $this->hasMany('App\comment','cont_id','id');
    }
}
