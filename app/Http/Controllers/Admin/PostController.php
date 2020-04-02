<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Post;
use App\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    private $validazione;

    public function __construct()
    {
        $this->validazione = [
           'titolo' => 'required|string|max:255',
           'corpo' => 'required|string'
       ];
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::where('user_id', Auth::id())->get();
        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tags = Tag::all();
        return view('admin.posts.create', compact("tags"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

      $data = $request->all();
      if(empty($data["path_img"])) {
        $path = null;

      } else {
        $path = Storage::disk('public')->put('images', $data['path_img']);
      }

      // dd($data);
        $idUser = Auth::user()->id;

        // $request->validate($this->validazione);
        $request->validate([
          'titolo' => 'required|string|max:255',
          'corpo' => 'required|string',
          'path_img' => 'image|nullable',
          'pubblicato' => 'required|boolean'
        ]);

        $newPost = new Post;

        $newPost->titolo = $data['titolo'];
        $newPost->corpo = $data['corpo'];
        $newPost->pubblicato = $data['pubblicato'];
        $newPost->user_id = $idUser;
        $newPost->slug = Str::finish(Str::slug($newPost->titolo), rand(1, 999));

        $newPost->path_img = $path;

        $saved = $newPost->save();
        if (!$saved) {
            return redirect()->back();
        }


        $tags = $data['tags'];
        if (!empty($tags)) {
            $newPost->tags()->attach($tags);
        }

        return redirect()->route('admin.posts.show', $newPost->slug);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $post = Post::where('slug', $slug)->first();
        return view('admin.posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        $post = Post::where('slug', $slug)->first();
        $tags = Tag::all();
        $data = [
           'tags' => $tags,
           'post' => $post
       ];
        return view('admin.posts.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {

      $data = $request->all();
      if(empty($data["path_img"])) {
        $path = null;

      } else {
        $path = Storage::disk('public')->put('images', $data['path_img']);
      }

        $idUser = Auth::user()->id;
        if (empty($post)) {
            abort(404);
        }

        if ($post->user->id != $idUser) {
            abort(404);
        }

        $request->validate([
          'titolo' => 'required|string|max:255',
          'corpo' => 'required|string',
          'pubblicato' => 'required|boolean',
          'path_img' => 'image|nullable'
        ]);
        

        $post->titolo = $data['titolo'];
        $post->corpo = $data['corpo'];
        $post->slug = Str::finish(Str::slug($post->titolo), rand(1, 999));
        $post->path_img = $path;
        $post->pubblicato = $data['pubblicato'];
        $updated = $post->update();

        if (!$updated) {
            return redirect()->back();
        }


        $tags = $data['tags'];
        if (!empty($tags)) {
            $post->tags()->sync($tags);
        }

        return redirect()->route('admin.posts.show', $post->slug);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        if (empty($post)) {
            abort(404);
        }
        $post->tags()->detach();
        $post->delete();
        return redirect()->route('admin.posts.index');
    }
}
