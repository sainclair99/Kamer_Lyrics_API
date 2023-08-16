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
        Schema::create('lyrics', function (Blueprint $table) {
            $table->id();
            $table->string('titre');
            $table->string('status');
            $table->boolean('verifier')->default(false);
            $table->string('contenu')->unique();
            $table->dateTime('date_sortie')->nullable();
            $table->string('video')->nullable();
            $table->timestamps();
        });

        Schema::create('genre_lyrics',function (Blueprint $table){
            $table->foreignId('genre_id')->constrained();
            $table->foreignId('lyrics_id')->constrained();
            $table->primary(['genre_id','lyrics_id']);
        });

        Schema::create('language_lyrics',function (Blueprint $table){
            $table->foreignId('language_id')->constrained();
            $table->foreignId('lyrics_id')->constrained();
            $table->primary(['language_id','lyrics_id']);
        });

        Schema::create('likes',function (Blueprint $table){
            $table->foreignId('user_id')->constrained();
            $table->foreignId('lyrics_id')->constrained();
            $table->primary(['user_id','lyrics_id']);
        });

        Schema::create('favorites',function (Blueprint $table){
            $table->foreignId('user_id')->constrained();
            $table->foreignId('lyrics_id')->constrained();
            $table->primary(['user_id','lyrics_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('favorites');
        Schema::dropIfExists('likes');
        Schema::dropIfExists('language_lyrics');
        Schema::dropIfExists('genre_lyrics');
        Schema::dropIfExists('lyrics');
    }
};
