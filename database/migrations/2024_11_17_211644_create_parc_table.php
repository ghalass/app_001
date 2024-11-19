<?php

use App\Models\Typeparc;
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
        Schema::create('parcs', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->foreignId('typeparc_id')->constrained('typeparcs');
            $table->string('description', 250)->nullable()->default('desc parc');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('parc');
    }
};
