<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class listfilm extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'listfilms';

    protected $fillable = ['nama', 'deskripsi', 'foto', 'skor', 'genre_id', 'produser', 'rating_id', 'studio_id', 'jenis_id'];

    public function genre(){
        return $this->belongsTo(genre::class, 'genre_id');
    }
    public function jenis(){
        return $this->belongsTo(jenis::class, 'jenis_id');
    }
    public function rating(){
        return $this->belongsTo(rating::class, 'rating_id');
    }
    public function studio(){
        return $this->belongsTo(studio::class, 'studio_id');
    }
}