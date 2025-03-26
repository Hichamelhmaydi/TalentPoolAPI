<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('condidature', function (Blueprint $table) {
            $table->foreignId('recruteur_id')->nullable()->constrained('users')->onDelete('cascade');
        });
    }
    

    public function down(): void
    {
        Schema::table('condidature', function (Blueprint $table) {
            $table->dropForeign(['recruteur_id']);
            $table->dropColumn('recruteur_id');
        });
    }
};
