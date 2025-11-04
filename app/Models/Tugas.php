<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tugas extends Model
{
    use HasFactory;

    protected $fillable = ['sub_materi_id', 'judul', 'deskripsi', 'deadline', 'file'];

    public function submateri()
    {
        return $this->belongsTo(SubMateri::class);
    }
}

