<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvoiceDetail extends Model
{
    use HasFactory;

    // Tentukan nama tabel jika tidak sesuai konvensi
    protected $table = 'invoice_details';

    // Tentukan kolom yang dapat diisi (mass assignable)
    protected $fillable = [
        'id_invoice', 
        'keterangan', 
        'jumlah', 
        'harga_satuan'
    ];

    // Relasi dengan Invoice model (setiap detail milik satu invoice)
    public function invoice()
    {
        return $this->belongsTo(Invoice::class, 'id_invoice');
    }
}
