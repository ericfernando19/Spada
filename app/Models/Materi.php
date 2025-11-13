<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Materi extends Model
{
    use HasFactory;

    protected $table = 'materis';
    protected $fillable = ['course_id', 'judul', 'konten', 'file'];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }
    public function submateris()
    {
        return $this->hasMany(Submateri::class);
    }
    public function soals()
    {
        return $this->hasMany(Soal::class, 'materi_id');
    }

}
