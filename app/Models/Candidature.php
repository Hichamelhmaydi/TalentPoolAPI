<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Candidature extends Model
{
    use HasFactory;

    protected $table = 'condidature'; 

    protected $fillable = [
        'lettre',
        'cv-path',
        'statut',
        'candidat_id',
        'annonce_id',
        'recruteur_id'
    ];
    protected $attributes = [
        'statut' => 'en entretien', 
    ];

    public function candidat(): BelongsTo
    {
        return $this->belongsTo(User::class, 'candidat_id');
    }

    public function annonce(): BelongsTo
    {
        return $this->belongsTo(Annonce::class, 'annonce_id');
    }

 
}