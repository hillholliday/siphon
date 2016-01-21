<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class Feed extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'feeds';

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];

    public function network()
    {
        return $this->belongsTo('App\Network');
    }

    public function tags()
    {
        return $this->hasMany('App\Tag');
    }
}
