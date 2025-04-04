<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostsController extends Controller
{
    public function myPosts()
    {
        $posts = Post::with('category')->where('user_id', Auth::id())->latest()->paginate(5);
        return view('user.my-post', compact('posts'));
    }
    
    public function index()
    {
        $posts = Post::with('category', 'user')->latest()->paginate(5);
        $categories = Category::all();
        return view('dashboard', compact('posts', 'categories'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('user.create-post', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('image') && $request->file('image')->getSize() > 2048 * 1024) {
            return redirect()->back()->withErrors(['image' => 'Image size should not exceed 2MB.']);
        }

        $post = new Post();
        $post->title = $request->title;
        $post->body = $request->body;
        $post->category_id = $request->category_id;
        $post->user_id = Auth::user()->id;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public');
            $post->image = $imagePath;
        }

        $post->save();

        return redirect()->route('dashboard')->with('success', 'Post created successfully.');
    }

    public function show($id)
    {
        $post = Post::with('category', 'user')->findOrFail($id);
        return view('posts.post', compact('post'));
    }

    public function edit($id)
    {
        $post = Post::findOrFail($id);
        $categories = Category::all();
        return view('user.edit-post', compact('post', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $post = Post::findOrFail($id);
        $post->title = $request->title;
        $post->body = $request->body;
        $post->category_id = $request->category_id;

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public');
            $post->image = $imagePath;
        }

        $post->save();

        return redirect()->route('dashboard')->with('success', 'Post updated successfully.');
    }

    public function remove($id)
    {
        $post = Post::findOrFail($id);
        $post->delete();

        return redirect()->route('dashboard')->with('success', 'Post deleted successfully.');
    }

    public function trashed()
    {
        $posts = Post::onlyTrashed()->paginate(5);
        return view('admin-page', compact('posts'));
    }

    public function destroy($id)
    {
        $post = Post::withTrashed()->findOrFail($id);
        $post->forceDelete();

        return redirect()->route('admin')->with('success', 'Post deleted permanently.');
    }
    
    public function restore($id)
    {
        $post = Post::withTrashed()->findOrFail($id);
        $post->restore();

        return redirect()->route('admin')->with('success', 'Post restored successfully.');
    }

    public function search(Request $request)
    {
        $query = $request->input('query');
        $posts = Post::with('category', 'user')
            ->where('title', 'like', "%{$query}%")
            ->orWhere('body', 'like', "%{$query}%")
            ->get();

        $categories = Category::all();
        return view('dashboard', compact('posts', 'categories', 'query'));
    }
}
