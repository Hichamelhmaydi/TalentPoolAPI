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
        Schema::table('condidature', function (Blueprint $table) {
            $table->foreignId('candidat_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('annonce_id')->constrained('annonce')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('condidature', function (Blueprint $table) {
            //
        });
    }
};
