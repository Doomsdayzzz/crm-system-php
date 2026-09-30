@extends('layouts.main')

@section('content')
    <div class="auth-wrapper">
        <div class="auth-card">
{{--             Левая часть с брендингом--}}
            <div class="auth-side">
                <div class="auth-side-content">
                    <h1 class="auth-logo">Welcome Back</h1>
                    <p class="auth-subtitle">Войдите в свой аккаунт, чтобы продолжить</p>
                    <div class="auth-decoration">
                        <span></span><span></span><span></span>
                    </div>
                </div>
            </div>

{{--             Правая часть с формой--}}
            <div class="auth-form-side">
                <div class="auth-header">
                    <h2>{{ __('Вход') }}</h2>
                    <p>Введите свои данные ниже</p>
                </div>

                <form method="POST" action="{{ route('login') }}" class="auth-form">
                    @csrf

                    <div class="form-group">
                        <label for="email">{{ __('Email') }}</label>
                        <div class="input-wrap">
                            <svg class="input-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/>
                                <polyline points="22,6 12,13 2,6"/>
                            </svg>
                            <input
                                id="email"
                                type="email"
                                class="@error('email') is-invalid @enderror"
                                name="email"
                                value="{{ old('email') }}"
                                placeholder="you@example.com"
                                required
                                autocomplete="email"
                                autofocus
                            >
                        </div>
                        @error('email')
                        <span class="error-msg">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="password">{{ __('Пароль') }}</label>
                        <div class="input-wrap">
                            <svg class="input-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <rect x="3" y="11" width="18" height="11" rx="2" ry="2"/>
                                <path d="M7 11V7a5 5 0 0 1 10 0v4"/>
                            </svg>
                            <input
                                id="password"
                                type="password"
                                class="@error('password') is-invalid @enderror"
                                name="password"
                                placeholder="••••••••"
                                required
                                autocomplete="current-password"
                            >
                        </div>
                        @error('password')
                        <span class="error-msg">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-row">
                        <label class="checkbox">
                            <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                            <span class="checkmark"></span>
                            {{ __('Запомнить меня') }}
                        </label>

                        @if (Route::has('password.request'))
                            <a class="forgot-link" href="{{ route('password.request') }}">
                                {{ __('Забыли пароль?') }}
                            </a>
                        @endif
                    </div>

                    <button type="submit" class="btn-submit">
                        {{ __('Войти') }}
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <line x1="5" y1="12" x2="19" y2="12"/>
                            <polyline points="12 5 19 12 12 19"/>
                        </svg>
                    </button>

                    @if (Route::has('register'))
                        <p class="auth-footer">
                            Нет аккаунта? <a href="{{ route('register') }}">Зарегистрироваться</a>
                        </p>
                    @endif
                </form>
            </div>
        </div>
    </div>

    <style>
        /* ===== Общий контейнер ===== */
        .auth-wrapper {
            min-height: calc(100vh - 80px);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px 20px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            font-family: 'Segoe UI', -apple-system, BlinkMacSystemFont, sans-serif;
        }

        /* ===== Карточка ===== */
        .auth-card {
            display: grid;
            grid-template-columns: 1fr 1.2fr;
            max-width: 900px;
            width: 100%;
            background: #fff;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 25px 60px rgba(0, 0, 0, 0.25);
            animation: fadeUp 0.6s ease;
        }

        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(30px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        /* ===== Левая панель ===== */
        .auth-side {
            background: linear-gradient(160deg, #4f46e5 0%, #7c3aed 100%);
            color: #fff;
            padding: 50px 40px;
            display: flex;
            align-items: center;
            position: relative;
            overflow: hidden;
        }

        .auth-side::before {
            content: '';
            position: absolute;
            width: 300px;
            height: 300px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.1);
            top: -100px;
            right: -100px;
        }

        .auth-side::after {
            content: '';
            position: absolute;
            width: 200px;
            height: 200px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.08);
            bottom: -80px;
            left: -60px;
        }

        .auth-side-content { position: relative; z-index: 1; }

        .auth-logo {
            font-size: 32px;
            font-weight: 700;
            margin: 0 0 12px;
            letter-spacing: -0.5px;
        }

        .auth-subtitle {
            font-size: 15px;
            opacity: 0.85;
            line-height: 1.5;
            margin: 0;
        }

        .auth-decoration {
            margin-top: 40px;
            display: flex;
            gap: 8px;
        }

        .auth-decoration span {
            width: 40px;
            height: 4px;
            border-radius: 4px;
            background: rgba(255, 255, 255, 0.4);
        }

        .auth-decoration span:first-child {
            background: #fff;
            width: 60px;
        }

        /* ===== Правая панель (форма) ===== */
        .auth-form-side {
            padding: 50px 45px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .auth-header { margin-bottom: 30px; }

        .auth-header h2 {
            font-size: 26px;
            font-weight: 700;
            color: #1f2937;
            margin: 0 0 6px;
        }

        .auth-header p {
            font-size: 14px;
            color: #6b7280;
            margin: 0;
        }

        /* ===== Поля формы ===== */
        .form-group { margin-bottom: 20px; }

        .form-group label {
            display: block;
            font-size: 13px;
            font-weight: 600;
            color: #374151;
            margin-bottom: 8px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .input-wrap {
            position: relative;
            display: flex;
            align-items: center;
        }

        .input-icon {
            position: absolute;
            left: 14px;
            width: 18px;
            height: 18px;
            color: #9ca3af;
            pointer-events: none;
            transition: color 0.2s;
        }

        .input-wrap input {
            width: 100%;
            padding: 12px 14px 12px 42px;
            border: 1.5px solid #e5e7eb;
            border-radius: 10px;
            font-size: 15px;
            color: #1f2937;
            background: #f9fafb;
            transition: all 0.2s;
            outline: none;
        }

        .input-wrap input::placeholder { color: #9ca3af; }

        .input-wrap input:focus {
            border-color: #6366f1;
            background: #fff;
            box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.12);
        }

        .input-wrap input:focus ~ .input-icon,
        .input-wrap input:focus + .input-icon {
            color: #6366f1;
        }

        .input-wrap input.is-invalid {
            border-color: #ef4444;
            background: #fef2f2;
        }

        .error-msg {
            display: block;
            color: #ef4444;
            font-size: 13px;
            margin-top: 6px;
        }

        /* ===== Строка remember + forgot ===== */
        .form-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 24px;
            flex-wrap: wrap;
            gap: 10px;
        }

        .checkbox {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 14px;
            color: #4b5563;
            cursor: pointer;
            user-select: none;
        }

        .checkbox input {
            width: 16px;
            height: 16px;
            accent-color: #6366f1;
            cursor: pointer;
        }

        .forgot-link {
            font-size: 14px;
            color: #6366f1;
            text-decoration: none;
            font-weight: 500;
            transition: color 0.2s;
        }

        .forgot-link:hover {
            color: #4f46e5;
            text-decoration: underline;
        }

        /* ===== Кнопка ===== */
        .btn-submit {
            width: 100%;
            padding: 13px;
            border: none;
            border-radius: 10px;
            background: linear-gradient(135deg, #6366f1 0%, #7c3aed 100%);
            color: #fff;
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            transition: transform 0.15s, box-shadow 0.2s;
            box-shadow: 0 6px 18px rgba(99, 102, 241, 0.35);
        }

        .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 24px rgba(99, 102, 241, 0.45);
        }

        .btn-submit:active { transform: translateY(0); }

        /* ===== Футер ===== */
        .auth-footer {
            text-align: center;
            margin-top: 24px;
            font-size: 14px;
            color: #6b7280;
        }

        .auth-footer a {
            color: #6366f1;
            font-weight: 600;
            text-decoration: none;
        }

        .auth-footer a:hover { text-decoration: underline; }

        /* ===== Адаптив ===== */
        @media (max-width: 768px) {
            .auth-card { grid-template-columns: 1fr; }
            .auth-side { padding: 35px 30px; text-align: center; }
            .auth-decoration { justify-content: center; }
            .auth-form-side { padding: 35px 25px; }
        }
    </style>
@endsection
