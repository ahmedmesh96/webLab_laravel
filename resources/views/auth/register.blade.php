
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Account | WebLabStudios</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            min-height: 100vh;
            background: #080a08;
            color: #f4f7f2;
            font-family: Arial, Helvetica, sans-serif;
        }

        .register-page {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 35px 20px;
            background:
                radial-gradient(ellipse at 50% 0%,
                    rgba(100, 255, 80, 0.10), transparent 50%),
                #080a08;
        }

        .register-container {
            width: 100%;
            max-width: 460px;
        }

        .brand {
            text-align: center;
            margin-bottom: 28px;
        }

        .brand-logo-link {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 12px;
        }

        .company-logo {
            display: block;
            width: 220px;
            max-width: 100%;
            max-height: 100px;
            height: auto;
            object-fit: contain;
        }

        .brand p {
            margin: 0;
            color: #858b83;
            font-size: 14px;
        }

        .register-card {
            padding: 34px;
            border: 1px solid #242a23;
            border-radius: 20px;
            background: rgba(17, 20, 16, 0.95);
            box-shadow: 0 25px 80px rgba(0, 0, 0, 0.35);
        }

        .register-card h1 {
            margin: 0 0 8px;
            font-size: 27px;
            font-weight: 800;
        }

        .subtitle {
            margin: 0 0 27px;
            color: #858b83;
            font-size: 14px;
            line-height: 1.6;
        }

        .field {
            margin-bottom: 19px;
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

        .register-button {
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

        .register-button:hover {
            background: #a8ff8b;
            transform: translateY(-1px);
        }

        .login-link {
            margin-top: 24px;
            text-align: center;
            color: #858b83;
            font-size: 13px;
        }

        .login-link a {
            color: #8dff67;
            text-decoration: none;
            font-weight: 600;
        }

        .login-link a:hover {
            color: #b7ffa0;
            text-decoration: underline;
        }

        .footer {
            margin-top: 24px;
            text-align: center;
            color: #565d54;
            font-size: 11px;
        }

        @media (max-width: 480px) {
            .register-card {
                padding: 25px 20px;
            }

            .register-card h1 {
                font-size: 24px;
            }

            .company-logo {
                width: 190px;
            }
        }
    </style>
</head>

<body>
    <main class="register-page">
        <div class="register-container">

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

            <section class="register-card">
                <h1>Create your account</h1>
                <p class="subtitle">
                    Join WebLabStudios and start building something extraordinary.
                </p>

                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <div class="field">
                        <label for="name">Full name</label>
                        <input
                            id="name"
                            type="text"
                            name="name"
                            value="{{ old('name') }}"
                            placeholder="Enter your full name"
                            required
                            autofocus
                            autocomplete="name"
                        >
                        @error('name')
                            <p class="field-error">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="field">
                        <label for="email">Email address</label>
                        <input
                            id="email"
                            type="email"
                            name="email"
                            value="{{ old('email') }}"
                            placeholder="you@example.com"
                            required
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
                            placeholder="Create a password"
                            required
                            autocomplete="new-password"
                        >
                        @error('password')
                            <p class="field-error">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="field">
                        <label for="password_confirmation">Confirm password</label>
                        <input
                            id="password_confirmation"
                            type="password"
                            name="password_confirmation"
                            placeholder="Enter your password again"
                            required
                            autocomplete="new-password"
                        >
                        @error('password_confirmation')
                            <p class="field-error">{{ $message }}</p>
                        @enderror
                    </div>

                    <button class="register-button" type="submit">
                        Create your account →
                    </button>
                </form>

                <div class="login-link">
                    Already have an account?
                    <a href="{{ route('login') }}">Sign in</a>
                </div>
            </section>

            <footer class="footer">
                © {{ date('Y') }} WebLabStudios. All rights reserved.
            </footer>

        </div>
    </main>
</body>
</html>
