<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Msgunderstd extends Model
{
    protected $fillable = [
        'user_id','message_id','buttonPressed'
    ];
}
