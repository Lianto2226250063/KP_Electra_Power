<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class invoice extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'invoices';

    protected $fillable = ['nomor', 'kepada', 'tanggal', 'lokasi', 'id_pegawai'];

    public function items()
    {
        return $this->hasMany(InvoiceDetail::class, 'id_invoice'); // pastikan nama model dan foreign key-nya sesuai
    }

    public function pegawai()
    {
        return $this->belongsTo(User::class, 'id_pegawai');
    }

}