<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Blog;


class BlogClientController extends Controller
{
    //
    public function index()
    {
        $blogs = Blog::latest()->paginate(6);
        return view('client.pages.blogs.index', compact('blogs'));
    }

    public function show($id)
    {
        $blog = Blog::findOrFail($id);
        return view('client.pages.blogs.show', compact('blog'));
    }

    public function search(Request $request)
    {
        $keyword = $request->input('keyword');

        $blogs = Blog::where('title', 'like', "%$keyword%")
            ->orWhere('content', 'like', "%$keyword%")
            ->paginate(6);

        return view('client.pages.blogs.index', compact('blogs'));
    }
}
