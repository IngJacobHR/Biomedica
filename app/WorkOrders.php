<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WorkOrders extends Model
{
    protected $fillable = [
        'id','campus_id','location','equipment_id',
        'active','serie', 'failures_id','description',
        'order','date_calendar','assigned','status',
        'autenti', 'date_execute','observation','evaluatión', 'update_at'
    ];

    public function campus()
    {
       return $this->belongsTo(Campus::class);
    }

    public function failures()
    {
       return $this->belongsTo(Failure::class);
    }

    public function equipment()
    {
       return $this->belongsTo(Equipment::class);
    }


}
