<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class beli extends Model
{
    use HasFactory, HasUuids;
    protected $fillable = ['nama', 'catatan', 'durasi', 'alamat', 'jumlah', 'jual_id'];

    public function jual(){
        return $this->belongsTo(jual::class, 'jual_id');
    }
}
