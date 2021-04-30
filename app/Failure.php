<?php

namespace App;

use App\WorkOrders;

use Illuminate\Database\Eloquent\Model;

class Failure extends Model
{
    protected $fillable = [

        'id','name'
        ];
        
    public function workorders()
    {
       return $this->hasMany(WorkOrders::class);
    }
}
