<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoiceDetailsTable extends Migration
{
    public function up()
    {
        Schema::create('invoice_details', function (Blueprint $table) {
            $table->id();
            $table->uuid('id_invoice'); // Ubah ke uuid
            $table->foreign('id_invoice')->references('id')->on('invoices')->onDelete('cascade');
            $table->text('keterangan');
            $table->integer('jumlah');
            $table->decimal('harga_satuan', 15, 2);
            $table->timestamps();
        });        
    }

    public function down()
    {
        Schema::dropIfExists('invoice_details');
    }
}
