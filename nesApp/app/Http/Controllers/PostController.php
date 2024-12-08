<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;


class PostController extends Controller
{
    //
    public function index(){
        $posts = Post::all();
        return view('posts.index', compact('posts'));
    }
    public function detail($id) {
        $post = Post::findOrFail($id);
        return view('posts.detail',compact('post'));
    }
}
