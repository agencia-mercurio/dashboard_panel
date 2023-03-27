<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int    $client_id
 * @property int    $active
 * @property int    $created_at
 * @property int    $updated_at
 * @property string $key
 * @property string $desktop
 * @property string $mobile
 * @property string $dimensions
 * @property string $alt
 */
class WebsiteImages extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'website_images';

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
        'client_id', 'key', 'desktop', 'mobile', 'dimensions', 'alt', 'active', 'created_at', 'updated_at'
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
        'client_id' => 'int', 'key' => 'string', 'desktop' => 'string', 'mobile' => 'string', 'dimensions' => 'string', 'alt' => 'string', 'active' => 'int', 'created_at' => 'timestamp', 'updated_at' => 'timestamp'
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
