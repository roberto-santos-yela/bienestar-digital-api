<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class App extends Model
{
    protected $table = 'apps';
    protected $fillable = ['id','logo','name'];

    public function users()
    {
        return $this->belongsToMany('App\User', 'users_have_apps')->withTimestamps();
    }


}
