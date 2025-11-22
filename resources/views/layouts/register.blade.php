@extends ('layouts/app')

@section('title' , 'Register')

@section('content')


<main>
        <h1>Create Account</h1>
        <p>Join us today and start your journey</p>
        
        <form method="POST" action="{{ route('blog.register') }}">
            @csrf
            <div>
                <label for="fullName">Full Name</label>
                <input type="text" id="fullName" name="name" placeholder="Enter your full name" required>
            </div>
            <div>
                <label for="email">Email Address</label>
                <input type="email" id="email" name="email" placeholder="your.email@example.com" required>
            </div>
            <div>
                <label for="phone">Phone Number</label>
                <input type="tel" id="phone" name="phone_num" placeholder="+1 (555) 000-0000" required>
            </div>
            <div>
                <label for="pass">Password</label>
                <input type="password" id="pass" name="password" placeholder="Create a strong password" required>
            </div>
            <div>
                <label for="password_confirmation">Confirm Password</label>
                <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Re-enter your password" required>
                <span id="password-match-error" style="color: red; display: none;">Passwords do not match</span>
            </div>
            <button type="submit">Create Account</button>
            <button>
                <a href="{{ route('blog.login') }}">
                    Login?
                </a>
            </button>
        </form>
    </main>

    <script>

        let password = document.getElementById('pass');
        let confirmedPassword = document.getElementById('password_confirmation');
        let errorMsg = document.getElementById('password-match-error');

        confirmedPassword.addEventListener('input' , function(){
            if (confirmedPassword.value && confirmedPassword.value !== password.value) {
                errorMsg.style.display = "block";
            }else{
                errorMsg.style.display = "none";
            }
        })



    </script>

    @endsection