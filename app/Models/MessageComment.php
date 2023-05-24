<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $message_id
 * @property int $user_id
 * @property string $comment
 * @property int    $created_at
 * @property int    $updated_at
 */
class MessageComment extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'message_comment';

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
    protected $fillable = [ 'message_id', 'user_id', 'comment', 'created_at', 'updated_at' ];

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

      

    protected $casts = [ 'message_id' => 'int', 'user_id' => 'int', 'comment' => 'string', 'created_at' => 'timestamp', 'updated_at' => 'timestamp' ];

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


    public function events()
    {
        return $this->hasMany('App\Models\MessageCommentEvents', 'uuid', 'uuid');
    }
    public function user()
    {
        return $this->belongsTo('App\Models\Users', 'user_id')->with('configs');
    }

    // Scopes...

    // Functions ...

    // Relations ...
}
