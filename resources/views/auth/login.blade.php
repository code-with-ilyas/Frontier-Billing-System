<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>FRONTIER BILLING SYSTEM</title>

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('assets/assets/img/invoice.png') }}">

    <!-- Tailwind / Vite -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        .checkbox-row {
            display: flex;
            align-items: center;
            /* vertical align */
            gap: 8px;
            /* space between box and label */
            margin-bottom: 15px;
        }

        .checkbox-row input[type="checkbox"] {
            accent-color: #f9e45b;
            /* yellow theme checkbox */
            width: 18px;
            height: 18px;
            cursor: pointer;
        }

        .checkbox-row label {
            color: yellow;
            font-weight: bold;
            cursor: pointer;
        }

        :root {
            --bg-color: rgba(99, 79, 14, 0.8);
            --input-text: yellow;
            --placeholder-text: lightyellow;
        }

        body,
        html {
            margin: 0;
            padding: 0;
            height: 100vh;
            background-color: var(--bg-color);
        }

        .main-container {
            display: flex;
            height: 100vh;
            align-items: center;
            justify-content: center;
            gap: 40px;
            padding: 20px;
        }

        .logo-side img {
            height: 90vh;
            max-width: 100%;
            object-fit: contain;
        }

        .form-side {
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .nav-links-left {
            margin-bottom: 20px;
        }

        .nav-links-left a {
            color: yellow;
            font-weight: bold;
            text-decoration: none;
            padding: 6px 14px;
            border-radius: 5px;
            background-color: var(--bg-color);
            transition: 0.3s ease;
            box-shadow: 0 0 8px rgba(13, 233, 79, 0.6);
        }

        .nav-links-left a:hover {
            background-color: #f9e45b;
            /* light yellow hover */
            color: #222;
            box-shadow: 0 0 12px #f9e45b;
        }

        .login-form-container {
            background-color: var(--bg-color);
            padding: 2rem;
            border-radius: 10px;
            width: 400px;
            box-shadow: 0 4px 10px rgba(13, 233, 79, 0.89);
        }

        .login-form-container h4,
        .login-form-container label,
        .login-form-container a,
        .login-form-container .text-danger {
            color: yellow;
            font-weight: bold;
        }

        .hr-heading {
            border: none;
            height: 3px;
            margin: 0.8rem auto 1rem;
            width: 80%;
            border-radius: 50px;
            background: linear-gradient(to right, transparent, #b38b00, transparent);
            opacity: 0.8;
        }

        .login-form-container input {
            width: 100%;
            padding: 10px;
            margin-top: 6px;
            margin-bottom: 12px;
            border-radius: 5px;
            border: 1px solid #ccc;
            background: transparent;
            color: var(--input-text);
            box-shadow: 0 0 8px rgba(13, 233, 79, 0.89);
            transition: 0.3s ease;
        }

        .login-form-container input:focus {
            outline: none;
            box-shadow: 0 0 12px rgba(13, 233, 79, 1);
        }

        .login-form-container input::placeholder {
            color: var(--placeholder-text);
        }

        .checkbox-row {
            display: flex;
            align-items: center;
            gap: 6px;
            margin-bottom: 12px;
        }

        .btn-login {
            background-color: #f9e45b;
            /* yellow */
            color: #222;
            font-weight: bold;
            border: none;
            padding: 10px;
            border-radius: 5px;
            width: 100%;
            cursor: pointer;
            box-shadow: 0 0 8px #f9e45b;
            transition: 0.3s ease;
        }

        .btn-login:hover {
            background-color: #fbe97d;
            color: #000;
            box-shadow: 0 0 12px #fbe97d;
        }

        @media (max-width: 992px) {
            .main-container {
                flex-direction: column;
                height: auto;
            }

            .logo-side img {
                height: 250px;
                width: auto;
                max-width: 100%;
            }
        }
    </style>
</head>

<body>
    <div class="main-container">
        <!-- Logo side -->
        <div class="logo-side">
            <img src="{{ asset('assets/assets/img/invoice.png') }}" alt="System Logo">
        </div>

        <!-- Form side -->
        <div class="form-side">
            <!-- Home Button -->
            <div class="nav-links-left">
                <a href="{{ url('/') }}">🏠 Home</a>
            </div>

            <!-- Login Form -->
            <form method="POST" action="{{ route('login') }}" class="login-form-container">
                @csrf
                <h4 class="text-center mb-3">𝓛𝓞𝓖𝓘𝓝 𝓕𝓞𝓡𝓜</h4>
                <hr class="hr-heading">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" required autofocus
                    value="{{ old('email') }}" placeholder="Enter your email">
                @error('email')
                <div class="text-danger mt-1">{{ $message }}</div>
                @enderror

                <label for="password">Password</label>
                <input type="password" id="password" name="password" required
                    placeholder="Enter your password">
                @error('password')
                <div class="text-danger mt-1">{{ $message }}</div>
                @enderror

                <div class="checkbox-row">
                    <input type="checkbox" id="remember_me" name="remember">
                    <label for="remember_me">Remember me</label>
                </div>


                <div class="text-end mb-3">
                    @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}">Forgot your password?</a>
                    @endif
                </div>
                <br>

                <button type="submit" class="btn-login">LOGIN</button>
            </form>
        </div>
    </div>
</body>

</html>