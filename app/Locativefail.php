<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Locativefail extends Model
{
    protected $fillable = [

        'id','name'
        ];
    public function Locative()
    {
       return $this->hasMany(Locative::class);
    }
}
