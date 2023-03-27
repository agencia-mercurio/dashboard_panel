<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int    $folder_id
 * @property int    $id_entity
 * @property int    $soft_delete
 * @property int    $created_at
 * @property string $entity
 */
class FolderItems extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'folder_items';

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
        'folder_id', 'entity', 'id_entity', 'soft_delete', 'created_at'
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
        'folder_id' => 'int', 'entity' => 'string', 'id_entity' => 'int', 'soft_delete' => 'int', 'created_at' => 'timestamp'
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
