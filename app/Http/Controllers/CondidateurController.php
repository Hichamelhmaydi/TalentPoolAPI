<?php

namespace App\Http\Controllers;

use App\Services\CondidateurService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\JsonResponse;

class CondidateurController extends Controller
{
    protected $condidateurService;

    public function __construct(CondidateurService $condidateurService)
    {
        $this->condidateurService = $condidateurService;
    }

    public function store(Request $request) 
    {
        $validator = Validator::make($request->all(), [
            'annonce_id' => 'required|exists:annonces,id',
            'lettre' => 'nullable|string|max:1000',
            'cv-path' => 'required|file|mimes:pdf,doc,docx|max:5120'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $validatedData = $validator->validated();
            $validatedData['cv'] = $request->file('cv');

            $candidature = $this->condidateurService->addCandidature($validatedData);
            return new JsonResponse($candidature, 201);
        } catch (\Exception $e) {
            return new JsonResponse([
                'error' => $e->getMessage()
            ], 400);
        }
    }

    public function destroy($id) 
    {
        $validator = Validator::make(['id' => $id], [
            'id' => 'required|exists:condidature,id'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $this->condidateurService->deleteCandidature($id);
            return new JsonResponse(['message' => 'Candidature supprimée'], 200);
        } catch (\Exception $e) {
            return new JsonResponse([
                'error' => $e->getMessage()
            ], 400);
        }
    }

    public function show($id) 
    {
        $validator = Validator::make(['id' => $id], [
            'id' => 'required|exists:condidature,id'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $candidature = $this->condidateurService->getCandidature($id);
            return new JsonResponse($candidature, 200);
        } catch (\Exception $e) {
            return new JsonResponse([
                'error' => $e->getMessage()
            ], 400);
        }
    }

    public function index() 
    {
        try {
            $candidatures = $this->condidateurService->getAllCandidatures();
            return new JsonResponse($candidatures, 200);
        } catch (\Exception $e) {
            return new JsonResponse([
                'error' => $e->getMessage()
            ], 400);
        }
    }
}