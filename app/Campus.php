<?php

namespace App;
use App\WorkOrders;

use Illuminate\Database\Eloquent\Model;

class Campus extends Model
{
    public function workorders()
    {
       return $this->hasMany(WorkOrders::class);
    }

}

