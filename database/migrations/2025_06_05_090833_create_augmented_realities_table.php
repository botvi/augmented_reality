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
        Schema::create('augmented_realities', function (Blueprint $table) {
            $table->id();
            $table->string('nama_objek');
            $table->string('objek_3d');
            $table->string('pattern_pattern');
            $table->string('pattern_image');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('augmented_realities');
    }
};
