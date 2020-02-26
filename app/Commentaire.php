<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Commentaire extends Model
{
    protected $fillable = [
        'message', 'user_id', 'actualite_id'
    ];
}
