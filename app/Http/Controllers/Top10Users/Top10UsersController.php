<?php

namespace App\Http\Controllers\Top10Users;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class Top10UsersController extends Controller
{
    public function showTopUsers()
    {
        $topUsers = DB::table('users')
            ->join('orders', 'users.id', '=', 'orders.user_id')
            ->where('orders.status', 'delivered')
            ->select(
                'users.id',
                'users.name',
                'users.email',
                DB::raw('SUM(orders.price) as total_spent')
            )
            ->groupBy('users.id', 'users.name', 'users.email')
            ->orderByDesc('total_spent')
            ->limit(10)
            ->get();

        return view('admin.pages.top10users.top10', compact('topUsers'));

    }
}
