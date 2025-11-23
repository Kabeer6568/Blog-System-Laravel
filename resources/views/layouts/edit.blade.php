@extends('layouts/app')

@section('title' , 'Edit')
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
        display: flex;
        justify-content: center;
        align-items: center;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        padding: 20px;
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
        background: rgba(255, 255, 255, 0.98);
        backdrop-filter: blur(20px);
        padding: 55px 50px;
        border-radius: 40px;
        box-shadow: 
            0 30px 90px rgba(168, 237, 234, 0.4),
            0 0 0 1px rgba(255, 255, 255, 0.9);
        width: 100%;
        max-width: 680px;
        position: relative;
        z-index: 1;
        animation: fadeIn 0.7s ease-out;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(40px) scale(0.95);
        }
        to {
            opacity: 1;
            transform: translateY(0) scale(1);
        }
    }

    main::before {
        content: '';
        position: absolute;
        top: -2px;
        left: -2px;
        right: -2px;
        bottom: -2px;
        background: linear-gradient(45deg, #a8edea, #fed6e3, #fbc2eb, #a6c1ee);
        border-radius: 40px;
        z-index: -1;
        opacity: 0.7;
        filter: blur(25px);
        animation: glow 3s ease-in-out infinite;
    }

    @keyframes glow {
        0%, 100% { opacity: 0.7; }
        50% { opacity: 1; }
    }

    h1 {
        text-align: center;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 50%, #f093fb 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        margin-bottom: 15px;
        font-size: 40px;
        font-weight: 900;
        letter-spacing: -1.5px;
    }

    p {
        text-align: center;
        color: #8e9aaf;
        font-size: 14px;
        margin-bottom: 35px;
        font-weight: 500;
    }

    section {
        text-align: center;
        margin-bottom: 35px;
        padding-bottom: 25px;
        border-bottom: 2px solid #e8f4f8;
    }

    .profile-upload {
        position: relative;
        width: 140px;
        height: 140px;
        margin: 0 auto 20px;
        border-radius: 50%;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 50%, #f093fb 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 52px;
        color: white;
        font-weight: 800;
        box-shadow: 0 20px 50px rgba(102, 126, 234, 0.4);
        border: 5px solid white;
        cursor: pointer;
        overflow: hidden;
        transition: all 0.3s ease;
    }

    .profile-upload:hover {
        transform: scale(1.05);
        box-shadow: 0 25px 60px rgba(102, 126, 234, 0.5);
    }

    .profile-upload img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .profile-upload input[type="file"] {
        position: absolute;
        width: 100%;
        height: 100%;
        opacity: 0;
        cursor: pointer;
    }

    .upload-hint {
        color: #667eea;
        font-size: 12px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 1.5px;
    }

    form {
        display: flex;
        flex-direction: column;
        gap: 22px;
    }

    label {
        color: #667eea;
        font-size: 12px;
        font-weight: 700;
        margin-bottom: 8px;
        display: block;
        text-transform: uppercase;
        letter-spacing: 1.5px;
    }

    input, textarea {
        width: 100%;
        padding: 16px 22px;
        border: 2px solid #e8f4f8;
        border-radius: 18px;
        font-size: 15px;
        transition: all 0.3s ease;
        font-family: inherit;
        background: #f8fcff;
        color: #2d3436;
    }

    input:hover, textarea:hover {
        border-color: #d4edfa;
    }

    input:focus, textarea:focus {
        outline: none;
        border-color: #a8edea;
        background: #ffffff;
        transform: translateY(-2px);
        box-shadow: 0 15px 40px rgba(102, 126, 234, 0.2);
    }

    input::placeholder, textarea::placeholder {
        color: #c7d8e8;
    }

    textarea {
        min-height: 120px;
        resize: vertical;
    }

    footer {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 18px;
        margin-top: 30px;
    }

    button {
        padding: 18px;
        border: none;
        border-radius: 18px;
        font-size: 14px;
        font-weight: 800;
        cursor: pointer;
        transition: all 0.3s ease;
        text-transform: uppercase;
        letter-spacing: 2px;
        color: white;
    }

    button[type="submit"] {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        box-shadow: 0 15px 40px rgba(102, 126, 234, 0.4);
    }

    button[type="submit"]:hover {
        transform: translateY(-4px);
        box-shadow: 0 20px 50px rgba(102, 126, 234, 0.5);
    }

    button[type="button"] {
        background: linear-gradient(135deg, #8e9aaf 0%, #aab5c5 100%);
        box-shadow: 0 15px 40px rgba(142, 154, 175, 0.3);
    }

    button[type="button"]:hover {
        transform: translateY(-4px);
        box-shadow: 0 20px 50px rgba(142, 154, 175, 0.4);
    }

    @media (max-width: 768px) {
        main {
            padding: 45px 35px;
        }

        h1 {
            font-size: 32px;
        }

        footer {
            grid-template-columns: 1fr;
        }

        .profile-upload {
            width: 120px;
            height: 120px;
            font-size: 44px;
        }
    }

    @media (max-width: 480px) {
        main {
            padding: 35px 25px;
        }

        h1 {
            font-size: 28px;
        }

        input, textarea {
            padding: 14px 18px;
        }
    }
</style>

<main>
    <h1>Edit Profile</h1>
    <p>Update your personal information</p>

    <form method="POST" action="{{ route('blog.update') }}" enctype="multipart/form-data">
        @csrf
       

        <section>
            <div class="profile-upload">
                
                    @if($user->profile_img)
                    <img src="{{ asset('storage/' . $user->profile_img) }}" alt="{{ $user->name }}" style="width: 100%; height: 100%; object-fit: cover; border-radius: 50%;">
                @else
                    {{ getInitials($user->name) }}
                @endif
                
                <input type="file" name="profile_img" id="profileImage" accept="image/*">
            </div>
            <div class="upload-hint">Click to upload photo</div>
        </section>

        <div>
            <label for="name">Full Name</label>
            <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}" placeholder="Enter your full name" required>
            @error('name')
                <span style="color: #ff6b6b; font-size: 12px; margin-top: 5px; display: block;">{{ $message }}</span>
            @enderror
        </div>

        <div>
            <label for="email">Email Address</label>
            <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" placeholder="your.email@example.com" required>
            @error('email')
                <span style="color: #ff6b6b; font-size: 12px; margin-top: 5px; display: block;">{{ $message }}</span>
            @enderror
        </div>

        <div>
            <label for="phone_num">Phone Number</label>
            <input type="tel" id="phone_num" name="phone_num" value="{{ old('phone_num', $user->phone_num) }}" placeholder="+1 (555) 000-0000" required>
            @error('phone_num')
                <span style="color: #ff6b6b; font-size: 12px; margin-top: 5px; display: block;">{{ $message }}</span>
            @enderror
        </div>

        <div>
            <label for="bio">Bio (Optional)</label>
            <textarea id="bio" name="bio" placeholder="Tell us about yourself..."></textarea>
            @error('bio')
                <span style="color: #ff6b6b; font-size: 12px; margin-top: 5px; display: block;">{{ $message }}</span>
            @enderror
        </div>

        <footer>
            <button type="submit">Save Changes</button>
            <button type="button" onclick="window.location.href='{{ route('blog.dashboard') }}'">Cancel</button>
        </footer>
    </form>
</main>

<script>
    // Profile image preview
    document.getElementById('profileImage').addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                const preview = document.getElementById('profilePreview');
                const initials = document.getElementById('initials');
                
                if (preview) {
                    preview.src = e.target.result;
                } else {
                    const profileUpload = document.querySelector('.profile-upload');
                    if (initials) initials.style.display = 'none';
                    const img = document.createElement('img');
                    img.id = 'profilePreview';
                    img.src = e.target.result;
                    profileUpload.insertBefore(img, profileUpload.firstChild);
                }
            };
            reader.readAsDataURL(file);
        }
    });
</script>

@endsection