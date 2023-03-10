<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sense extends Model
{
    use HasFactory;

    protected $table = 'senses';
    protected $fillable = [
        'name',
        'val',
        'event',
        'date',
        'min',
        'max',
        'description',
        'type',
        'email1',
        'email2',
    ];

    protected $dispatchesEvents = [
        'created' => SenseCreated::class,
    ];


}
