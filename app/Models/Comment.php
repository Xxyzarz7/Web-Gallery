<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_contents',
        'id_users',
        'komentar',
        'tanggal',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_users');
    }

    public function content()
    {
        return $this->belongsTo(Content::class, 'id_contents');
    }
    
}
