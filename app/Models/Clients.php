<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int    $social_media_id
 * @property int    $permissions_id
 * @property int    $created_at
 * @property int    $updated_at
 * @property string $name
 * @property string $email
 * @property string $password
 * @property string $phone
 */
class Clients extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'clients';

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
        'social_media_id', 'permissions_id', 'name', 'email', 'password', 'phone', 'created_at', 'updated_at'
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
        'social_media_id' => 'int', 'permissions_id' => 'int', 'name' => 'string', 'email' => 'string', 'password' => 'string', 'phone' => 'string', 'created_at' => 'timestamp', 'updated_at' => 'timestamp'
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

    public function users()
    {
        return $this->hasMany('App\Models\Users', 'client_id', 'id');
    }
}
