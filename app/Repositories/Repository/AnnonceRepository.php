<?php
namespace App\Repositories\Repository;

use App\Models\Annonce;
use App\Repositories\RepositoryInterface\AnnonceRepositoryInterface;

class AnnonceRepository implements AnnonceRepositoryInterface {
    public function getAllAnnonces() {
        return Annonce::all();
    }
    public function getAnnonceById($id) {
        return Annonce::find($id);
    }
    public function createAnnonce(array $data) {
        return Annonce::create($data);
    }    
    public function updateAnnonce($id, array $data){
        $annonce = Annonce::find($id);
        $annonce->update($data);
        return $annonce;
    }
    public function deleteAnnonce($id){
        return Annonce::destroy($id);
    }
}