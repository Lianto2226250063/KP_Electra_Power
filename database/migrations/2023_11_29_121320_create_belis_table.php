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
        Schema::create('belis', function (Blueprint $table) {
            $table->uuid("id");
            $table->primary('id');
            $table->string('nama', 50);
            $table->text('catatan');
            $table->date('durasi');
            $table->text('alamat');
            $table->integer('jumlah');
            $table->uuid('jual_id');
            $table->foreign('jual_id')->references('id')->on('juals')->restrictOnDelete()->restrictOnUpdate();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ratings');
    }
};
