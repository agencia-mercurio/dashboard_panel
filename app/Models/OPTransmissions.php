<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OPTransmissions extends Model
{
    protected $table = 'op_transmissions';

    protected $primaryKey = 'id';

    protected $fillable = [
        'external_id', 'uuid', 'name', 'funeral_place', 'public', 'login', 'password', 'room_password', 'country_id', 'country',
        'state_id', 'state', 'city', 'event', 'birth_date', 'death_date', 'start_transmission',
        'end_transmission', 'event_place', 'start_event'
    ];

    protected $hidden = [];

    protected $casts = [
        'external_id' => 'integer',
        'uuid' => 'integer',
        'birth_date' => 'timestamp',
        'death_date' => 'timestamp',
        'start_transmission' => 'timestamp',
        'end_transmission' => 'timestamp',
        'start_event' => 'timestamp',
    ];

    protected $dates = [
        'birth_date', 'death_date', 'start_transmission', 'end_transmission', 'start_event'
    ];

    public $timestamps = true;
}