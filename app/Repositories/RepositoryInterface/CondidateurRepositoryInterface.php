<?php

namespace App\Repositories\RepositoryInterface;

interface CondidateurRepositoryInterface
{
    public function addCandidature(array $data);
    public function deleteCandidature($id);
    public function getCandidature($id);
    public function getAllCandidatures();
}