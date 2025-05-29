<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $totalSoldProducts = DB::table('order_products')->sum('quantity');
        $totalMessages = Message::count();
        $recentMessages = Message::latest()->limit(5)->get();
        $messagePerUser = Message::select('user_id')
            ->groupBy('user_id')
            ->selectRaw('user_id, COUNT(*) as total')
            ->get();

        return view('admin.pages.dashboard.dashboard', compact('totalSoldProducts', 'totalMessages', 'recentMessages', 'messagePerUser'));
    }
}
