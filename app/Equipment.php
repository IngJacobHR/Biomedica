<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Equipment extends Model
{
    protected $fillable = [

        'id','name','class',
        'category','powersupply',
        'description', 'desinfectant',
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

