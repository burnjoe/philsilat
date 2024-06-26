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
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('host_name', 50);
            $table->string('name', 20);
            $table->string('description')->nullable();
            $table->timestamp('registration_starts_at');
            $table->timestamp('starts_at')->nullable();
            $table->timestamp('ends_at')->nullable();
            $table->string('venue', 50);
            $table->string('address');
            $table->string('barangay', 20);
            $table->string('city', 20);
            $table->string('province', 20);
            $table->enum('status', ['UPCOMING', 'REGISTRATION OPEN', 'CANCELLED', 'ONGOING', 'COMPLETED'])->default('UPCOMING');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
