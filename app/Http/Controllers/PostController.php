<?php

namespace App\Http\Controllers;
use App\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
  public function index()
   {
      // $posts = Post::all();
       $posts = Post::where("pubblicato","1")->get();

       return view('guest.posts.index', compact('posts'));
   }

   public function show($slug)
    {
        $post = Post::where('slug', $slug)->first();

        return view('guest.posts.show', compact('post'));
    }
}
