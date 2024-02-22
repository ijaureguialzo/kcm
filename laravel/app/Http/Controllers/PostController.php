<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:post-list|post-create|post-edit|post-delete', ['only' => ['index', 'store']]);
        $this->middleware('permission:post-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:post-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:post-delete', ['only' => ['destroy']]);
    }

    public function index()
    {
        $compilations = Auth::user()->compilations()->paginate(10);

        return view('posts.index', compact('compilations'));
    }

    public function create()
    {
        $compilations = Auth::user()->compilations()->get();

        return view('posts.create', compact('compilations'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
        ]);

        Post::create([
            'title' => request('title'),
            'description' => request('description'),
            'content' => request('content'),
            'url' => request('url'),
            'compilation_id' => request('compilation_id'),
        ]);

        return redirect(route('posts.index'));
    }

    public function edit(Post $post)
    {
        $compilations = Auth::user()->compilations()->get();

        return view('posts.edit', compact(['post', 'compilations']));
    }

    public function update(Request $request, Post $post)
    {
        $this->validate($request, [
            'title' => 'required',
        ]);

        $post->update([
            'title' => request('title'),
            'description' => request('description'),
            'content' => request('content'),
            'url' => request('url'),
            'compilation_id' => request('compilation_id'),
        ]);

        return redirect(route('posts.index'));
    }

    public function destroy(Post $post)
    {
        $post->delete();

        return back();
    }
}
