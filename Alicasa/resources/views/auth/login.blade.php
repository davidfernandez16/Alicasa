@extends('layouts.app')

@section('title', 'Iniciar Sesión')

@section('content')
<style>
    body{
        background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
        background-attachment: fixed;
    }
    .container {
        display: flex;
        flex-direction: column;
        font-family: "arial";
        min-height: 300px;
        box-shadow: 0px 0px 15px 10px rgba(0, 0, 0, 0.1);
        width: 80%;
        margin:80px auto 20px;
        align-items: center;
        padding: 25px;
        border: 3px solid #003f5c;
        border-radius: 12px;
        background-color: white;
    }
    .titulo {
        color: #009FA8;
        text-align: center;
        font-size: 35px;
        font-weight: bold;
        margin-bottom: 30px;
        text-transform: uppercase;
        letter-spacing: 1px;
    }
    .form-container {
        max-width: 600px;
        margin: 0 auto;
    }
    .form-group {
        margin-bottom: 20px;
        position: relative;
    }
    .form-group label {
        display: block;
        font-weight: bold;
        margin-bottom: 5px;
        color: #555;
    }
    .form-control {
        width: 100%;
        padding: 10px;
        border: 1px solid #ddd;
        border-radius: 6px;
        box-sizing: border-box;
        font-size: 14px;
        transition: border 0.3s;
        padding-right: 40px;
    }
    .form-control:focus {
        border-color: #009FA8;
        outline: none;
        box-shadow: 0 0 0 2px rgba(0, 159, 168, 0.2);
    }
    .password-toggle {
        position: absolute;
        right: 10px;
        top: 70%;
        transform: translateY(-50%);
        transition: all 0.3s ease-in-out;
        cursor: pointer;
        color: #777;
    }
    .password-toggle:hover {
        color: #009FA8;
    }
    .checkbox-group {
        margin: 20px 0;
    }
    .checkbox-label {
        display: inline-flex;
        align-items: center;
        margin-right: 25px;
        cursor: pointer;
        color: #555;
    }
    .checkbox-label input {
        margin-right: 8px;
        accent-color: #009FA8;
    }
    .submit-btn {
        background-color: #009FA8;
        color: white;
        padding: 12px 25px;
        border: 2px solid #009FA8;
        border-radius: 50px;
        cursor: pointer;
        font-size: 16px;
        display: block;
        margin: 30px auto 0;
        transition: all 0.3s ease-in-out;
        font-weight: bold;
    }
    .submit-btn:hover {
        background-color: white;
        color : #009FA8;
    }
    hr {
        border: 0;
        height: 1px;
        background: linear-gradient(to right, transparent, #009FA8, transparent);
        margin: 25px 0;
    }
    .registro-link {
        text-align: center;
        margin-top: 20px;
        font-size: 14px;
    }
    .registro-link a {
        color: #009FA8;
        text-decoration: none;
        font-weight: bold;
    }
    .registro-link a:hover {
        text-decoration: underline;
    }
    .recover-password {
        text-align: center;
        margin-top: 15px;
    }
    .recover-password a {
        color: #009FA8;
        text-decoration: none;
    }
    .recover-password a:hover {
        text-decoration: underline;
    }
</style>

<div class="container-login">
    <div class="titulo">Iniciar Sesión</div>

    <div class="form-container">
        @if ($errors->any())
            <div style="color: red; margin-bottom: 20px;">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="form-group">
                <label for="email">EMAIL</label>
                <input id="email" type="email"
                       class="form-control @error('email') is-invalid @enderror"
                       name="email" value="{{ old('email') }}" required autofocus>
                @error('email')
                    <div style="color:red;">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="password">CONTRASEÑA</label>
                <input id="password" type="password"
                       class="form-control @error('password') is-invalid @enderror"
                       name="password" required>
                <span class="password-toggle" onclick="togglePassword()">
                    <i class="fas fa-eye"></i>
                </span>
                @error('password')
                    <div style="color:red;">{{ $message }}</div>
                @enderror
            </div>


            <button type="submit" class="submit-btn">Iniciar Sesión</button>

            @if (Route::has('password.request'))
                <div class="recover-password">
                    <a href="{{ route('password.request') }}">
                        ¿Olvidaste tu contraseña?
                    </a>
                </div>
            @endif

            <div class="registro-link">
                ¿No estás registrado? <a href="{{ route('register') }}">Pulsa aquí</a>
            </div>
        </form>
    </div>
</div>

<script>
    function togglePassword() {
        const input = document.getElementById('password');
        const icon = document.querySelector('.password-toggle i');
        if (input.type === 'password') {
            input.type = 'text';
            icon.classList.replace('fa-eye', 'fa-eye-slash');
        } else {
            input.type = 'password';
            icon.classList.replace('fa-eye-slash', 'fa-eye');
        }
    }
</script>

<!-- Font Awesome para el ojo -->
<link rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
@endsection