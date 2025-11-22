@extends('layouts.app')

@section('title' , 'Login')
@section('content')

<main>
        <h1>Login Here</h1>
        <p>Let's start your journey</p>
        
        <form method="POST" action="{{ route('blog.login') }}">
            @csrf
            <div>
                <label for="fullName">Full Name OR Email</label>
                <input type="text" id="fullName" name="login" placeholder="username or email" required>
            </div>
            
            <div>
                <label for="password">Password</label>
                <input type="password" name="password" id="password" placeholder="password" required>
            </div>
            
            <button type="submit">Login</button>
            <button>
                <a href="{{ route('blog.register') }}">
                    Create Account?
                </a>
            </button>
        </form>
        
    </main>

@endsection