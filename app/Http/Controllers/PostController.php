<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::all();
        $tags = Tag::all();
        $categories = Category::all();
        return view('posts.index', compact('posts', 'tags', 'categories'));
    }

    public function create()
    {
        $tags = Tag::all();
        $categories = Category::all();
        $users = User::all();
        $currentUserId = Auth::id();

        return view('posts.create', compact('tags', 'categories', 'users', 'currentUserId'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'img' => 'required|image|mimes:jpeg,png,jpg,gif|max:10000',
            'content' => 'required',
            'user_id' => 'required|exists:users,id',
            'published_at' => 'nullable|date',
            'category_id' => 'required|exists:categories,id',
            'tags.*' => 'required|exists:tags,id',
        ]);


        $imageName = time() . '.' . $request->img->extension();
        $request->img->move(public_path('images'), $imageName);

        $post = Post::create([
            'title' => $request->input('title'),
            'img' => $imageName, 
            'content' => $request->input('content'),
            'user_id' => $request->input('user_id'),
            'published_at' => $request->input('published_at'),
            'category_id' => $request->input('category_id'),
        ]);

        if ($request->has('tags')) {
            $post->tags()->sync($request->input('tags'));
        }

        return redirect()->route('posts.index')->with('success', 'Post created successfully.');
    }

    public function view($id)
    {
        $post = Post::findOrFail($id);
        $tags = Tag::all();
        $categories = Category::all();
        $users = User::all();
        $currentUserId = Auth::id();

        return view('posts.view', compact('post', 'tags', 'categories', 'users', 'currentUserId'));
    }

    public function edit($id)
    {
        $post = Post::findOrFail($id);
        $tags = Tag::all();
        $categories = Category::all();
        $users = User::all();
        $currentUserId = Auth::id();

        return view('posts.edit', compact('post', 'tags', 'categories', 'users', 'currentUserId'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'img' => 'required|image|mimes:jpeg,png,jpg,gif|max:10000', 
            'content' => 'required',
            'user_id' => 'required|exists:users,id',
            'published_at' => 'nullable|date',
            'category_id' => 'required|exists:categories,id',
            'tags.*' => 'required|exists:tags,id',
        ]);

        $post = Post::findOrFail($id);

        if ($request->hasFile('img')) {
            if ($post->img && file_exists(public_path('images/' . $post->img))) {
                unlink(public_path('images/' . $post->img));
            }
            
            $imageName = time() . '.' . $request->img->extension();
            $request->img->move(public_path('images'), $imageName);
            $post->img = $imageName;
        }

        $post->title = $request->input('title');
        $post->content = $request->input('content');
        $post->user_id = $request->input('user_id');
        $post->published_at = $request->input('published_at');
        $post->category_id = $request->input('category_id');
        $post->save();

        if ($request->has('tags')) {
            $post->tags()->sync($request->input('tags'));
        }

        return redirect()->route('posts.index')->with('success', 'Post updated successfully.');
    }


    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        $post->delete();

        return redirect()->route('posts.index')->with('success', 'Post deleted successfully.');
    }

    public function uploadImage(Request $request)
    {
        $request->validate([
            'img' => 'required|image|mimes:jpeg,png,jpg,gif|max:10000',
        ]);

        $imageName = time() . '.' . $request->imgupload->extension();
        $request->imgupload->storeAs('public/images', $imageName);

        return response()->json(['url' => asset('storage/images/' . $imageName)]);
    }

}
