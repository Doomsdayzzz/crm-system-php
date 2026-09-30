@extends('layouts.main')

@section('content')
    <div class="auth-wrapper register-theme">
        <div class="auth-card">
            {{-- Левая часть с брендингом --}}
            <div class="auth-side">
                <div class="auth-side-content">
                    <h1 class="auth-logo">Join Us</h1>
                    <p class="auth-subtitle">Создайте аккаунт и начните пользоваться всеми возможностями</p>
                    <div class="auth-decoration">
                        <span></span><span></span><span></span>
                    </div>
                </div>
            </div>

            {{-- Правая часть с формой --}}
            <div class="auth-form-side">
                <div class="auth-header">
                    <h2>{{ __('Регистрация') }}</h2>
                    <p>Заполните форму ниже</p>
                </div>

                <form method="POST" action="{{ route('register') }}" class="auth-form">
                    @csrf

                    {{-- Имя --}}
                    <div class="form-group">
                        <label for="name">{{ __('Имя') }}</label>
                        <div class="input-wrap">
                            <svg class="input-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/>
                                <circle cx="12" cy="7" r="4"/>
                            </svg>
                            <input
                                id="name"
                                type="text"
                                class="@error('name') is-invalid @enderror"
                                name="name"
                                value="{{ old('name') }}"
                                placeholder="Иван Иванов"
                                required
                                autocomplete="name"
                                autofocus
                            >
                        </div>
                        @error('name')
                        <span class="error-msg">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Email --}}
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
                            >
                        </div>
                        @error('email')
                        <span class="error-msg">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Пароль --}}
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
                                placeholder="Минимум 8 символов"
                                required
                                autocomplete="new-password"
                            >
                        </div>
                        @error('password')
                        <span class="error-msg">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Подтверждение пароля --}}
                    <div class="form-group">
                        <label for="password-confirm">{{ __('Повторите пароль') }}</label>
                        <div class="input-wrap">
                            <svg class="input-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M9 12l2 2 4-4"/>
                                <path d="M21 12c0 4.97-4.03 9-9 9s-9-4.03-9-9 4.03-9 9-9c1.66 0 3.22.45 4.56 1.24"/>
                            </svg>
                            <input
                                id="password-confirm"
                                type="password"
                                name="password_confirmation"
                                placeholder="Ещё раз"
                                required
                                autocomplete="new-password"
                            >
                        </div>
                    </div>

                    <button type="submit" class="btn-submit">
                        {{ __('Создать аккаунт') }}
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <line x1="5" y1="12" x2="19" y2="12"/>
                            <polyline points="12 5 19 12 12 19"/>
                        </svg>
                    </button>

                    @if (Route::has('login'))
                        <p class="auth-footer">
                            Уже есть аккаунт? <a href="{{ route('login') }}">Войти</a>
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
            font-family: 'Segoe UI', -apple-system, BlinkMacSystemFont, sans-serif;
            /* ⬇ ФОН ПО УМОЛЧАНИЮ (фиолетовый — как на логине) */
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }

        /* ⬇ ДРУГОЙ ФОН для страницы регистрации — изумрудно-бирюзовый */
        .auth-wrapper.register-theme {
            background: linear-gradient(135deg, #0f9b8e 0%, #14b8a6 45%, #06b6d4 100%);
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
            color: #fff;
            padding: 50px 40px;
            display: flex;
            align-items: center;
            position: relative;
            overflow: hidden;
            /* ⬇ Фон левой панели по умолчанию (фиолетовый) */
            background: linear-gradient(160deg, #4f46e5 0%, #7c3aed 100%);
        }

        /* ⬇ Другой фон левой панели для регистрации (изумрудный) */
        .register-theme .auth-side {
            background: linear-gradient(160deg, #0d9488 0%, #0891b2 100%);
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
            padding: 45px 45px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .auth-header { margin-bottom: 26px; }

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
        .form-group { margin-bottom: 16px; }

        .form-group label {
            display: block;
            font-size: 13px;
            font-weight: 600;
            color: #374151;
            margin-bottom: 7px;
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

        /* ⬇ Фокус: фиолетовый по умолчанию */
        .input-wrap input:focus {
            border-color: #6366f1;
            background: #fff;
            box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.12);
        }

        /* ⬇ Фокус для регистрации: бирюзовый */
        .register-theme .input-wrap input:focus {
            border-color: #14b8a6;
            box-shadow: 0 0 0 4px rgba(20, 184, 166, 0.15);
        }

        .input-wrap input.is-invalid {
            border-color: #ef4444;
            background: #fef2f2;
        }

        .error-msg {
            display: block;
            color: #ef4444;
            font-size: 13px;
            margin-top: 5px;
        }

        /* ===== Кнопка ===== */
        .btn-submit {
            width: 100%;
            margin-top: 8px;
            padding: 13px;
            border: none;
            border-radius: 10px;
            color: #fff;
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            transition: transform 0.15s, box-shadow 0.2s;
            /* ⬇ Кнопка по умолчанию (фиолетовая) */
            background: linear-gradient(135deg, #6366f1 0%, #7c3aed 100%);
            box-shadow: 0 6px 18px rgba(99, 102, 241, 0.35);
        }

        /* ⬇ Кнопка для регистрации (бирюзовая) */
        .register-theme .btn-submit {
            background: linear-gradient(135deg, #14b8a6 0%, #06b6d4 100%);
            box-shadow: 0 6px 18px rgba(20, 184, 166, 0.35);
        }

        .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 24px rgba(99, 102, 241, 0.45);
        }

        .register-theme .btn-submit:hover {
            box-shadow: 0 10px 24px rgba(20, 184, 166, 0.5);
        }

        .btn-submit:active { transform: translateY(0); }

        /* ===== Футер ===== */
        .auth-footer {
            text-align: center;
            margin-top: 22px;
            font-size: 14px;
            color: #6b7280;
        }

        .auth-footer a {
            color: #6366f1;
            font-weight: 600;
            text-decoration: none;
        }

        .register-theme .auth-footer a { color: #0d9488; }

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
