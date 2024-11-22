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
        Schema::create('organes', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->foreignId('typeorgane_id')->constrained('typeorganes');
            $table->string('description', 250)->nullable()->default('desc organe');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('organes');
    }
};
