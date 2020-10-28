<?php

namespace App;

use App\Campus;
use App\Failure;

use Illuminate\Database\Eloquent\Model;

class WorkOrders extends Model
{
    public function campus()
    {
       return $this->belongsTo(Campus::class);
    }

    public function failurus()
    {
       return $this->belongsTo(Failure::class);
    }

}
