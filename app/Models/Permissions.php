<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $ewt
 * @property int $ewi
 * @property int $ews
 * @property int $vwt
 * @property int $vwi
 * @property int $vws
 * @property int $vwm
 * @property int $reply_wm
 * @property int $folders_scheme
 * @property int $created_at
 * @property int $updated_at
 */
class Permissions extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'permissions';

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
        'ewt', 'ewi', 'ews', 'vwt', 'vwi', 'vws', 'vwm', 'reply_wm', 'folders_scheme', 'created_at', 'updated_at'
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
        'ewt' => 'int', 'ewi' => 'int', 'ews' => 'int', 'vwt' => 'int', 'vwi' => 'int', 'vws' => 'int', 'vwm' => 'int', 'reply_wm' => 'int', 'folders_scheme' => 'int', 'created_at' => 'timestamp', 'updated_at' => 'timestamp'
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'created_at', 'updated_at'
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
