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
        Schema::create('athletes', function (Blueprint $table) {
            $table->id();
            $table->string('profile_photo')->nullable();
            $table->string('last_name', 50);
            $table->string('first_name', 50);
            $table->date('birthdate');
            $table->enum('sex', ['Male', 'Female']);
            $table->decimal('weight', 5, 2, true);
            $table->string('school_name', 100);
            $table->tinyInteger('grade_level');
            $table->string('lrn', 12);
            $table->foreignId('game_id')
                ->constrained()
                ->cascadeOnDelete();
            $table->foreignId('team_id')
                ->constrained()
                ->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('athletes');
    }
};
