<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    // Columns that can be filled via forms
    protected $fillable = [
        'title',
        'body',
        'cover_image',
        'is_premium',
        'status',
        'user_id',
    ];

    // Cast these columns to proper PHP types automatically
    protected $casts = [
        'is_premium' => 'boolean',
    ];

    // A post belongs to one user (author)
    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
