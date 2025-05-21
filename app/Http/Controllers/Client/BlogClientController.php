<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Blog;

class BlogClientController extends Controller
{
    public function index()
    {
        $blogs = Blog::latest()->paginate(6);
        return view('client.pages.blog.index', compact('blogs'));
    }

    public function show($id)
    {
        $blog = Blog::findOrFail($id);
        return view('client.pages.blog.show', compact('blog'));
    }
}
