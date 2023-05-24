<?php

namespace App\Models;

use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int    $permissions_id
 * @property int    $created_at
 * @property int    $updated_at
 * @property string $name
 * @property string $email
 * @property string $type
 * @property string $role
 * @property string $password
 * @property string $remember_token
 */
class Users extends Authenticatable implements JWTSubject
{
    use Notifiable;
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

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
        'permissions_id', 'name', 'email', 'type', 'role', 'password', 'remember_token', 'created_at', 'updated_at'
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
        'permissions_id' => 'int', 'name' => 'string', 'email' => 'string', 'type' => 'string', 'role' => 'string', 'password' => 'string', 'remember_token' => 'string', 'created_at' => 'timestamp', 'updated_at' => 'timestamp'
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

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }
    
    public function getJWTCustomClaims()
    {
        return [];
    }

    public function client()
    {
        return $this->belongsTo('App\Models\Clients', 'client_id');
    }

    public function permissions()
    {
        return $this->belongsTo('App\Models\Permissions');
    }
    
    public function configs()
    {
        return $this->hasOne('App\Models\UserConfigs', 'user_id', 'id');
    }
}
