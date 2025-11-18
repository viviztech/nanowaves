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
        Schema::create('plans', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->decimal('price', 10, 2);
            $table->string('billing_period')->default('monthly'); // monthly, yearly
            $table->json('features')->nullable(); // Store plan features as JSON
            $table->string('speed')->nullable(); // Internet speed
            $table->boolean('is_popular')->default(false);
            $table->boolean('is_active')->default(true);
            $table->string('plan_type')->nullable(); // tv, internet, bundle, etc.
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('plans');
    }
};
