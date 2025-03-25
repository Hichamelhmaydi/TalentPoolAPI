<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Candidature extends Model
{
    use HasFactory;

    protected $fillable = [
        'lettre',
        'cv-path',
        'statut',
        'candidat_id',
        'annonce_id',
    ];

    public function candidat()
    {
        return $this->belongsTo(User::class, 'candidat_id');
    }

    public function annonce()
    {
        return $this->belongsTo(Annonce::class, 'annonce_id');
    }
}
