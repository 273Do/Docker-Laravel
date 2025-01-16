<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
    use HasFactory;

    protected $fillable = [
        'message',
        'user_id',
        'post_id'
    ];

    // リレーション (Reply belongs to a Post)
    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    // リレーション (Reply belongs to a User)
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
