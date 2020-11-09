<?php

namespace App;
use App\WorkOrders;
use App\Technology;

use Illuminate\Database\Eloquent\Model;

class Campus extends Model
{
    protected $fillable = [

        'id','name'
        ];
    public function workorders()
    {
       return $this->hasMany(WorkOrders::class);
    }

    public function technology()
    {
       return $this->hasMany(Technology::class);
    }

}

