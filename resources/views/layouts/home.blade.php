@extends('layouts/app')

@section('title', 'My Blogs')

@section('content')

<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        background: linear-gradient(135deg, #a8edea 0%, #fed6e3 100%);
        min-height: 100vh;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        padding: 40px 20px;
        position: relative;
        overflow-x: hidden;
    }

    body::before {
        content: '';
        position: absolute;
        width: 100%;
        height: 100%;
        background: 
            radial-gradient(circle at 20% 30%, rgba(168, 237, 234, 0.5) 0%, transparent 50%),
            radial-gradient(circle at 80% 70%, rgba(254, 214, 227, 0.5) 0%, transparent 50%);
        animation: pulse 8s ease-in-out infinite;
        pointer-events: none;
    }

    @keyframes pulse {
        0%, 100% { opacity: 1; transform: scale(1); }
        50% { opacity: 0.7; transform: scale(1.05); }
    }

    main {
        max-width: 1400px;
        margin: 0 auto;
        position: relative;
        z-index: 1;
    }

    header {
        text-align: center;
        margin-bottom: 50px;
        animation: fadeIn 0.7s ease-out;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(-30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    h1 {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 50%, #f093fb 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        font-size: 48px;
        font-weight: 900;
        letter-spacing: -2px;
        margin-bottom: 15px;
    }

    header p {
        color: #8e9aaf;
        font-size: 16px;
        font-weight: 500;
    }

    nav {
        display: flex;
        justify-content: center;
        gap: 15px;
        margin-bottom: 40px;
    }

    nav a {
        padding: 12px 28px;
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(20px);
        border-radius: 18px;
        text-decoration: none;
        color: #667eea;
        font-weight: 700;
        font-size: 14px;
        text-transform: uppercase;
        letter-spacing: 1.5px;
        transition: all 0.3s ease;
        box-shadow: 0 8px 25px rgba(102, 126, 234, 0.2);
        border: 2px solid transparent;
    }

    nav a:hover {
        transform: translateY(-3px);
        box-shadow: 0 12px 35px rgba(102, 126, 234, 0.3);
        border-color: #a8edea;
    }

    .blogs-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 30px;
        margin-bottom: 40px;
    }

    article {
        background: rgba(255, 255, 255, 0.98);
        backdrop-filter: blur(20px);
        border-radius: 25px;
        overflow: hidden;
        box-shadow: 0 15px 50px rgba(168, 237, 234, 0.3);
        transition: all 0.4s ease;
        border: 2px solid rgba(255, 255, 255, 0.9);
        position: relative;
        animation: slideUp 0.6s ease-out backwards;
    }

    article:nth-child(1) { animation-delay: 0.1s; }
    article:nth-child(2) { animation-delay: 0.2s; }
    article:nth-child(3) { animation-delay: 0.3s; }
    article:nth-child(4) { animation-delay: 0.4s; }
    article:nth-child(5) { animation-delay: 0.5s; }
    article:nth-child(6) { animation-delay: 0.6s; }

    @keyframes slideUp {
        from {
            opacity: 0;
            transform: translateY(40px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    article::before {
        content: '';
        position: absolute;
        top: -2px;
        left: -2px;
        right: -2px;
        bottom: -2px;
        background: linear-gradient(45deg, #a8edea, #fed6e3, #fbc2eb, #a6c1ee);
        border-radius: 25px;
        z-index: -1;
        opacity: 0;
        filter: blur(15px);
        transition: opacity 0.4s ease;
    }

    article:hover {
        transform: translateY(-10px);
        box-shadow: 0 25px 70px rgba(102, 126, 234, 0.4);
    }

    article:hover::before {
        opacity: 0.8;
    }

    .blog-image {
        width: 100%;
        height: 220px;
        object-fit: cover;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 48px;
    }

    .blog-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .blog-content {
        padding: 25px;
    }

    .blog-meta {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 15px;
    }

    .blog-author {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .author-avatar {
        width: 35px;
        height: 35px;
        border-radius: 50%;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-weight: 700;
        font-size: 14px;
    }

    .author-name {
        color: #667eea;
        font-size: 13px;
        font-weight: 700;
    }

    .blog-date {
        color: #8e9aaf;
        font-size: 12px;
        font-weight: 600;
    }

    h2 {
        font-size: 20px;
        font-weight: 800;
        color: #2d3436;
        margin-bottom: 12px;
        line-height: 1.3;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .blog-description {
        color: #636e72;
        font-size: 14px;
        line-height: 1.6;
        margin-bottom: 20px;
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .blog-footer {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding-top: 15px;
        border-top: 2px solid #e8f4f8;
    }

    .read-more {
        padding: 8px 16px;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        text-decoration: none;
        border-radius: 5px;
        font-size: 12px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 1px;
        transition: all 0.3s ease;
        box-shadow: 0 8px 20px rgba(102, 126, 234, 0.3);
    }

    .read-more:hover {
        transform: translateY(-2px);
        box-shadow: 0 12px 30px rgba(102, 126, 234, 0.4);
    }

    .blog-stats {
        display: flex;
        gap: 15px;
        color: #8e9aaf;
        font-size: 13px;
        font-weight: 600;
    }

    .stat {
        display: flex;
        align-items: center;
        gap: 5px;
    }

    /* Responsive Design */
    @media (max-width: 1200px) {
        .blogs-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (max-width: 768px) {
        h1 {
            font-size: 36px;
        }

        .blogs-grid {
            grid-template-columns: 1fr;
            gap: 25px;
        }

        nav {
            flex-direction: column;
            align-items: center;
        }

        nav a {
            width: 100%;
            max-width: 300px;
            text-align: center;
        }
    }

    @media (max-width: 480px) {
        body {
            padding: 30px 15px;
        }

        h1 {
            font-size: 28px;
        }

        .blog-content {
            padding: 20px;
        }

        h2 {
            font-size: 18px;
        }
    }
</style>

<main>
    <header>
        <h1>All Blogs</h1>
        <p>Discover amazing stories and insights</p>
    </header>

    <nav>
        <a href="{{ route('blog.login') }}">Login</a>
        <a href="{{ route('blog.register') }}">Register</a>
    </nav>
    @if($blogs->count() > 0)

    
    <section class="blogs-grid">
        {{-- Example Blog Card 1 --}}
        @foreach($blogs as $blog)
        <article>
            <div class="blog-image">
                <img src="{{'../storage/' . $blog->featured_image}}" alt="Blog Image">
                
            </div>
            <div class="blog-content">
                <div class="blog-meta">
                    <div class="blog-author">
                        <div class="author-avatar">{{ getInitials($blog->user?->name) }}</div>
                        <span class="author-name">{{ucwords($blog->user?->name)}}</span>
                    </div>
                    <span class="blog-date">{{$blog->created_at->format('F,d,Y')}} . {{$blog->created_at->diffForHumans()}}</span>
                </div>
                <h2>{{ $blog->title }}</h2>
                <p class="blog-description">
                    {{ $blog->description }}
                </p>
                <div class="blog-footer">
                    <a href="{{route('blog.showFullBlogs' , $blog->id)}}" class="read-more">Read More</a>
                    <!-- <a href="{{route('blog.editform' , $blog->id)}}" class="read-more">Update Blog</a> -->
                    <div class="blog-stats">
                        <span class="stat">👁️ 1.2k</span>
                        <span class="stat">💬 24</span>
                    </div>
                </div>
            </div>
        </article>
        @endforeach
        @else
    <p>You have uploadeed no blogs yet</p>
    </section>
    

    

    @endif
</main>

@endsection