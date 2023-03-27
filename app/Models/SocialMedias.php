<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property string $entity
 * @property string $name
 * @property string $username
 * @property string $url
 * @property int    $id_entity
 * @property int    $created_at
 * @property int    $updated_at
 */
class SocialMedias extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'social_medias';

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
        'entity', 'id_entity', 'name', 'username', 'url', 'created_at', 'updated_at'
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
        'entity' => 'string', 'id_entity' => 'int', 'name' => 'string', 'username' => 'string', 'url' => 'string', 'created_at' => 'timestamp', 'updated_at' => 'timestamp'
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
