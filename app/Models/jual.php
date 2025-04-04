<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class jual extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'juals';

    protected $fillable = ['nama', 'toko', 'deskripsi', 'foto', 'harga', 'penjual'];

}