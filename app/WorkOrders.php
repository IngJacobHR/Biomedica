<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WorkOrders extends Model
{
    protected $fillable = [
        'id','campus_id','location','equipment_id',
        'active','serie', 'failures_id','description',
        'order','date_calendar','assigned','status',
        'username', 'date_execute','date_novelty',
        'observation','evaluation','report','commentary',
        'date_evaluation','correction',
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

    public function scopeStatus($query,$status)
    {
        if($status)
            return $query->where('status', 'LIKE', "$status");
    }


}
