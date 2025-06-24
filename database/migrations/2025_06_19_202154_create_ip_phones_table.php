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
        Schema::create('ip_phones', function (Blueprint $table) {
            $table->id();
            $table->string('model');
            $table->string('phone_number');
            $table->unsignedBigInteger('assigned_to')->nullable(); // пользователь
            $table->date('last_firmware_update')->nullable();
            $table->string('location');
            $table->string('status')->default('работает'); // работает / в ремонте / списан
            $table->foreign('assigned_to')->references('id')->on('users')->onDelete('set null');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ip_phones');
    }
};
