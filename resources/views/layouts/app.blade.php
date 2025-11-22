<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title' , 'Blog System')</title>
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
            max-width: 520px;
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

        input {
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

        input:hover {
            border-color: #d4edfa;
        }

        input:focus {
            outline: none;
            border-color: #a8edea;
            background: #ffffff;
            transform: translateY(-2px);
            box-shadow: 0 15px 40px rgba(102, 126, 234, 0.2);
        }

        input::placeholder {
            color: #c7d8e8;
        }

        button {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 50%, #f093fb 100%);
            color: white;
            padding: 18px;
            border: none;
            border-radius: 18px;
            font-size: 15px;
            font-weight: 800;
            cursor: pointer;
            transition: all 0.3s ease;
            text-transform: uppercase;
            letter-spacing: 2.5px;
            box-shadow: 0 18px 45px rgba(102, 126, 234, 0.4);
            margin-top: 12px;
        }

        button:hover {
            transform: translateY(-4px);
            box-shadow: 0 25px 55px rgba(102, 126, 234, 0.5);
        }

        button:active {
            transform: translateY(-2px);
        }

        a{
            text-decoration: none;
            color: white;
        }

        @media (max-width: 768px) {
            main {
                padding: 45px 35px;
            }

            h1 {
                font-size: 32px;
            }
        }

        @media (max-width: 480px) {
            main {
                padding: 35px 25px;
            }

            h1 {
                font-size: 28px;
            }

            input {
                padding: 14px 18px;
            }
        }
    </style>
</head>
    <body>

        @if(session('success'))
        <div class="notification is-primary">session('success')</div>
        @endif

        @yield('content')

    </body>
</html>