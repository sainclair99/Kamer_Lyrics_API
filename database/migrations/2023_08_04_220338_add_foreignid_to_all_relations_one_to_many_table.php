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
        // * ARTICLES table foreign keys added
        Schema::table('articles', function (Blueprint $table) {
            $table->foreignId('genre_id')->references('id')->on('genres')->contrained();
            $table->foreignId('editor_id')->references('id')->on('users')->contrained();
        });

        // * Categories table foreign keys added
        Schema::table('categories', function (Blueprint $table) {
            $table->foreignId('editor_id')->references('id')->on('users')->contrained();
        });

        // * COMMENTS table foreign keys added
        Schema::table('comments', function (Blueprint $table) {
            $table->foreignId('user_id')->references('id')->on('users')->contrained();
            $table->foreignId('lyrics_id')->references('id')->on('lyrics')->contrained();
        });

        // * MESSAGES table foreign keys added
        Schema::table('messages', function (Blueprint $table) {
            $table->foreignId('user_id')->references('id')->on('users')->contrained();
            $table->foreignId('subject_id')->references('id')->on('subjects')->contrained();
        });

        // * SUBJECTS table foreign keys added
        Schema::table('subjects', function (Blueprint $table) {
            $table->foreignId('user_id')->references('id')->on('users')->contrained();
        });

        // * TRANSLATIONS table foreign keys added
        Schema::table('translations', function (Blueprint $table) {
            $table->foreignId('user_id')->references('id')->on('users')->contrained();
            $table->foreignId('lyrics_id')->references('id')->on('lyrics')->contrained();
        });

        // * LYRICS table foreign keys added
        Schema::table('lyrics', function (Blueprint $table) {
            $table->foreignId('album_id')->references('id')->on('albums')->nullable()->contrained();
            $table->foreignId('user_id')->references('id')->on('users')->contrained();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // * ARTICLES table foreign keys removed
        Schema::table('articles', function (Blueprint $table) {
            $table->dropForeign('editor_id');
            $table->dropForeign('genre_id');
        });

        // * Categories table foreign keys removed
        Schema::table('categories', function (Blueprint $table) {
            $table->dropForeign('editor_id');
        });

        // * COMMENTS table foreign keys removed
        Schema::table('comments', function (Blueprint $table) {
            $table->dropForeign('user_id');
            $table->dropForeign('lyrics_id');
        });

        // * MESSAGES table foreign keys removed
        Schema::table('messages', function (Blueprint $table) {
            $table->dropForeign('user_id');
            $table->dropForeign('subject_id');
        });

        // * SUBJECTS table foreign keys removed
        Schema::table('subjects', function (Blueprint $table) {
            $table->dropForeign('user_id');
        });

        // * TRANSLATIONS table foreign keys removed
        Schema::table('translations', function (Blueprint $table) {
            $table->dropForeign('user_id');
            $table->dropForeign('lyrics_id');
        });

        // * LYRICS table foreign keys removed
        Schema::table('lyrics', function (Blueprint $table) {
            $table->dropForeign('album_id');
            $table->dropForeign('user_id');
        });
    }
};
