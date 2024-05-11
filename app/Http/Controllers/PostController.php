<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Tag;
use App\Models\Category;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::all();
        $tags = Tag::all();
        $categories = Category::all();
        return view('posts.index', compact('post', 'tags', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tags = Tag::all();
        $categories = Category::all();
        return view('posts.create', compact('tags', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validate request data
        $request->validate([
            'title' => 'required',
            'content' => 'required',
            'user_id' => 'required|exists:users,id',
            'published_at' => 'nullable|date',
            'category_id' => 'required|exists:categories,id',
            'tag_id' => 'required|exists:tags,id',
            'imgupload.*' => 'nullable|image|max:5000',
        ]);

        $post = Post::create($request->all());

        if ($request->has('tags')) {
            $post->tags()->sync($request->input('tags'));
        }

        if ($request->has('category')) {
            $post->category()->sync($request->input('category'));
        }

        return redirect()->route('posts.index')->with('success', 'Post created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $tags = Tag::all();
        $categories = Category::all();
        return view('posts.edit', compact('post', 'tags', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required',
            'user_id' => 'required|exists:users,id',
            'published_at' => 'nullable|date',
            'category_id' => 'required|exists:categories,id',
            'tag_id' => 'required|exists:tags,id',
            'imgupload.*' => 'nullable|image|max:5000',
        ]);

        $post->update($request->all());

        if ($request->has('tags')) {
            $post->tags()->sync($request->input('tags'));
        }

        if ($request->has('category')) {
            $post->category()->sync($request->input('category'));
        }

        return redirect()->route('posts.index')->with('success', 'Post updated successfully.');
    }
}
