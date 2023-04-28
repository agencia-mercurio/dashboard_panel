<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int    $message_id
 * @property int    $created_at
 * @property string $key
 * @property string $value
 */
class MessageItems extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'message_items';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = [
        'message_id', 'key', 'value', 'created_at'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'message_id' => 'int', 'key' => 'string', 'value' => 'string', 'created_at' => 'timestamp'
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'created_at'
    ];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var boolean
     */
    public $timestamps = true;
    

    // Scopes...

    // Functions ...

    // Relations ...
}
