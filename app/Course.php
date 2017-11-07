<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $fillable = [
        'coursename'
    ];
    public function messages(){
        return $this->hasMany('App\Message');
    }
}
