<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Annonce extends Model
{
    protected $fillbale =[
        'titre',
        'description',
        'user_id',
    ];
    public function user() {
        return $this->belongsTo(User::class);
        }
}
