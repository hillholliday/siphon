<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class Network extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'networks';

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];

    public function feeds()
    {
        return $this->hasOne('App\Tag');
    }
}
