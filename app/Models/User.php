<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'username',
        'email',
        'google_id', // <-- Tambahkan ini
        'password',
        'is_admin',
        'profile_picture',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Artikel yang pernah dibaca oleh user.
     */
    public function readArticles()
    {
        return $this->belongsToMany(Article::class, 'article_user_reads')
                    ->withPivot('read_at')
                    ->orderByPivot('read_at', 'desc');
    }

    /**
     * Artikel yang di-bookmark oleh user.
     */
    public function bookmarkedArticles()
    {
        return $this->belongsToMany(Article::class, 'article_user_bookmarks')
                    ->withTimestamps()
                    ->orderByPivot('created_at', 'desc');
    }

    /**
     * Skor kuis user.
     */
    public function scores()
    {
        return $this->hasMany(UserScore::class);
    }
}
