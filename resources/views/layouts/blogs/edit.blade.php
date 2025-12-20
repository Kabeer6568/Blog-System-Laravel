@extends('layouts/app')

@section('title', 'Edit Blog')

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

    input[type="text"],
    textarea {
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

    input[type="text"]:hover,
    textarea:hover {
        border-color: #d4edfa;
    }

    input[type="text"]:focus,
    textarea:focus {
        outline: none;
        border-color: #a8edea;
        background: #ffffff;
        transform: translateY(-2px);
        box-shadow: 0 15px 40px rgba(102, 126, 234, 0.2);
    }

    input[type="text"]::placeholder,
    textarea::placeholder {
        color: #c7d8e8;
    }

    textarea {
        min-height: 150px;
        resize: vertical;
    }

    /* File Upload Styling */
    .file-upload-wrapper {
        position: relative;
        width: 100%;
    }

    .file-upload-area {
        width: 100%;
        min-height: 250px;
        border: 3px dashed #e8f4f8;
        border-radius: 18px;
        background: #f8fcff;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }

    .file-upload-area:hover {
        border-color: #a8edea;
        background: #ffffff;
        transform: translateY(-2px);
        box-shadow: 0 15px 40px rgba(102, 126, 234, 0.15);
    }

    .file-upload-area.has-image {
        min-height: 350px;
        border-style: solid;
        border-color: #a8edea;
    }

    input[type="file"] {
        position: absolute;
        width: 100%;
        height: 100%;
        opacity: 0;
        cursor: pointer;
        z-index: 2;
    }

    .upload-placeholder {
        text-align: center;
        pointer-events: none;
    }

    .upload-icon {
        font-size: 56px;
        margin-bottom: 15px;
    }

    .upload-text {
        color: #667eea;
        font-size: 16px;
        font-weight: 700;
        margin-bottom: 8px;
    }

    .upload-hint {
        color: #8e9aaf;
        font-size: 13px;
        font-weight: 500;
    }

    .current-image-label {
        color: #667eea;
        font-size: 11px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 1.5px;
        margin-bottom: 10px;
        text-align: center;
    }

    .image-preview {
        display: none;
        width: 100%;
        height: 100%;
        position: relative;
    }

    .image-preview.active {
        display: block;
    }

    .preview-img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        border-radius: 15px;
    }

    .remove-image {
        position: absolute;
        top: 15px;
        right: 15px;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        border: none;
        width: 45px;
        height: 45px;
        border-radius: 50%;
        cursor: pointer;
        font-size: 22px;
        font-weight: 700;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 8px 25px rgba(102, 126, 234, 0.4);
        transition: all 0.3s ease;
        z-index: 3;
    }

    .remove-image:hover {
        transform: scale(1.15) rotate(90deg);
        box-shadow: 0 12px 35px rgba(102, 126, 234, 0.5);
    }

    .change-image-hint {
        position: absolute;
        bottom: 15px;
        left: 50%;
        transform: translateX(-50%);
        background: rgba(255, 255, 255, 0.95);
        padding: 8px 16px;
        border-radius: 12px;
        color: #667eea;
        font-size: 12px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 1px;
        box-shadow: 0 5px 15px rgba(102, 126, 234, 0.2);
        pointer-events: none;
    }

    .button-group {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 18px;
        margin-top: 15px;
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

        .button-group {
            grid-template-columns: 1fr;
        }

        .file-upload-area {
            min-height: 220px;
        }

        .file-upload-area.has-image {
            min-height: 300px;
        }
    }

    @media (max-width: 480px) {
        main {
            padding: 35px 25px;
        }

        h1 {
            font-size: 28px;
        }

        input[type="text"],
        textarea {
            padding: 14px 18px;
        }

        .file-upload-area {
            min-height: 200px;
        }

        .upload-icon {
            font-size: 48px;
        }
    }
</style>

<main>
    <h1>Edit Blog</h1>
    <p>Update your blog post</p>
    
    <form method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div>
            <label for="featured_image">Featured Image</label>
            <div class="file-upload-wrapper">
                <div class="file-upload-area has-image" id="uploadArea">
                    <input type="file" id="featured_image" name="featured_image" accept="image/*">
                    
                    <div class="upload-placeholder" id="placeholder" style="display: none;">
                        <div class="upload-icon">🖼️</div>
                        <div class="upload-text">Click to upload new image</div>
                        <div class="upload-hint">Supports: JPG, PNG, GIF (Max 5MB)</div>
                    </div>

                    <div class="image-preview active" id="imagePreview">
                        {{-- Display current blog image --}}
                        <img src="{{ asset('storage/sample-blog.jpg') }}" alt="Current Blog Image" class="preview-img" id="previewImg">
                        <button type="button" class="remove-image" id="removeBtn">×</button>
                        <div class="change-image-hint">Click to change</div>
                    </div>
                </div>
            </div>
        </div>

        <div>
            <label for="title">Blog Title</label>
            <input type="text" id="title" name="title" value="The Future of Web Development" placeholder="Enter blog title" required>
        </div>

        <div>
            <label for="description">Blog Description</label>
            <textarea id="description" name="description" placeholder="Write your blog description here..." required>Explore the latest trends and technologies shaping the future of web development. From AI integration to modern frameworks, discover what's next in the world of coding.</textarea>
        </div>

        <div class="button-group">
            <button type="submit">Update Blog</button>
            <button type="button">Cancel</button>
        </div>
    </form>
</main>

<script>
    const fileInput = document.getElementById('featured_image');
    const uploadArea = document.getElementById('uploadArea');
    const placeholder = document.getElementById('placeholder');
    const imagePreview = document.getElementById('imagePreview');
    const previewImg = document.getElementById('previewImg');
    const removeBtn = document.getElementById('removeBtn');

    // Store original image URL
    const originalImageSrc = previewImg.src;

    // Handle file selection (change image)
    fileInput.addEventListener('change', function(e) {
        const file = e.target.files[0];
        
        if (file) {
            // Check file size (5MB max)
            if (file.size > 5 * 1024 * 1024) {
                alert('File size must be less than 5MB');
                fileInput.value = '';
                return;
            }

            // Check file type
            if (!file.type.match('image.*')) {
                alert('Please select an image file');
                fileInput.value = '';
                return;
            }

            // Read and display new image
            const reader = new FileReader();
            reader.onload = function(e) {
                previewImg.src = e.target.result;
                placeholder.style.display = 'none';
                imagePreview.classList.add('active');
                uploadArea.classList.add('has-image');
            };
            reader.readAsDataURL(file);
        }
    });

    // Remove image (revert to placeholder or keep original)
    removeBtn.addEventListener('click', function(e) {
        e.stopPropagation();
        e.preventDefault();
        
        // Clear file input
        fileInput.value = '';
        
        // Revert to original image
        previewImg.src = originalImageSrc;
        
        // Show placeholder if you want to remove completely
        // placeholder.style.display = 'flex';
        // imagePreview.classList.remove('active');
        // uploadArea.classList.remove('has-image');
    });
</script>

@endsection