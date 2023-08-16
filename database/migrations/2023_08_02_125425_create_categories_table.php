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
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('libelle');
            $table->timestamps();
        });

        Schema::create('category_subject', function (Blueprint $table) {
            $table->foreignId('category_id')->references('id')->on('categories')->contrained();
            $table->foreignId('subject_id')->references('id')->on('subjects')->contrained();
            $table->primary(['category_id','subject_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('category_subject');
        Schema::dropIfExists('categories');
    }
};
