<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Locative extends Model
{
    protected $fillable = [
        'id','campus_id','location','groups_id',
        'active','serie', 'fails_id','description',
        'order','date_calendar','assigned','status',
        'autenti', 'date_execute','observation','evaluatión'
    ];

    public function campus()
    {
       return $this->belongsTo(Campus::class);
    }

    public function locativefails()
    {
       return $this->belongsTo(Locativefail::class);
    }

    public function locativegroup()
    {
       return $this->belongsTo(Locativegroup::class);
    }
}
