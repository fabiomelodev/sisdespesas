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
        Schema::create('estimateds', function (Blueprint $table) {
            $table->id();
            $table->string('id_date');
            $table->string('month');
            $table->string('year');
            $table->string('deposit_total')->nullable();
            $table->string('expense_total')->nullable();
            $table->json('deposits')->nullable();
            $table->json('expenses')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('estimateds');
    }
};
