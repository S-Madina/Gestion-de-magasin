<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('sorties', function (Blueprint $table) {
            $table->id();
            $table->foreignId('produit_id')->constrained()->onDelete('cascade');
            $table->foreignId('utilisateur_id')->constrained()->onDelete('cascade');
            $table->integer('quantite');
            $table->date('date_sortie');
            $table->text('raison');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sorties');
    }
};
