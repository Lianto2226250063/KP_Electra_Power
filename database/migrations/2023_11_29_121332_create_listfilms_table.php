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
        Schema::create('listfilms', function (Blueprint $table) {
            $table->uuid("id");
            $table->primary('id');
            $table->string('nama', 50);
            $table->text('deskripsi');
            $table->string('produser', 50);
            $table->string('foto', 55)->nullable();
            $table->double('skor');
            $table->uuid('genre_id');
            $table->uuid('studio_id');
            $table->uuid('rating_id');
            $table->uuid('jenis_id');
            $table->foreign('genre_id')->references('id')->on('genres')->restrictOnDelete()->restrictOnUpdate();
            $table->foreign('studio_id')->references('id')->on('studios')->restrictOnDelete()->restrictOnUpdate();
            $table->foreign('jenis_id')->references('id')->on('jenis')->restrictOnDelete()->restrictOnUpdate();
            $table->foreign('rating_id')->references('id')->on('ratings')->restrictOnDelete()->restrictOnUpdate();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('listfilms');
    }
};