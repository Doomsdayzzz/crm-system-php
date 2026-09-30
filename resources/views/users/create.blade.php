@extends('layouts.main')

@section('title', 'Создание пользователя')

@push('styles')
    <style>
        .form-container {
            background: white;
            border-radius: 16px;
            padding: 2rem;
            box-shadow: 0 1px 3px rgba(0,0,0,0.06);
            border: 1px solid #f1f5f9;
            max-width: 800px;
            margin: 0 auto;
        }
        .form-group {
            margin-bottom: 1.5rem;
        }
        .form-label {
            display: block;
            font-size: 0.875rem;
            font-weight: 600;
            color: #1e293b;
            margin-bottom: 0.5rem;
        }
        .form-label .required {
            color: #ef4444;
            margin-left: 2px;
        }
        .form-control {
            width: 100%;
            padding: 0.625rem 1rem;
            border: 1px solid #e2e8f0;
            border-radius: 10px;
            font-size: 0.95rem;
            transition: all 0.2s;
            background: #f8fafc;
            color: #1e293b;
            outline: none;
        }
        .form-control:focus {
            background: white;
            border-color: #6366f1;
            box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.1);
        }
        .form-control.is-invalid {
            border-color: #ef4444;
        }
        .form-control.is-invalid:focus {
            box-shadow: 0 0 0 3px rgba(239, 68, 68, 0.1);
        }
        .form-control:disabled {
            background: #f1f5f9;
            cursor: not-allowed;
        }
        .form-text {
            font-size: 0.8rem;
            color: #94a3b8;
            margin-top: 0.375rem;
        }
        .form-error {
            font-size: 0.8rem;
            color: #ef4444;
            margin-top: 0.375rem;
            display: flex;
            align-items: center;
            gap: 0.25rem;
        }
        .form-select {
            width: 100%;
            padding: 0.625rem 1rem;
            border: 1px solid #e2e8f0;
            border-radius: 10px;
            font-size: 0.95rem;
            transition: all 0.2s;
            background: #f8fafc;
            color: #1e293b;
            outline: none;
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 12 12'%3E%3Cpath fill='%2394a3b8' d='M6 8L1 3h10z'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 1rem center;
            padding-right: 2.5rem;
        }
        .form-select:focus {
            background-color: white;
            border-color: #6366f1;
            box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.1);
        }
        .form-select.is-invalid {
            border-color: #ef4444;
        }
        .form-actions {
            display: flex;
            gap: 1rem;
            padding-top: 1.5rem;
            border-top: 1px solid #f1f5f9;
            margin-top: 0.5rem;
            flex-wrap: wrap;
        }
        .btn-cancel {
            background: transparent;
            border: 1px solid #e2e8f0;
            color: #475569;
            padding: 0.625rem 1.5rem;
            border-radius: 10px;
            font-weight: 500;
            transition: all 0.2s;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            text-decoration: none;
        }
        .btn-cancel:hover {
            background: #f8fafc;
            border-color: #94a3b8;
        }
        .btn-submit {
            background: linear-gradient(135deg, #6366f1, #8b5cf6);
            border: none;
            color: white;
            padding: 0.625rem 1.5rem;
            border-radius: 10px;
            font-weight: 500;
            transition: all 0.2s;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            flex: 1;
            justify-content: center;
            min-width: 120px;
        }
        .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(99, 102, 241, 0.4);
        }
        .btn-submit:disabled {
            opacity: 0.6;
            cursor: not-allowed;
            transform: none;
        }
        .page-header {
            display: flex;
            align-items: center;
            gap: 1rem;
            margin-bottom: 1.5rem;
            flex-wrap: wrap;
        }
        .page-header h1 {
            font-size: 1.5rem;
            font-weight: 700;
            color: #1e293b;
            margin: 0;
        }
        .page-header .breadcrumb {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 0.875rem;
            color: #94a3b8;
        }
        .page-header .breadcrumb a {
            color: #6366f1;
            text-decoration: none;
        }
        .page-header .breadcrumb a:hover {
            text-decoration: underline;
        }
        .avatar-preview {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 32px;
            font-weight: 700;
            color: white;
            margin: 0 auto 1rem;
            background: linear-gradient(135deg, #6366f1, #8b5cf6);
        }
        .password-toggle {
            position: relative;
        }
        .password-toggle .toggle-btn {
            position: absolute;
            right: 12px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: #94a3b8;
            cursor: pointer;
            padding: 4px;
        }
        .password-toggle .toggle-btn:hover {
            color: #6366f1;
        }
        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1rem;
        }
        @media (max-width: 640px) {
            .form-row {
                grid-template-columns: 1fr;
            }
            .form-container {
                padding: 1rem;
            }
            .form-actions {
                flex-direction: column-reverse;
            }
            .btn-submit {
                width: 100%;
            }
            .btn-cancel {
                width: 100%;
                justify-content: center;
            }
        }
    </style>
@endpush

@section('content')
    <div class="px-0">

        <!-- Хлебные крошки -->
        <div class="page-header">
            <div>
                <div class="breadcrumb">
                    <a href="#">Главная</a>
                    <span>/</span>
                    <a href="{{ route('users.index') }}">Пользователи</a>
                    <span>/</span>
                    <span class="text-gray-600 font-medium">Создание</span>
                </div>
                <h1>
                    <i class="fas fa-user-plus text-indigo-500 mr-2"></i>
                    Создание пользователя
                </h1>
                <p class="text-gray-500 text-sm mt-0.5">Заполните форму для добавления нового пользователя в систему</p>
            </div>
        </div>

        <!-- Форма -->
        <div class="form-container">
            <form action="{{ route('users.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <!-- Аватар (превью) -->
                <div class="text-center mb-6">
                    <div class="avatar-preview" id="avatarPreview">
                        <i class="fas fa-user"></i>
                    </div>
                    <div class="flex justify-center">
                        <label for="avatar" class="cursor-pointer text-sm text-indigo-600 hover:text-indigo-800 font-medium">
                            <i class="fas fa-camera mr-1"></i>
                            Загрузить аватар
                        </label>
                        <input type="file" id="avatar" name="avatar" class="hidden" accept="image/*">
                    </div>
                    <p class="text-xs text-gray-400 mt-1">Рекомендуемый размер: 200x200px</p>
                </div>

                <!-- Основная информация -->
                <div class="form-row">
                    <div class="form-group">
                        <label for="name" class="form-label">
                            ФИО <span class="required">*</span>
                        </label>
                        <input type="text"
                               id="name"
                               name="name"
                               class="form-control @error('name') is-invalid @enderror"
                               value="{{ old('name') }}"
                               placeholder="Иванов Иван Иванович"
                               required>
                        @error('name')
                        <div class="form-error">
                            <i class="fas fa-exclamation-circle"></i>
                            {{ $message }}
                        </div>
                        @enderror
                        <div class="form-text">Введите полное имя пользователя</div>
                    </div>

                    <div class="form-group">
                        <label for="email" class="form-label">
                            Email <span class="required">*</span>
                        </label>
                        <input type="email"
                               id="email"
                               name="email"
                               class="form-control @error('email') is-invalid @enderror"
                               value="{{ old('email') }}"
                               placeholder="user@example.com"
                               required>
                        @error('email')
                        <div class="form-error">
                            <i class="fas fa-exclamation-circle"></i>
                            {{ $message }}
                        </div>
                        @enderror
                        <div class="form-text">Email будет использоваться для входа в систему</div>
                    </div>
                </div>

                <!-- Пароль -->
                <div class="form-row">
                    <div class="form-group">
                        <label for="password" class="form-label">
                            Пароль <span class="required">*</span>
                        </label>
                        <div class="password-toggle">
                            <input type="password"
                                   id="password"
                                   name="password"
                                   class="form-control @error('password') is-invalid @enderror"
                                   placeholder="Минимум 8 символов"
                                   required>
                            <button type="button" class="toggle-btn" onclick="togglePassword('password')">
                                <i class="fas fa-eye"></i>
                            </button>
                        </div>
                        @error('password')
                        <div class="form-error">
                            <i class="fas fa-exclamation-circle"></i>
                            {{ $message }}
                        </div>
                        @enderror
                        <div class="form-text">Пароль должен содержать минимум 8 символов</div>
                    </div>

                    <div class="form-group">
                        <label for="password_confirmation" class="form-label">
                            Подтверждение пароля <span class="required">*</span>
                        </label>
                        <div class="password-toggle">
                            <input type="password"
                                   id="password_confirmation"
                                   name="password_confirmation"
                                   class="form-control"
                                   placeholder="Повторите пароль"
                                   required>
                            <button type="button" class="toggle-btn" onclick="togglePassword('password_confirmation')">
                                <i class="fas fa-eye"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <label for="role" class="form-label">Роль <span class="required">*</span></label>
                <select id="role" name="role" class="form-select @error('role') is-invalid @enderror">
                    @foreach(\App\Enums\RoleListEnum::label() as $roleKey => $role)
                        <option value="{{ $roleKey }}" {{ old('role', $user->role ?? 'user') == 'user' ? 'selected' : '' }}>
                            {{ $role->value }}
                        </option>
                    @endforeach
                </select>

                <!-- Дополнительная информация -->
                <div class="form-row">
                    <div class="form-group">
                        <label for="phone" class="form-label">Телефон</label>
                        <input type="text"
                               id="phone"
                               name="phone"
                               class="form-control @error('phone') is-invalid @enderror"
                               value="{{ old('phone') }}"
                               placeholder="+7 (999) 123-45-67">
                        @error('phone')
                        <div class="form-error">
                            <i class="fas fa-exclamation-circle"></i>
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="position" class="form-label">Должность</label>
                        <input type="text"
                               id="position"
                               name="position"
                               class="form-control @error('position') is-invalid @enderror"
                               value="{{ old('position') }}"
                               placeholder="Менеджер по продажам">
                        @error('position')
                        <div class="form-error">
                            <i class="fas fa-exclamation-circle"></i>
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>

                <!-- Комментарий -->
                <div class="form-group">
                    <label for="notes" class="form-label">Комментарий</label>
                    <textarea id="notes"
                              name="notes"
                              class="form-control @error('notes') is-invalid @enderror"
                              rows="3"
                              placeholder="Дополнительная информация о пользователе...">{{ old('notes') }}</textarea>
                    @error('notes')
                    <div class="form-error">
                        <i class="fas fa-exclamation-circle"></i>
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <!-- Кнопки -->
                <div class="form-actions">
                    <a href="{{ route('users.index') }}" class="btn-cancel">
                        <i class="fas fa-arrow-left"></i>
                        Отмена
                    </a>
                    <button type="submit" class="btn-submit">
                        <i class="fas fa-save"></i>
                        Создать пользователя
                    </button>
                </div>

            </form>
        </div>

        <!-- Подсказки -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-3 mt-4 max-w-[800px] mx-auto">
            <div class="bg-blue-50 rounded-2xl p-4 border border-blue-100">
                <div class="flex items-start gap-3">
                    <i class="fas fa-info-circle text-blue-500 mt-0.5"></i>
                    <div>
                        <h6 class="font-semibold text-sm text-blue-800">Поля обязательные</h6>
                        <p class="text-xs text-blue-600">Поля с <span class="text-red-500">*</span> обязательны для заполнения</p>
                    </div>
                </div>
            </div>
            <div class="bg-purple-50 rounded-2xl p-4 border border-purple-100">
                <div class="flex items-start gap-3">
                    <i class="fas fa-shield-alt text-purple-500 mt-0.5"></i>
                    <div>
                        <h6 class="font-semibold text-sm text-purple-800">Безопасность</h6>
                        <p class="text-xs text-purple-600">Пароль будет зашифрован перед сохранением</p>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection

@push('scripts')
    <script>
        // Показать/скрыть пароль
        function togglePassword(fieldId) {
            const field = document.getElementById(fieldId);
            const toggle = field.parentElement.querySelector('.toggle-btn i');

            if (field.type === 'password') {
                field.type = 'text';
                toggle.classList.remove('fa-eye');
                toggle.classList.add('fa-eye-slash');
            } else {
                field.type = 'password';
                toggle.classList.remove('fa-eye-slash');
                toggle.classList.add('fa-eye');
            }
        }

        // Превью аватара
        document.getElementById('avatar')?.addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const preview = document.getElementById('avatarPreview');
                    preview.innerHTML = `<img src="${e.target.result}" class="w-full h-full rounded-full object-cover">`;
                }
                reader.readAsDataURL(file);
            }
        });

        // Автоматическое заполнение имени из email (опционально)
        document.getElementById('email')?.addEventListener('blur', function() {
            const nameField = document.getElementById('name');
            if (!nameField.value) {
                const email = this.value;
                if (email) {
                    const name = email.split('@')[0]
                        .split('.')
                        .map(word => word.charAt(0).toUpperCase() + word.slice(1))
                        .join(' ');
                    nameField.value = name;
                }
            }
        });
    </script>
@endpush
