<?php

use App\Models\Category;
use App\Models\MeanPayment;
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
        Schema::create('fixeds', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug');
            $table->string('type');
            $table->string('number_installments')->nullable();
            $table->string('value');
            $table->string('due_date');
            $table->string('status');
            $table->foreignIdFor(Category::class);
            $table->foreignIdFor(MeanPayment::class);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fixeds');
    }
};
