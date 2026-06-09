<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $fillable = [
        'category_id',
        'title',
        'slug',
        'excerpt',
        'body',
        'thumbnail',
        'is_published',
    ];

    protected $casts = [
        'is_published' => 'boolean',
    ];

    public function category()
    {
        return $this->belongsTo(InvestmentCategory::class, 'category_id');
    }

    /**
     * User yang pernah membaca artikel ini.
     */
    public function readers()
    {
        return $this->belongsToMany(User::class, 'article_user_reads')
                    ->withPivot('read_at');
    }

    /**
     * User yang mem-bookmark artikel ini.
     */
    public function bookmarkers()
    {
        return $this->belongsToMany(User::class, 'article_user_bookmarks')
                    ->withTimestamps();
    }
}
