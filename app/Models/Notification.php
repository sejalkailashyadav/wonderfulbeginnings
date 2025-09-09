<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $table = 'notifications';
    protected $primaryKey = 'id';
    public $incrementing = false;   // because id is a UUID
    protected $keyType = 'string';  // UUID is string

    protected $fillable = [
        'id',
        'type',
        'notifiable_type',
        'notifiable_id',
        'data',
        'detailUrl',
        'read_at',
    ];

    protected $casts = [
        'data' => 'array',       // json decode automatically
        'read_at' => 'datetime',
    ];
}

