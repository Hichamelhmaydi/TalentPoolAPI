<?php

namespace App\Repositories\RepositoryInterface;

interface AnnonceRepositoryInterface
{
    public function getAllAnnonces();
    public function getAnnonceById($id);
    public function createAnnonce(array $data);
    public function updateAnnonce($id, array $data);
    public function deleteAnnonce($id);
}