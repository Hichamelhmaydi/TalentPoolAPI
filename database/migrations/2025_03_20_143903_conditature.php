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
        Schema::create('condidature', function (Blueprint $table) {
            $table->id();
            $table->string('lettre');
            $table->string('password');
            $table->string('cv-path');
            $table->string('statut',['accépter','refuser','en entretien','pas encore traité','pas lu','pas passé']);
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
