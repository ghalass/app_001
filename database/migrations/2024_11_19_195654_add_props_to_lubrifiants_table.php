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
        Schema::table('lubrifiants', function (Blueprint $table) {

            $table->string('name')->unique();
            $table->foreignId('typelubrifiant_id')->constrained('typelubrifiants');
            $table->string('description', 250)->nullable()->default('desc parc');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('lubrifiants', function (Blueprint $table) {
            //
        });
    }
};
