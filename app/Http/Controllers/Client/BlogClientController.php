<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\Http\Request;

class BlogClientController extends Controller
{
    public function index(Request $request)
    {
        $query = Blog::query();

        if ($request->has('search') && $request->search != '') {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        $blogs = $query->latest()->paginate(6);

        return view('client.pages.blog.index', compact('blogs'));
    }

    public function show($id)
    {
        $blog = Blog::findOrFail($id);
        return view('client.pages.blog.show', compact('blog'));
    }
}
