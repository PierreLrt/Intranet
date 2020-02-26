<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Evenement extends Model
{
    protected $fillable = [
        'intitule', 'description', 'date_debut', 'date_fin', 'user_id'
    ];
}
