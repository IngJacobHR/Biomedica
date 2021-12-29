<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Locative extends Model
{
    protected $fillable = [
        'id','campus_id','location','locativegroups_id',
        'active','serie', 'locativefails_id','description',
        'order','date_calendar','assigned','status',
        'username', 'date_execute','date_novelty',
        'observation','evaluation','report','commentary',
        'date_evaluation','correction'
    ];

    public function campus()
    {
       return $this->belongsTo(Campus::class);
    }

    public function locativefails()
    {
       return $this->belongsTo(Locativefail::class);
    }

    public function locativegroups()
    {
       return $this->belongsTo(Locativegroup::class);
    }

    public function scopeStatus($query,$status)
    {
        if($status)
            return $query->where('status', 'LIKE', "$status");
    }

    public function scopeDescription($query,$description)
    {
        if($description)
            return $query->where('description', 'LIKE', "%$description%");
    }

    public function scopeCampus_id($query,$campus_id)
    {
        if($campus_id)
            return $query->where('campus_id', 'LIKE', "$campus_id");
    }
}
