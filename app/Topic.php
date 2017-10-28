<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    protected $fillable = [
        'topicname','lecture_id'
    ];
    public function understands(){
        return $this->hasMany('App/Understand');
    }

}
