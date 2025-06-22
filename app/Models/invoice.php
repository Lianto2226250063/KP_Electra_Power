<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'invoices';

    protected $fillable = ['nomor', 'kepada', 'tanggal', 'lokasi', 'id_pegawai'];

    // Relasi ke detail invoice (invoice_details)
    public function details()
    {
        return $this->hasMany(InvoiceDetail::class, 'id_invoice');
    }

    // Relasi ke pegawai (users)
    public function pegawai()
    {
        return $this->belongsTo(User::class, 'id_pegawai');
    }
}
