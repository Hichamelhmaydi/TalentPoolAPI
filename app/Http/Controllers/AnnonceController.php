<?php

namespace App\Http\Controllers;

use App\Services\AnnonceService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Models\Annonce;

class AnnonceController extends Controller
{
    protected $annonceService;

    public function __construct(AnnonceService $annonceService)
    {
        $this->annonceService = $annonceService;
    }

    public function index(): JsonResponse
    {
        $annonces = $this->annonceService->getAllAnnonces();
        return response()->json($annonces);
    }

    public function store(Request $request): JsonResponse
    {
        if (!auth()->check()) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
    
        $user = auth()->user();
        if ($user->role !== 'recruteur') {
            return response()->json(['error' => 'Only recruiters can create job announcements'], 403);
        }
    
        $validatedData = $request->validate([
            'titre' => 'required|string|max:255',
            'description' => 'required|string',
        ]);
    
        $validatedData['user_id'] = $user->id;
    
        $annonce = $this->annonceService->createAnnonce($validatedData);
    
        return response()->json(['message' => 'Annonce created successfully', 'annonce' => $annonce], 201);
    }
    

    public function show($id): JsonResponse
    {
        $annonce = $this->annonceService->getAnnonceById($id);
        
        if (!$annonce) {
            return response()->json(['message' => 'Annonce not found'], 404);
        }

        return response()->json($annonce);
    }

    public function update(Request $request, $id): JsonResponse
    {
        $validatedData = $request->validate([
            'titre' => 'sometimes|string|max:255',
            'description' => 'sometimes|string',
            'user_id' => 'sometimes|exists:users,id'
        ]);

        $annonce = $this->annonceService->updateAnnonce($id, $validatedData);
        return response()->json($annonce);
    }

    public function destroy($id): JsonResponse
    {
        $this->annonceService->deleteAnnonce($id);
        return response()->json(['message' => 'Annonce deleted successfully'], 204);
    }
}