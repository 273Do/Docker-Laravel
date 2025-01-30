<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class Post extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'title',
        'body',
        'category_id'
    ];

    public function getByLimit(int $limit_count = 10)
    {
        return $this->orderBy('updated_at', 'DESC')->limit($limit_count)->get();
    }

    public function getPaginateByLimit(int $limit_count = 10)
    {
        // Eagerローディング
        return $this::with('category')->orderBy('updated_at', 'DESC')->paginate($limit_count);
    }

    public function category()
    {
        // Post belongs to Category
        return $this->belongsTo(Category::class);
    }

    public function replies()
    {
        // Post has many Replies
        // return $this->belongsToMany(User::class, 'replies');
        return $this->hasMany(Reply::class);
    }

    public function likes()
    {
        // User / Post has many Likes
        return $this->hasMany(Like::class);
    }
}
