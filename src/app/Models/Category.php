<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    public function posts()
    {
        // Category has many Posts
        return $this->hasMany(Post::class);
    }

    public function getByCategory(int $limit_count = 5)
    {
        // Eagerローディング
        // カテゴリnに属するpostを取得
        return $this->posts()->with('category')->orderBy('updated_at', 'DESC')->paginate($limit_count);
    }
}
