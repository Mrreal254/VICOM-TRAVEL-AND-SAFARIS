<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('suppliers', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();
            $table->string('business_name');
            $table->string('slug')->unique();
            $table->string('supplier_type', 40);
            $table->string('contact_name');
            $table->string('email')->nullable();
            $table->string('phone', 30)->nullable();
            $table->text('description')->nullable();
            $table->string('address')->nullable();
            $table->string('city', 100)->nullable();
            $table->string('country', 100);
            $table->string('status', 20)->default('active');
            $table->string('verification_status', 20)->default('pending');
            $table->timestamps();
        });

        Schema::create('supplier_users', function (Blueprint $table) {
            $table->id();
            $table->foreignId('supplier_id')->constrained()->cascadeOnDelete();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->timestamps();
            $table->unique(['supplier_id', 'user_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('supplier_users');
        Schema::dropIfExists('suppliers');
    }
};
