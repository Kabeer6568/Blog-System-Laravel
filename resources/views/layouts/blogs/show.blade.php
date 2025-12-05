@extends('layouts.app')

@section('title', $blog->title)

@section('content')
<main style="max-width: 900px; margin: 0 auto; padding: 40px 20px;">
    <article style="background: white; border-radius: 25px; padding: 40px; box-shadow: 0 15px 50px rgba(0,0,0,0.1);">
        
        {{-- Back Button --}}
        <a href="#" style="color: #667eea; text-decoration: none; font-weight: 600; margin-bottom: 20px; display: inline-block;">
            ← Back to My Blogs
        </a>
        
        {{-- Blog Title --}}
        <h1 style="font-size: 42px; font-weight: 900; color: #2d3436; margin-bottom: 20px;">
            {{ $blog->title }}
        </h1>
        
        {{-- Author Info --}}
        <div style="display: flex; align-items: center; gap: 15px; margin-bottom: 30px; padding-bottom: 20px; border-bottom: 2px solid #e8f4f8;">
            <div style="width: 50px; height: 50px; border-radius: 50%; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); display: flex; align-items: center; justify-content: center; color: white; font-weight: 700; font-size: 18px;">
                @if($blog->user->profile_img)
                    <img src="{{ asset('storage/' . $blog->user->profile_img) }}" alt="{{ $blog->user->name }}" style="width: 100%; height: 100%; border-radius: 50%; object-fit: cover;">
                @else
                    {{ getInitials($blog->user->name) }}
                @endif
            </div>
            <div>
                <div style="font-weight: 700; color: #667eea;">{{ $blog->user->name }}</div>
                <div style="font-size: 14px; color: #8e9aaf;">{{ $blog->created_at->format('F d, Y') }} • {{ $blog->created_at->diffForHumans() }}</div>
            </div>
        </div>
        
        {{-- Featured Image --}}
        @if($blog->featured_image)
            <img src="{{ asset('storage/' . $blog->featured_image) }}" alt="{{ $blog->title }}" style="width: 100%; border-radius: 15px; margin-bottom: 30px;">
        @endif
        
        {{-- Blog Content --}}
        <div style="font-size: 18px; line-height: 1.8; color: #2d3436;">
            {!! nl2br(e($blog->description)) !!}
        </div>
        
        {{-- Edit/Delete Buttons (if owner) --}}
        @if(auth()->check() && auth()->id() === $blog->user_id)
            <div style="margin-top: 40px; padding-top: 30px; border-top: 2px solid #e8f4f8; display: flex; gap: 15px;">
                <a href="#" style="padding: 12px 25px; background: #667eea; color: white; text-decoration: none; border-radius: 10px; font-weight: 600;">
                    Edit Blog
                </a>
                
                <form method="POST" action="#" style="display: inline;" onsubmit="return confirm('Are you sure you want to delete this blog?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" style="padding: 12px 25px; background: #d63031; color: white; border: none; border-radius: 10px; font-weight: 600; cursor: pointer;">
                        Delete Blog
                    </button>
                </form>
            </div>
        @endif
    </article>
</main>
@endsection