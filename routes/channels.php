<?php

use Illuminate\Support\Facades\Broadcast;
use Illuminate\Support\Facades\Auth;

Broadcast::channel('chat', function ($user) {
    return Auth::check(); // hoặc $user->role === 'admin' nếu cần
});
