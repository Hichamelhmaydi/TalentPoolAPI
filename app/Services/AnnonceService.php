<?php
namespace App\Services;

use App\Repositories\RepositoryInterface\AnnonceRepositoryInterface;

class AnnonceService {
    protected $annonceRepository;

    public function __construct(AnnonceRepositoryInterface $annonceRepository) {
        $this->annonceRepository = $annonceRepository;
    }

    public function getAllAnnonces() {
        return $this->annonceRepository->getAllAnnonces();
    }

    public function getAnnonceById($id) {
        return $this->annonceRepository->getAnnonceById($id);
    }

    public function createAnnonce($data) {
        return $this->annonceRepository->createAnnonce($data);
    }

    public function updateAnnonce($id, $data) {
        return $this->annonceRepository->updateAnnonce($id, $data);
    }

    public function deleteAnnonce($id) {
        return $this->annonceRepository->deleteAnnonce($id);
    }
}
