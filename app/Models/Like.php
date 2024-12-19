<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_contents',
        'id_users',
        'tanggal',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_users');
    }
}
