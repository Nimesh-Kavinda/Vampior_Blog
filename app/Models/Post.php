<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'excerpt',
        'content',
        'author',
        'image',
        'read_time',
        'likes',
        'published_at',
        'status',
        'editor_id'
    ];

    protected $casts = [
        'published_at' => 'datetime',
        'likes' => 'integer'
    ];

    public function scopePublished($query)
    {
        return $query->where('status', 'published');
    }

    public function scopeDraft($query)
    {
        return $query->where('status', 'draft');
    }

    public function editor()
    {
        return $this->belongsTo(User::class, 'editor_id');
    }
}
