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
        Schema::create('artists', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->string('genre_musical');
            $table->string('reseaux_sociaux');
            $table->string('biograhie');
            $table->boolean('est_utilisateur')->default(false);
            $table->foreignId('user_id')->unique()->references('id')->on('users')->contrained();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('artists');
    }
};
