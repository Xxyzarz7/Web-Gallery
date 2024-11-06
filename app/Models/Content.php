<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Content extends Model
{
    use HasFactory;

    protected $fillable = [
        'image',
        'tanggal',
        'judul',
        'deskripsi',
        'kategori',
        'id_users'
    ];

    // mengambil id content di table_like
    public function likes()
    {
        return $this->hasMany(Like::class, 'id_contents');
    }

    // mengambil id user di table
    public function user()
    {
        return $this->belongsTo(User::class, 'id_users');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, 'id_contents');
    }
}
