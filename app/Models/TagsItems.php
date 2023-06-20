<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $client_id
 * @property string $entity
 * @property integer $entity_id
 * @property integer $tag_id
 * @property int    $created_at
 * @property int    $updated_at
 */
class TagsItems extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'tags_items';

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
    protected $fillable = ['client_id', 'entity', 'entity_id', 'tag_id', 'created_at', 'updated_at'];

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
        'client_id' => 'integer', 'entity' => 'string', 'entity_id' => 'integer', 'tag_id' => 'integer', 'created_at' => 'timestamp', 'updated_at' => 'timestamp'
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

    public function tag() {
        return $this->hasOne('App\Models\Tags', 'id', 'tag_id');
    }
}
