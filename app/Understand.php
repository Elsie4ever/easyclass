<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Understand extends Model
{
    protected $fillable = [
        'user_id','topic_id','understand'
    ];
    public function user(){
        return $this->belongsTo('App/User');
    }
    public function topic(){
        return $this->belongsTo('App/Topic');
    }
}
