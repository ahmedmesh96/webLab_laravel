```blade
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Login | WebLabStudios</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            margin: 0;
            min-height: 100vh;
            background: #080a08;
            color: #f4f7f2;
            font-family: Arial, Helvetica, sans-serif;
        }

        .login-page {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 24px;
            box-sizing: border-box;
            background:
                radial-gradient(ellipse at 50% 0%,
                    rgba(100, 255, 80, 0.10), transparent 50%),
                #080a08;
        }

        .login-container {
            width: 100%;
            max-width: 430px;
        }

        .brand {
            text-align: center;
            margin-bottom: 32px;
        }

        .brand-icon {
            width: 54px;
            height: 54px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 16px;
            border: 1px solid rgba(125, 255, 85, 0.4);
            border-radius: 16px;
            color: #8dff67;
            font-size: 25px;
            font-weight: bold;
            background: rgba(125, 255, 85, 0.08);
            box-shadow: 0 0 30px rgba(125, 255, 85, 0.08);
        }



.brand-logo-link {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 16px;
}

.company-logo {
    display: block;
    width: 300px;
    max-width: 100%;
    max-height: 120px;
    height: auto;
    object-fit: contain;
}

.brand p {
    margin-top: 10px;
    color: #858b83;
    font-size: 14px;
}


        /*  */

        .brand h1 {
            margin: 0;
            font-size: 28px;
            font-weight: 800;
            letter-spacing: -1px;
        }

        .brand h1 span {
            color: #8dff67;
        }

        .brand p {
            margin-top: 10px;
            color: #858b83;
            font-size: 14px;
        }

        .login-card {
            padding: 34px;
            border: 1px solid #242a23;
            border-radius: 20px;
            background: rgba(17, 20, 16, 0.95);
            box-shadow: 0 25px 80px rgba(0, 0, 0, 0.35);
        }

        .login-card h2 {
            margin: 0 0 8px;
            font-size: 24px;
            font-weight: 700;
        }

        .subtitle {
            margin: 0 0 28px;
            color: #858b83;
            font-size: 14px;
        }

        .field {
            margin-bottom: 21px;
        }

        .field label {
            display: block;
            margin-bottom: 9px;
            color: #dce2d8;
            font-size: 13px;
            font-weight: 600;
        }

        .field input {
            display: block;
            width: 100%;
            padding: 14px 15px;
            box-sizing: border-box;
            border: 1px solid #30372e;
            border-radius: 10px;
            outline: none;
            background: #0b0e0a;
            color: #f4f7f2;
            font-size: 14px;
            transition: border-color 0.2s, box-shadow 0.2s;
        }

        .field input::placeholder {
            color: #646b61;
        }

        .field input:focus {
            border-color: #8dff67;
            box-shadow: 0 0 0 3px rgba(141, 255, 103, 0.09);
        }

        .field-error {
            margin-top: 7px;
            color: #ff7777;
            font-size: 12px;
        }

        .options {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            margin: 4px 0 25px;
            font-size: 12px;
        }

        .remember {
            display: flex;
            align-items: center;
            gap: 8px;
            color: #aeb5aa;
        }

        .remember input {
            accent-color: #8dff67;
        }

        .forgot {
            color: #8dff67;
            text-decoration: none;
        }

        .forgot:hover {
            color: #b7ffa0;
            text-decoration: underline;
        }

        .login-button {
            width: 100%;
            padding: 15px;
            border: 0;
            border-radius: 10px;
            background: #8dff67;
            color: #10160d;
            font-size: 14px;
            font-weight: 800;
            cursor: pointer;
            transition: background 0.2s, transform 0.2s;
        }

        .login-button:hover {
            background: #a8ff8b;
            transform: translateY(-1px);
        }

        .register-link {
            margin-top: 25px;
            text-align: center;
            color: #858b83;
            font-size: 13px;
        }

        .register-link a {
            color: #8dff67;
            text-decoration: none;
            font-weight: 600;
        }

        .footer {
            margin-top: 25px;
            text-align: center;
            color: #565d54;
            font-size: 11px;
        }

        .session-status {
            margin-bottom: 18px;
            color: #8dff67;
            font-size: 13px;
        }

        @media (max-width: 480px) {
            .login-page {
                padding: 18px;
            }

            .login-card {
                padding: 25px 20px;
            }

            .brand h1 {
                font-size: 25px;
            }
        }
    </style>
</head>

<body>
    <main class="login-page">
        <div class="login-container">

            {{-- <header class="brand">
                <div class="brand-icon">W</div>
                <h1>WebLab<span>Studios</span></h1>
                <p>Build something extraordinary.</p>
            </header> --}}

<header class="brand">
    <a href="{{ url('/') }}" class="brand-logo-link">
       <img
    src="{{ asset('build/assets/images/brand-original.png') }}"
    alt="WebLabStudios Logo"
    class="company-logo"
>
    </a>

    <p>Build something extraordinary.</p>
</header>


            <section class="login-card">
                <h2>Welcome back</h2>
                <p class="subtitle">Sign in to access your workspace.</p>

                <x-auth-session-status
                    class="session-status"
                    :status="session('status')"
                />

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="field">
                        <label for="email">Email address</label>

                        <input
                            id="email"
                            type="email"
                            name="email"
                            value="{{ old('email') }}"
                            placeholder="you@example.com"
                            required
                            autofocus
                            autocomplete="username"
                        >

                        @error('email')
                            <p class="field-error">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="field">
                        <label for="password">Password</label>

                        <input
                            id="password"
                            type="password"
                            name="password"
                            placeholder="Enter your password"
                            required
                            autocomplete="current-password"
                        >

                        @error('password')
                            <p class="field-error">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="options">
                        <label class="remember" for="remember">
                            <input
                                id="remember"
                                type="checkbox"
                                name="remember"
                            >
                            <span>Remember me</span>
                        </label>

                        @if (Route::has('password.request'))
                            <a
                                class="forgot"
                                href="{{ route('password.request') }}"
                            >
                                Forgot password?
                            </a>
                        @endif
                    </div>

                    <button class="login-button" type="submit">
                        Sign in to your account →
                    </button>
                </form>

                @if (Route::has('register'))
                    <div class="register-link">
                        Don't have an account?
                        <a href="{{ route('register') }}">Create one</a>
                    </div>
                @endif
            </section>

            <footer class="footer">
                © {{ date('Y') }} WebLabStudios. All rights reserved.
            </footer>

        </div>
    </main>
</body>
</html>
```
