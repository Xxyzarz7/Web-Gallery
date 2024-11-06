<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'alamat',
        'username',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Relasi antara User dan Like.
     */
    public function likes() // mengubah ikon
    {
        return $this->belongsToMany(Content::class, 'likes', 'id_users', 'id_contents');
    }
    public function hasLiked(Content $content) // mengubah ikon
    {
        return $this->likes()->where('id_contents', $content->id)->exists();
    }
    
}
