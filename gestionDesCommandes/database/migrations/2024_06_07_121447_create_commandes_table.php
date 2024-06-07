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
        Schema::create('commandes', function (Blueprint $table) {
            $table->id();
            $table->string('reference');
            $table->enum('etat_commande',['valide','en_cours','annule']);
            $table->float('montant_total');
            $table->datetime('date_commande');
            $table->foreignId('categorie_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('commandes');
        Schema::table('commandes', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
        });
        
    }
};
