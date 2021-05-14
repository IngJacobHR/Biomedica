<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Technology extends Model
{
    protected $fillable = [
        'id','active', 'serie', 
        'equipment_id','mark','model',
        'location','campus_id','risk',
        'url_document', 'date_mant','date_cal',
         'next_mant','next_cal', 'supplier',
         'date_warranty','date_in','value','service'
    ];


    public function equipment()
    {
       return $this->belongsTo(Equipment::class);
    }

    public function campus()
    {
       return $this->belongsTo(Campus::class);
    }

    public function scopeActive($query,$active)
    {
        if($active)
            return $query->where('active', 'LIKE', "%$active%");
    }

    public function scopeSerie($query,$serie)
    {
        if($serie)
            return $query->where('serie', 'LIKE', "%$serie%");
    }
}
