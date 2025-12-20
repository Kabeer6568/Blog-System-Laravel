<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AuthController extends Controller
{
    public function viewBlogs(){
        return view('layouts/blogs/index');
    }

    //create blogs

    public function createBlogs(Request $request){

        $data = $request->validate([

            'title' => 'required|string|max:255',
            'featured_image' => 'required|image|mimes:jpeg,png,webp,gif|max:2048',
            'description' => 'required|string',
        ]);

        if ($request->hasFile('featured_image')) {
            $data['featured_image'] = $request->file('featured_image')->store('blogs' , 'public');
        }

        $data['user_id'] = auth()->id();

        Blog::create($data);

        return redirect()->route('blog.dashboard')->with('sucess' , 'Blog Uploaded');

    }

    // view uploaded blogs my current user
    // only user accessable

    public function viewUploadedBlogs()
    {
        $user = auth()->user();
        $blogs = $user->blogs()->latest()->paginate(10);

        return view('layouts.blogs.view', compact('user', 'blogs'));
    }


    // view each blog on full page

    public function viewFullBlog($id){

        $blog = Blog::with('user')->findOrFail($id);

        return view('layouts.blogs.show' , compact('blog'));

    }

     public function showEditBlogs($id){
        
        $blog = Blog::with('user')->findOrFail($id);

        return view('layouts/blogs/edit' , compact('blog'));
    }

    // edit each blog according to user

    public function editBlogs(Request $request , $id){

        $data = $request->validate([
            'title' => 'nullable|string|max:255',
            'featured_image' => 'nullable|image|mimes:jpeg,png,webp,gif|max:2048',
            'description' => 'nullable|string',
        ]);

        
        $blog = Blog::findOrFail($id);

        // Check if the authenticated user owns this blog
    if ($blog->user_id !== auth()->id()) {
        abort(403, 'Unauthorized action.');
    }


        if ($request->filled('title')) {
            $blog['title'] = $data['title']; 
        };

        if ($request->filled('description')) {
            $blog['description'] = $data['description']; 
        };

        if ($request->hasFile('featured_image')) {
            if ($blog->featured_image && Storage::disk('public')->exists($blog->featured_image)) {
                Storage::disk('public')->delete($blog->featured_image);
            }

            $path = $request->file('featured_image')->store('profiles' , 'public');
            $blog->featured_image = $path;
        };

        $blog->save();

        return redirect()->route('blog.showUploadedBlogs')->with('sucess' , 'updated');

    }
    
}
