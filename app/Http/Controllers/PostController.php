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
            'content' => 'required',
            'user_id' => 'required|exists:users,id',
            'published_at' => 'nullable|date',
            'category_id' => 'required|exists:categories,id',
            'tags.*' => 'required|exists:tags,id',
            'imgupload' => 'nullable|image|max:5000',
        ]);

        $data = $request->all();

        if ($request->hasFile('imgupload')) {
            $imageName = time() . '.' . $request->imgupload->extension();
            $request->imgupload->storeAs('public/images', $imageName);
            $data['imgupload'] = 'storage/images/' . $imageName;
        }

        $post = Post::create($data);

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
            'content' => 'required',
            'user_id' => 'required|exists:users,id',
            'published_at' => 'nullable|date',
            'category_id' => 'required|exists:categories,id',
            'tags.*' => 'required|exists:tags,id',
            'imgupload' => 'nullable|image|max:5000',
        ]);

        $post = Post::findOrFail($id);
        $data = $request->all();

        if ($request->hasFile('imgupload')) {
            $imageName = time() . '.' . $request->imgupload->extension();
            $request->imgupload->storeAs('public/images', $imageName);
            $data['imgupload'] = 'storage/images/' . $imageName;
        }

        $post->update($data);

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
        'imgupload' => 'required|image|max:5000',
    ]);

    $imageName = time() . '.' . $request->imgupload->extension();
    $request->imgupload->storeAs('public/images', $imageName);

    return response()->json(['url' => asset('storage/images/' . $imageName)]);
}

}
