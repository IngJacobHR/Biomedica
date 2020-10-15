<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Technology extends Model
{
    protected $fillable = [
        'active', 'serie', 'name','mark','model','location','campus','category','url_document'
    ];

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

    public function scopeCampus($query,$campus)
    {
        if($campus)
            return $query->where('campus', 'LIKE', "%$campus%");
    }
}
