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
        'sender',
    ];

    // Mỗi tin nhắn thuộc về một user
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
