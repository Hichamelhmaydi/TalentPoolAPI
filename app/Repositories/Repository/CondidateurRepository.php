<?php

namespace App\Repositories\Repository;

use App\Models\Candidature;
use App\Repositories\RepositoryInterface\CondidateurRepositoryInterface;
use Illuminate\Support\Facades\Storage;


class CondidateurRepository implements CondidateurRepositoryInterface 
{
    public function addCandidature(array $data)
    {
        if (isset($data['cv'])) {
            $data['cv-path'] = $data['cv']->store('cvs', 'public');
        }

        return Candidature::create($data);
    }

    public function deleteCandidature($id)
    {
        $candidature = Candidature::findOrFail($id);
        
        if ($candidature->{'cv-path'}) {
            Storage::disk('public')->delete($candidature->{'cv-path'});
        }

        return $candidature->delete();
    }

    public function getCandidature($id)
    {
        return Candidature::findOrFail($id);
    }

    public function getAllCandidatures()
    {
        $user = auth()->user()->id;
        return Candidature::where('candidat_id', '=', $user)->get();
    }    
}