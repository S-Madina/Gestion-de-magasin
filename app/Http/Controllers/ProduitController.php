<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produit;

class ProduitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Récupère les produits du user avec le stock

            $produits = auth()->user()->produits()->get()->map(function($produit) {
            $produit->stock = $produit->stock;
            return $produit;
        });

        return response()->json($produits);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // valider les données
            $validatedData = $request->validate([
            'nom' => 'required|string|max:255',
            'description' => 'nullable|string',
            'prix' => 'required|numeric|min:0',
        ]);

        // creer un produit
            $produit = auth()->user()->produits()->create($validatedData);
            return response()->json($produit, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Vérifier si le produit appartient à l'user
            $this->authorize('view', $produit);

        // Ajoute le stock à la réponse
            $produit->stock = $produit->stock;

        return response()->json($produit);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Vérifier si le produit appartient à l'user
            $this->authorize('update', $produit);

        // valider les donnees
            $validatedData = $request->validate([
                'nom' => 'sometimes|string|max:255',
                'description' => 'nullable|string',
                'prix' => 'sometimes|numeric|min:0',
            ]);

        // Mise à jour des produit
             $produit->update($validatedData);
            return response()->json($produit);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
          // vérifier si le produit appartient à l'utilisateur
            $this->authorize('delete', $produit);

        // suppression logique
            $produit->delete();
            return response()->json(null, 204);
    }
}
