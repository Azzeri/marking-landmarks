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
        Schema::create('landmark_users', function (Blueprint $table) {
            $table->id();
            $table->integer('id_user');
            $table->integer('id_landmark');
            $table->boolean('is_favourite')->default(false);
            $table->enum('status', ['to_see', 'seen'])->nullable();
            $table->enum('mark', [1, 2, 3, 4, 5])->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('landmark_users');
    }
};
