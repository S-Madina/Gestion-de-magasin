<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Entree;
use App\Models\Produit;

class EntreeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('view', $produit);
        $entrees = $produit->entrees()->get();
        return response()->json($entrees);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
          $this->authorize('update', $produit);

          // valide des données
          $validatedData = $request->validate([
              'quantite' => 'required|integer|min:1',
              'date_entree' => 'required|date',
              'commentaire' => 'nullable|string',
          ]);

          // creer l'entrée
          $entree = $produit->entrees()->create([
              'utilisateur_id' => auth()->id(),
              'quantite' => $validatedData['quantite'],
              'date_entree' => $validatedData['date_entree'],
              'commentaire' => $validatedData['commentaire'] ?? null,
          ]);

          return response()->json($entree, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $this->authorize('view', $entree);
        return response()->json($entree);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->authorize('update', $entree);

        $validatedData = $request->validate([
        'quantite' => 'sometimes|integer|min:1',
        'date_entree' => 'sometimes|date',
        'commentaire' => 'nullable|string',
        ]);

         // Mise à jour de l'entrée
            $entree->update($validatedData);
            return response()->json($entree);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->authorize('delete', $entree);
        $entree->delete();
        return response()->json(null, 204);
    }
}
