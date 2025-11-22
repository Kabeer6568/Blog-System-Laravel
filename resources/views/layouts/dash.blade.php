@extends('layouts/app')

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
            margin-bottom: 45px;
            font-size: 40px;
            font-weight: 900;
            letter-spacing: -1.5px;
        }

        section {
            text-align: center;
            margin-bottom: 40px;
            padding-bottom: 30px;
            border-bottom: 2px solid #e8f4f8;
        }

        div[class^="profile"] {
            margin: 0 auto;
        }

        .profile {
            position: relative;
            width: 140px;
            height: 140px;
            margin: 0 auto 25px;
            border-radius: 50%;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 50%, #f093fb 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 52px;
            color: white;
            font-weight: 800;
            box-shadow: 0 20px 50px rgba(102, 126, 234, 0.4);
            animation: float 3s ease-in-out infinite;
            border: 5px solid white;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0) scale(1); }
            50% { transform: translateY(-12px) scale(1.03); }
        }

        h2 {
            font-size: 32px;
            font-weight: 900;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 8px;
        }

        p {
            color: #8e9aaf;
            font-size: 14px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 2px;
        }

        article {
            display: grid;
            gap: 20px;
            margin-bottom: 35px;
        }

        article > div {
            background: linear-gradient(145deg, #ffffff 0%, #f8fcff 100%);
            border: 2px solid #e8f4f8;
            border-radius: 22px;
            padding: 22px 26px;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
            text-align: left;
        }

        article > div::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 5px;
            height: 100%;
            background: linear-gradient(180deg, #667eea, #764ba2);
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        article > div:hover {
            border-color: #a8edea;
            transform: translateX(8px);
            box-shadow: 0 15px 40px rgba(102, 126, 234, 0.2);
        }

        article > div:hover::before {
            opacity: 1;
        }

        label {
            color: #667eea;
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1.8px;
            margin-bottom: 10px;
            display: block;
        }

        span {
            color: #2d3436;
            font-size: 17px;
            font-weight: 700;
            display: block;
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

        button:first-of-type {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            box-shadow: 0 15px 40px rgba(102, 126, 234, 0.4);
        }

        button:first-of-type:hover {
            transform: translateY(-4px);
            box-shadow: 0 20px 50px rgba(102, 126, 234, 0.5);
        }

        button:last-of-type {
            background: linear-gradient(135deg, #764ba2 0%, #f093fb 100%);
            box-shadow: 0 15px 40px rgba(118, 75, 162, 0.4);
        }

        button:last-of-type:hover {
            transform: translateY(-4px);
            box-shadow: 0 20px 50px rgba(118, 75, 162, 0.5);
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

            div:first-of-type {
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

            h2 {
                font-size: 26px;
            }
        }
    </style>
<main>
        <h1>Dashboard</h1>
        
        <section>
            <div class="profile">JD</div>
            <h2>John Doe</h2>
            <p>Content Creator</p>
        </section>

        <article>
            <div>
                <label>Email Address</label>
                <span>john.doe@example.com</span>
            </div>
            <div>
                <label>Phone Number</label>
                <span>+1 (555) 123-4567</span>
            </div>
            <div>
                <label>Blogs Uploaded</label>
                <span>24 Articles Published</span>
            </div>
        </article>

        <footer>
            <button>Upload Blogs</button>
            <button>Update Profile</button>
        </footer>
    </main>

    @endsection