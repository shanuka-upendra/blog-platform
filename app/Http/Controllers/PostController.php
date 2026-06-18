<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    public function index()
    {
        // Fetch all published posts from MySQL, newest first
        $posts = Post::where('status', 'published')
            ->latest()
            ->get();

        return view('blog.index', ['posts' => $posts]);
    }

    public function show(Post $post)
    {
        if ($post->is_premium && (!Auth::check() || !Auth::user()->is_premium)) {
            return view('blog.locked', compact('post'));
        }

        return view('blog.show', compact('post'));
    }

    public function create()
    {
        return view('blog.create');
    }

    public function store(Request $request)
    {

        if (!Auth::check()) {
            return redirect('/login');
        }

        $validated = $request->validate([
            'title'      => 'required|min:5|max:255',
            'body' => 'required|string|min:10',
            'status'     => 'required|in:draft,published',
            'cover_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $imagePath = null;
        if ($request->hasFile('cover_image')) {
            $imagePath = $request->file('cover_image')->store('covers', 'public');
        }

        Post::create([
            'title'      => $validated['title'],
            'body'       => $validated['body'],
            'cover_image' => $imagePath,
            'is_premium' => $request->has('is_premium'),
            'status'     => $validated['status'],
            'user_id'    => Auth::id(),
        ]);

        return redirect('/blog')->with('success', 'Post created successfully!');
    }

    public function edit(Post $post)
    {
        abort_if(Auth::id() !== $post->user_id, 403);
        return view('blog.edit', compact('post'));
    }

    public function update(Request $request, Post $post)
    {
        abort_if(Auth::id() !== $post->user_id, 403);

        $validated = $request->validate([
            'title'       => 'required|min:5|max:255',
            'body'        => 'required|min:10',
            'status'      => 'required|in:draft,published',
            'cover_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $imagePath = $post->cover_image;
        if ($request->hasFile('cover_image')) {
            // Delete old image if exists
            if ($post->cover_image) {
                Storage::disk('public')->delete($post->cover_image);
            }
            $imagePath = $request->file('cover_image')->store('covers', 'public');
        }

        $post->update([
            'title'       => $validated['title'],
            'body'        => $validated['body'],
            'cover_image' => $imagePath,
            'is_premium'  => $request->has('is_premium'),
            'status'      => $validated['status'],
        ]);

        return redirect('/blog')->with('success', 'Post updated!');
    }


    public function destroy(Post $post)
    {
        abort_if(Auth::id() !== $post->user_id, 403);
        if ($post->cover_image) {
            Storage::disk('public')->delete($post->cover_image);
        }
        $post->delete();
        return redirect('/blog')->with('success', 'Post deleted!');
    }

    public function myPosts()
    {
        $posts = Post::where('user_id', Auth::id())
            ->latest()
            ->get();
        return view('blog.my-posts', compact('posts'));
    }
}
