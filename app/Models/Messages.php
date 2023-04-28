<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int    $client_id
 * @property int    $viewed_at
 * @property int    $created_at
 * @property int    $updated_at
 * @property string $email
 */
class Messages extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'messages';

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
        'client_id', 'email', 'viewed_at', 'created_at', 'updated_at'
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
        'client_id' => 'int', 'email' => 'string', 'viewed_at' => 'timestamp', 'created_at' => 'timestamp', 'updated_at' => 'timestamp'
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'viewed_at', 'created_at', 'updated_at'
    ];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var boolean
     */
    public $timestamps = true;

    public function items()
    {
        return $this->hasMany('App\Models\MessageItems', 'message_id', 'id');
    }

    // Scopes...

    // Functions ...

    // Relations ...
}
