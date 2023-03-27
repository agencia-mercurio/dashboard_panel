<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int    $user_id
 * @property int    $client_id
 * @property int    $created_at
 * @property string $context
 * @property string $action
 * @property string $description
 * @property string $error
 * @property float  $duration
 */
class DashboardLogs extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'dashboard_logs';

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
        'user_id', 'client_id', 'context', 'action', 'description', 'duration', 'error', 'created_at'
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
        'user_id' => 'int', 'client_id' => 'int', 'context' => 'string', 'action' => 'string', 'description' => 'string', 'duration' => 'double', 'error' => 'string', 'created_at' => 'timestamp'
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
