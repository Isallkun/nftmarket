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
        Schema::create('n_f_t_s', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('collection')->nullable();
            $table->unsignedDecimal('price', 10, 2);
            $table->unsignedInteger('quantity');
            $table->text('description')->nullable();
            $table->string('external_url')->nullable();
            $table->string('author')->nullable();
            $table->string('image')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('n_f_t_s');
    }
};
