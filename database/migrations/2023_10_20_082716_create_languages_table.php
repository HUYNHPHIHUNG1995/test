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
        Schema::create('languages', function (Blueprint $table) {
            $table->id();
            $table->string('name', 50);
            $table->string('canonical', 10);
            $table->string('image')->nullable();
            $table->text('description')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->tinyInteger('publish')->default(1);
            $table->tinyInteger('current')->default(0);
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade'); // Sử dụng onDelete('cascade')
            $table->timestamp('deleted_at')->nullable();
            $table->unique(['canonical','deleted_at']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('languages');
    }
};
