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
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string("firstName")->nullable(false);
            $table->string("lastName")->nullable(false);
            $table->string("phone")->nullable(false);
            $table->string('img')->nullable(false);
            $table->integer('age')->nullable(false);
            $table->string('address')->nullable(false);
            $table->integer('numUsedCard')->default(0);
            $table->string('password')->nullable(false);
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }
 
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
