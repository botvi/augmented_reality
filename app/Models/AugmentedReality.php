<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Materi;

class AugmentedReality extends Model
{
    use HasFactory; 
    protected $table = 'augmented_realities';
    protected $fillable = ['nama_objek', 'objek_3d', 'pattern_pattern', 'pattern_image'];


    public function materi()
    {
        return $this->belongsTo(Materi::class, 'materi_id');
    }
}