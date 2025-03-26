<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('condidature', function (Blueprint $table) {
            $table->dropForeign(['annonce_id']);
            $table->foreign('annonce_id')->references('id')->on('annonces')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::table('condidature', function (Blueprint $table) {
            $table->dropForeign(['annonce_id']);
            $table->foreign('annonce_id')->references('id')->on('annonce')->onDelete('cascade');
        });
    }
};
