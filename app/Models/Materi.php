<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Materi extends Model
{
    use HasFactory;
    protected $table = 'materis';
    protected $fillable = ['judul_materi', 'materi', 'gambar', 'ar_id'];

    public function augmentedReality()
    {
        return $this->belongsTo(AugmentedReality::class, 'ar_id');
    }
}
