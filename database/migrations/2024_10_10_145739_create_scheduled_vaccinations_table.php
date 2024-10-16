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
        Schema::create('scheduled_vaccinations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->cascadeOnDelete();
            $table->foreignId('vaccine_center_id')->nullable()->constrained()->cascadeOnDelete();
            $table->timestamp('vaccine_date')->nullable();
            $table->integer('status')->comment('1=not-registered, 2=not-scheduled, 3=scheduled, 4=vaccinated')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('scheduled_vaccinations');
    }
};
