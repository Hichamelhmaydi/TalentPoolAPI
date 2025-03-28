<?php

namespace App\Services;

use App\Repositories\RepositoryInterface\CondidateurRepositoryInterface;
use App\Models\Candidature;
use Illuminate\Support\Facades\Auth;

class CondidateurService 
{
    protected $condidateurRepository;

    public function __construct(CondidateurRepositoryInterface $condidateurRepository) 
    {
        $this->condidateurRepository = $condidateurRepository;
    }

    public function addCandidature(array $data) 
    {
        $existingCandidature = Candidature::where([
            'candidat_id' => Auth::id(),
            'annonce_id' => $data['annonce_id']
        ])->first();

        if ($existingCandidature) {
            throw new \Exception('Vous avez déjà postulé à cette annonce');
        }

        $data['candidat_id'] = Auth::id();

        return $this->condidateurRepository->addCandidature($data);
    }

    public function deleteCandidature($id) 
    {
        $candidature = $this->condidateurRepository->getCandidature($id);
        
        if ($candidature->candidat_id !== Auth::id()) {
            throw new \Exception('Vous n\'êtes pas autorisé à supprimer cette candidature');
        }

        return $this->condidateurRepository->deleteCandidature($id);
    }

    public function getCandidature($id) 
    {
        return $this->condidateurRepository->getCandidature($id);
    }

    public function getAllCandidatures() 
    {
        return $this->condidateurRepository->getAllCandidatures();
    }
}