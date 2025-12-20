<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

    // edit each blog according to user

    public function editBlogs(Request $request){

        

    }
    
}
