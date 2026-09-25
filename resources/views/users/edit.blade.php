@extends('layouts.main')

@section('title', 'Редактирование пользователя')

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
            overflow: hidden;
        }
        .avatar-preview img {
            width: 100%;
            height: 100%;
            object-fit: cover;
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
        .user-status-badge {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.25rem 0.75rem;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 600;
        }
        .user-status-badge.active {
            background: #dcfce7;
            color: #166534;
        }
        .user-status-badge.inactive {
            background: #fee2e2;
            color: #991b1b;
        }
        .user-status-badge.pending {
            background: #fef3c7;
            color: #92400e;
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
        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                <strong class="font-bold">Успешно!</strong>
                <span class="block sm:inline">{{ session('success') }}</span>
                <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
            <svg class="fill-current h-6 w-6 text-green-500" role="button" xmlns="http://www.w3.org/2000/svg"
                 viewBox="0 0 20 20">
                <title>Закрыть</title>
                <path
                    d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/>
            </svg>
        </span>
            </div>
        @endif
        <!-- Хлебные крошки -->
        <div class="page-header">
            <div>
                <div class="breadcrumb">
                    <a href="#">Главная</a>
                    <span>/</span>
                    <a href="{{ route('users.index') }}">Пользователи</a>
                    <span>/</span>
                    <span class="text-gray-600 font-medium">Редактирование</span>
                </div>
                <h1>
                    <i class="fas fa-user-edit text-indigo-500 mr-2"></i>
                    Редактирование пользователя
                </h1>
                <p class="text-gray-500 text-sm mt-0.5">Измените данные пользователя в системе</p>
            </div>
            <div class="ml-auto">
                <span class="user-status-badge {{ $user->status ?? 'active' }}">
                    <i class="fas fa-circle text-[6px]"></i>
                    {{ ucfirst($user->status ?? 'Активный') }}
                </span>
            </div>
        </div>

        <!-- Форма -->
        <div class="form-container">
            <form action="{{ route('users.update', $user) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <!-- Аватар (превью) -->
                <div class="text-center mb-6">
                    <div class="avatar-preview" id="avatarPreview">
                        @if($user->avatar)
                            <img src="{{ asset('storage/' . $user->avatar) }}" alt="{{ $user->name }}">
                        @else
                            <i class="fas fa-user"></i>
                        @endif
                    </div>
                    <div class="flex justify-center items-center gap-4">
                        <label for="avatar" class="cursor-pointer text-sm text-indigo-600 hover:text-indigo-800 font-medium">
                            <i class="fas fa-camera mr-1"></i>
                            Загрузить новый аватар
                        </label>
                        @if($user->avatar)
                            <label for="remove_avatar" class="cursor-pointer text-sm text-red-600 hover:text-red-800 font-medium">
                                <i class="fas fa-trash-alt mr-1"></i>
                                Удалить
                            </label>
                            <input type="checkbox" id="remove_avatar" name="remove_avatar" class="hidden" value="1">
                        @endif
                        <input type="file" id="avatar" name="avatar" class="hidden" accept="image/*">
                    </div>
                    <p class="text-xs text-gray-400 mt-1">Рекомендуемый размер: 200x200px. Оставьте пустым, чтобы сохранить текущий аватар</p>
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
                               value="{{ old('name', $user->name) }}"
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
                               value="{{ old('email', $user->email) }}"
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
                            Новый пароль
                            <span class="text-xs text-gray-400 font-normal">(оставьте пустым, чтобы не менять)</span>
                        </label>
                        <div class="password-toggle">
                            <input type="password"
                                   id="password"
                                   name="password"
                                   class="form-control @error('password') is-invalid @enderror"
                                   placeholder="Минимум 8 символов">
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
                            Подтверждение нового пароля
                        </label>
                        <div class="password-toggle">
                            <input type="password"
                                   id="password_confirmation"
                                   name="password_confirmation"
                                   class="form-control"
                                   placeholder="Повторите пароль">
                            <button type="button" class="toggle-btn" onclick="togglePassword('password_confirmation')">
                                <i class="fas fa-eye"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Роль и статус -->
                <div class="form-row">
                    <div class="form-group">
                        <label for="role" class="form-label">Роль <span class="required">*</span></label>
                        <select id="role" name="role" class="form-select @error('role') is-invalid @enderror">
                            <option value="user" {{ old('role', $user->role ?? 'user') == 'user' ? 'selected' : '' }}>
                                Пользователь
                            </option>
                            <option value="manager" {{ old('role', $user->role ?? 'user') == 'manager' ? 'selected' : '' }}>
                                Менеджер
                            </option>
                            <option value="admin" {{ old('role', $user->role ?? 'user') == 'admin' ? 'selected' : '' }}>
                                Администратор
                            </option>
                            <option value="superadmin" {{ old('role', $user->role ?? 'user') == 'superadmin' ? 'selected' : '' }}>
                                Супер-администратор
                            </option>
                        </select>
                        @error('role')
                        <div class="form-error">
                            <i class="fas fa-exclamation-circle"></i>
                            {{ $message }}
                        </div>
                        @enderror
                        <div class="form-text">Роль определяет уровень доступа к системе</div>
                    </div>

                    <div class="form-group">
                        <label for="status" class="form-label">Статус</label>
                        <select id="status" name="status" class="form-select @error('status') is-invalid @enderror">
                            <option value="active" {{ old('status', $user->status ?? 'active') == 'active' ? 'selected' : '' }}>
                                Активный
                            </option>
                            <option value="inactive" {{ old('status', $user->status ?? 'active') == 'inactive' ? 'selected' : '' }}>
                                Неактивный
                            </option>
                            <option value="pending" {{ old('status', $user->status ?? 'active') == 'pending' ? 'selected' : '' }}>
                                Ожидает подтверждения
                            </option>
                        </select>
                        @error('status')
                        <div class="form-error">
                            <i class="fas fa-exclamation-circle"></i>
                            {{ $message }}
                        </div>
                        @enderror
                        <div class="form-text">Активный пользователь может входить в систему</div>
                    </div>
                </div>

                <!-- Дополнительная информация -->
                <div class="form-row">
                    <div class="form-group">
                        <label for="phone" class="form-label">Телефон</label>
                        <input type="text"
                               id="phone"
                               name="phone"
                               class="form-control @error('phone') is-invalid @enderror"
                               value="{{ old('phone', $user->phone) }}"
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
                               value="{{ old('position', $user->position) }}"
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
                              placeholder="Дополнительная информация о пользователе...">{{ old('notes', $user->notes) }}</textarea>
                    @error('notes')
                    <div class="form-error">
                        <i class="fas fa-exclamation-circle"></i>
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <!-- Информация о создании -->
                <div class="bg-gray-50 rounded-xl p-4 mb-4 border border-gray-200">
                    <div class="grid grid-cols-2 gap-3 text-sm">
                        <div>
                            <span class="text-gray-500">Создан:</span>
                            <span class="font-medium text-gray-700">{{ $user->created_at ? $user->created_at->format('d.m.Y H:i') : 'Неизвестно' }}</span>
                        </div>
                        <div>
                            <span class="text-gray-500">Обновлён:</span>
                            <span class="font-medium text-gray-700">{{ $user->updated_at ? $user->updated_at->format('d.m.Y H:i') : 'Неизвестно' }}</span>
                        </div>
                    </div>
                </div>

                <!-- Кнопки -->
                <div class="form-actions">
                    <a href="{{ route('users.index') }}" class="btn-cancel">
                        <i class="fas fa-arrow-left"></i>
                        Отмена
                    </a>
                    <button type="submit" class="btn-submit">
                        <i class="fas fa-save"></i>
                        Сохранить изменения
                    </button>
                </div>

            </form>
        </div>

        <!-- Подсказки -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-3 mt-4 max-w-[800px] mx-auto">
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
            <div class="bg-amber-50 rounded-2xl p-4 border border-amber-100">
                <div class="flex items-start gap-3">
                    <i class="fas fa-clock text-amber-500 mt-0.5"></i>
                    <div>
                        <h6 class="font-semibold text-sm text-amber-800">История изменений</h6>
                        <p class="text-xs text-amber-600">Все изменения логируются в системе</p>
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

        // Удаление аватара
        document.getElementById('remove_avatar')?.addEventListener('change', function(e) {
            if (this.checked) {
                if (confirm('Вы уверены, что хотите удалить аватар?')) {
                    const preview = document.getElementById('avatarPreview');
                    preview.innerHTML = `<i class="fas fa-user"></i>`;
                } else {
                    this.checked = false;
                }
            }
        });

        // Подтверждение перед выходом при наличии изменений
        let formChanged = false;
        document.querySelectorAll('input, select, textarea').forEach(el => {
            el.addEventListener('change', () => formChanged = true);
        });

        window.addEventListener('beforeunload', function(e) {
            if (formChanged) {
                e.preventDefault();
                e.returnValue = 'У вас есть несохраненные изменения. Вы уверены, что хотите покинуть страницу?';
            }
        });

        // Обработка отправки формы для сброса флага
        document.querySelector('form')?.addEventListener('submit', function() {
            formChanged = false;
        });
    </script>
@endpush
