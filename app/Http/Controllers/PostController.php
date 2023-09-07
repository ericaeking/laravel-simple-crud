<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
    public function index()
    {
       $posts = Post::all();

       return view('posts.index', compact('posts'));
    }

    public function store(Request $request)
    {
        // takes an object containing the post’s title and body, validate data 
        $request->validate([
            'title' => 'required|max:255',
            'body' => 'required',
        ]);

        // adds a new post to the database if the data is valid
        Post::create($request->all());

        // redirects the user to the homepage with a success message.
        return redirect()->route('posts.index')->with('success','Post created successfully.');
    }

    public function show($id)
    {
        $post = Post::find($id);
        return view('posts.show', compact('post'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|max:255',
            'body' => 'required',
        ]);

        $post = Post::find($id);
        $post->update($request->all());

        return redirect()->route('posts.index')->with('success', 'Post updated successfully.');

    }

    public function destroy($id)
    {
        $post = Post::find($id);
        $post->delete();

        return redirect()->route('posts.index')->with('success', 'Post deleted successfully.');
    }

    public function create()
    {
        return view('posts.create');
    }

    public function edit($id)
    {
        $post = Post::find($id);
        return view('posts.edit', compact('post'));
    }
}
