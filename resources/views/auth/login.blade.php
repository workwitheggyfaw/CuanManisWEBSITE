<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Cuan Manis</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

<style>
     * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        html, body {
            height: 100%;
            font-family: 'Poppins', sans-serif;
        }

        body {
            display: flex;
            flex-direction: column;
        }

        nav {
            background-color: #FFF8C4;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 16px 30px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.05);
            font-family: 'Poppins', sans-serif;
        }

        nav .logo {
            height: 40px;
        }

        nav ul {
            list-style: none;
            display: flex;
            gap: 20px;
        }

        nav ul li a {
            text-decoration: none;
            color: #333;
            font-weight: 500;
            transition: color 0.3s ease;
        }

        nav ul li a:hover {
            color: #FF7B00;
        }

        nav .btn-login {
            padding: 8px 16px;
            background-color: #FF7B00;
            color: #fff;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 600;
            transition: background-color 0.3s ease;
        }

        nav .btn-login:hover {
            background-color: #e96d00;
        }

        main {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 40px 20px;
        }

        .login-container {
            width: 100%;
            max-width: 400px;
            padding: 30px;
            background: #fff;
            border-radius: 20px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .login-container h2 {
            color: #FF7B00;
            margin-bottom: 20px;
        }

        .login-container input {
            width: 100%;
            padding: 12px 14px;
            margin: 10px 0;
            border: 2px solid #FFBD59;
            border-radius: 10px;
            font-size: 14px;
        }

        .login-container button {
            background: #FF7B00;
            color: white;
            padding: 12px;
            width: 100%;
            border: none;
            border-radius: 12px;
            font-weight: bold;
            font-size: 15px;
            margin-top: 10px;
            cursor: pointer;
            transition: 0.3s;
        }

        .login-container button:hover {
            background: #e96d00;
        }

        .login-container .register-link {
            margin-top: 16px;
            font-size: 14px;
            color: #333;
        }

        .login-container .register-link a {
            color: #FF6B6B;
            text-decoration: none;
            font-weight: 600;
        }

        .login-container .register-link a:hover {
            text-decoration: underline;
        }

        footer {
            text-align: center;
            padding: 20px;
            background: #f5f5f5;
            color: #777;
            font-size: 14px;
        }

        @media (max-width: 600px) {
            nav {
                flex-direction: column;
                align-items: flex-start;
                gap: 10px;
            }

            nav ul {
                flex-direction: column;
                gap: 10px;
            }

            .login-container {
                padding: 20px;
            }
        }
    </style>
</head>
<body>

<nav>
    <img src="{{ asset('assets/web/logo_cuanmanis.png') }}" alt="Logo Cuan Manis" class="logo">
    <ul>
        <li><a href="{{ url('/') }}">Home</a></li>
        <li><a href="{{ url('/kos_market') }}">Eksplore Kost</a></li>
        <li><a href="{{ url('/barang_market') }}">Eksplore Preloved</a></li>
    </ul>
    <a href="{{ route('register') }}" class="btn-login">Register</a>
</nav>

<main>
    <div class="login-container">
        <h2>Masuk ke Akunmu</h2>
        @error('email')
            <div style="color: red; margin-bottom:10px;">
                {{ $message }}
            </div>
        @enderror

        <form action="{{ route('login') }}" method="POST">
            @csrf
            <input type="email" name="email" placeholder="Email" required />
            <input type="password" name="password" placeholder="Password" required />
            <button type="submit">Login</button>
        </form>
        <div class="register-link">
            Belum punya akun? <a href="{{ route('register') }}">Daftar Sekarang</a>
        </div>
    </div>
</main>

<footer>
    © 2025 Cuan Manis – Dibuat oleh mahasiswa, untuk mahasiswa.
</footer>

</body>
</html>
