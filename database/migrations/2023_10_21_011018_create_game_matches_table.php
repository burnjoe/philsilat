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
        Schema::create('game_matches', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('round');
            $table->integer('game_no')->unsigned();
            $table->foreignId('game_id')
                ->constrained()
                ->cascadeOnDelete();
            $table->unsignedBigInteger('athlete1_id');
            $table->unsignedBigInteger('athlete2_id')->nullable();
            $table->unsignedBigInteger('winner_id')->nullable();
            $table->boolean('is_closed')->default(false);

            // Define FK constraints
            $table->foreign('athlete1_id')
                ->references('id')
                ->on('athletes')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreign('athlete2_id')
                ->references('id')
                ->on('athletes')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreign('winner_id')
                ->references('id')
                ->on('athletes')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('game_matches');
    }
};
