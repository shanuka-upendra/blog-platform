<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Post;

class AdminController extends Controller
{
    //Main dashboard for admin
    public function index(){
        $stats = [
            'total_users' => User::count(),
            'premium_users' => User::where('is_premium', true)->count(),
            'total_posts' => Post::count(),
            'published_posts' => Post::where('is_published', true)->count(),
            'premium_posts' => Post::where('is_premium', true)->count(),
            'new_users_today' => User::whereDate('created_at', today())->count(),
        ];

        $recent_users = User::latest()->take(5)->get();
        $recent_posts = Post::with('author')->latest()->take(5)->get();

        return view('admin.dashboard', compact('stats', 'recent_users', 'recent_posts'));
    }

    public function users(){
        $users = User::latest()->paginate(10);
        return view('admin.users', compact('users'));
    }

    public function togglePremium(User $user){
        $user->update(['is_premium' => !$user->is_premium]);
        return back()->with('success', "User premium status updated successfully for {$user->name}.");
    }

    public function toggleAdmin(User $user){
        $user->update(['is_admin' => !$user->is_admin]);
        return back()->with('success', "User admin status updated successfully for {$user->name}.");
    }

    public function deleteUser(User $user){
        $user->delete();
        return back()->with('success', "User {$user->name} deleted successfully.");
    }

    public function posts(){
        $posts = Post::with('author')->latest()->paginate(10);
        return view('admin.posts', compact('posts'));
    }

    public function togglePost(Post $post){
        $post->update(['status' => $post->status === 'published' ? 'draft' : 'published']);
        return back()->with('success','Post status updated.');
    }

    public function deletePost(Post $post){
        $post->delete();
        return back()->with('success','Post deleted successfully.');
    }
}
