<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubMateri extends Model
{
    use HasFactory;

    protected $fillable = [
        'materi_id',
        'judul',
        'konten',
        'file'
    ];

    public function materi()
    {
        return $this->belongsTo(Materi::class);
    }
    public function tugas()
    {
        return $this->hasMany(Tugas::class);
    }


}
