<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Support extends Model
{
    protected $fillable = [
        'campus_id','frecuency','mant_calendar',
        'next_mant_calendar','mant_execute', 'state',
        'novelty','evaluation', 'items_id'
    ];

    public function campus()
    {
       return $this->belongsTo(Campus::class);
    }

    public function items()
    {
       return $this->belongsTo(Items_1::class);
    }

    public function scopeCampus_id($query,$campus_id)
    {
        if($campus_id)
            return $query->where('campus_id', 'LIKE', "$campus_id");
    }

    public function scopeItems_id($query,$items_id)
    {
        if($items_id)
            return $query->where('items_id', 'LIKE', "$items_id");
    }

    public function scopeState($query,$state)
    {
        if($state)
            return $query->where('state', 'LIKE', "$state");
    }

    protected $table = 'support';
}
