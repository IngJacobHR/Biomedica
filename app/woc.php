<?php

namespace App;
use App\WorkOrders;

use Illuminate\Database\Eloquent\Model;

class woc extends Model
{

    protected $fillable = [
        'work_orders_id'
    ];

    public function workorders()
    {
       return $this->belongsTo(WorkOrders::class);
    }
}
