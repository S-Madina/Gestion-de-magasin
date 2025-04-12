<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produit;
use App\Models\Sortie;

class SortieController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('view', $produit);

        // Récuperer toutes les sorties de produit
        $sorties = $produit->sorties()->get();
        return response()->json($sorties);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->authorize('update', $produit);

        $validatedData = $request->validate([
            'quantite' => 'required|integer|min:1',
            'date_sortie' => 'required|date',
            'raison' => 'required|string|max:255',
        ]);

        // Vérifie qu'il y a assez de stock
        if ($produit->stock < $validatedData['quantite']) {
            return response()->json([
                'message' => 'Stock insuffisant pour cette sortie'
            ], 422);
        }

        // creer la sortie
        $sortie = $produit->sorties()->create([
            'utilisateur_id' => auth()->id(),
            'quantite' => $validatedData['quantite'],
            'date_sortie' => $validatedData['date_sortie'],
            'raison' => $validatedData['raison'],
        ]);
        return response()->json($sortie, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $this->authorize('view', $sortie);
        return response()->json($sortie);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->authorize('update', $sortie);

        // Validation des données
        $validatedData = $request->validate([
            'quantite' => 'sometimes|integer|min:1',
            'date_sortie' => 'sometimes|date',
            'raison' => 'sometimes|string|max:255',
        ]);

        // Vérifier s'il y a assez de stock si la quantité a changé
        if (isset($validatedData['quantite'])) {
            $produit = $sortie->produit;
            $stockActuel = $produit->stock + $sortie->quantite; // Annule l'ancienne sortie

            if ($stockActuel < $validatedData['quantite']) {
                return response()->json([
                    'message' => 'Stock insuffisant pour cette modification'
                ], 422);
            }
        }

        // Mise à jour de la sortie
        $sortie->update($validatedData);
        return response()->json($sortie);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->authorize('delete', $sortie);
        $sortie->delete();
        return response()->json(null, 204);
    }
}
