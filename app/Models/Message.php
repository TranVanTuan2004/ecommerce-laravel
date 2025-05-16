<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Message extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'content',
    ];

    // Mối quan hệ: Mỗi tin nhắn thuộc về 1 user
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
