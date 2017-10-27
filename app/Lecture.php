<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Lecture extends Model
{
    use SoftDeletes;
    //protected $table = 'name_of_table';
    //protected $primaryKey = 'name_of_id';
    protected $dates = ['deleted_at'];
    protected $fillable = [
        'lecturename','course_id'
    ];

    public function topics(){
        return $this->hasMany('App\Topic');
    }
}
