@extends('layouts.main')

@section('title', 'Редактирование пользователя')

@push('styles')
    <style>
        .form-container {
            background: white;
            border-radius: 16px;
            padding: 2rem;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.06);
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


        .contact-type-row {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.625rem;
            background: #eef2ff;
            border: 1px solid #e0e7ff;
            border-radius: 10px;
            margin-bottom: 0.5rem;
            transition: all 0.2s;
        }

        .contact-type-row:hover {
            background: #e0e7ff;
        }

        .contact-type-row .icon-badge {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 28px;
            height: 28px;
            border-radius: 50%;
            background: #6366f1;
            color: white;
            font-size: 12px;
            flex-shrink: 0;
        }

        .btn-remove-row {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background: #fee2e2;
            color: #dc2626;
            border: none;
            cursor: pointer;
            transition: all 0.2s;
            flex-shrink: 0;
        }

        .btn-remove-row:hover {
            background: #dc2626;
            color: white;
            transform: scale(1.05);
        }

        .btn-add-row {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.625rem 1.25rem;
            border-radius: 10px;
            background: linear-gradient(135deg, #34d399, #10b981);
            color: white;
            font-weight: 500;
            border: none;
            cursor: pointer;
            transition: all 0.2s;
            margin-top: 0.5rem;
        }

        .btn-add-row:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(16, 185, 129, 0.35);
        }

        .btn-add-row:disabled {
            opacity: 0.5;
            cursor: not-allowed;
            transform: none;
        }

        .contact-type-row {
            flex-wrap: wrap;
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

        /* Сетка изображений */
        .image-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(160px, 1fr));
            gap: 1rem;
        }

        .image-card {
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.06);
            border: 1px solid #f1f5f9;
            transition: all 0.3s ease;
        }

        .image-card .private-image {
            background: white;
            border-radius: 12px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.06);
            border: 1px solid #f1f5f9;
            transition: all 0.3s ease;
            margin: 43px 0;
        }

        .image-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.08);
        }

        .image-card .private-image img {
            width: 100%;
            height: 140px;
        }

        .image-card-info {
            padding: 0.5rem 0.75rem;
            display: flex;
            flex-direction: column;
            gap: 0.125rem;
        }

        .image-card-name {
            font-size: 0.75rem;
            color: #1e293b;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .image-card-id {
            font-size: 0.6875rem;
            color: #94a3b8;
        }

        @media (max-width: 640px) {
            .image-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        /* Upload zone */
        .upload-zone {
            border: 2px dashed #e2e8f0;
            border-radius: 12px;
            padding: 2rem 1.5rem;
            text-align: center;
            background: #f8fafc;
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .upload-zone:hover,
        .upload-zone.dragover {
            border-color: #6366f1;
            background: #eef2ff;
        }

        .upload-zone-content {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 0.5rem;
        }

        .upload-zone-icon {
            font-size: 2.5rem;
            color: #94a3b8;
            margin-bottom: 0.5rem;
            transition: color 0.3s ease;
        }

        .upload-zone:hover .upload-zone-icon {
            color: #6366f1;
        }

        .upload-zone-text {
            font-size: 0.875rem;
            color: #64748b;
        }

        .upload-zone-btn {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.625rem 1.5rem;
            background: linear-gradient(135deg, #6366f1, #8b5cf6);
            color: white;
            border-radius: 10px;
            font-size: 0.875rem;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.2s ease;
            border: none;
        }

        .upload-zone-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(99, 102, 241, 0.4);
        }

        .upload-zone-input {
            display: none;
        }

        .upload-zone-hint {
            font-size: 0.75rem;
            color: #94a3b8;
        }
    </style>
@endpush

@section('content')
    <div class="px-0">
        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                <strong class="font-bold">Успешно!</strong>
                <span class="block sm:inline">{{ session('success') }}</span>
{{--                <span class="absolute top-0 bottom-0 right-0 px-4 py-3">--}}
{{--            <svg class="fill-current h-6 w-6 text-green-500" role="button" xmlns="http://www.w3.org/2000/svg"--}}
{{--                 viewBox="0 0 20 20">--}}
{{--                <title>Закрыть</title>--}}
{{--                <path--}}
{{--                    d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/>--}}
{{--            </svg>--}}
{{--        </span>--}}
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
                        <label for="avatar"
                               class="cursor-pointer text-sm text-indigo-600 hover:text-indigo-800 font-medium">
                            <i class="fas fa-camera mr-1"></i>
                            Загрузить новый аватар
                        </label>
                        @if($user->avatar)
                            <label for="remove_avatar"
                                   class="cursor-pointer text-sm text-red-600 hover:text-red-800 font-medium">
                                <i class="fas fa-trash-alt mr-1"></i>
                                Удалить
                            </label>
                            <input type="checkbox" id="remove_avatar" name="remove_avatar" class="hidden" value="1">
                        @endif
                        <input type="file" id="avatar" name="avatar" class="hidden" accept="image/*">
                    </div>
                    <p class="text-xs text-gray-400 mt-1">Рекомендуемый размер: 200x200px. Оставьте пустым, чтобы
                        сохранить текущий аватар</p>
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
                            @foreach(\App\Enums\RoleListEnum::label() as $roleKey => $role)
                                <option
                                    value="{{ $roleKey }}" {{ old('role', $user->role ?? 'user') == $roleKey ? 'selected' : '' }}>
                                    {{ $role->value }}
                                </option>
                            @endforeach
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
                            <option
                                value="active" {{ old('status', $user->status ?? 'active') == 'active' ? 'selected' : '' }}>
                                Активный
                            </option>
                            <option
                                value="inactive" {{ old('status', $user->status ?? 'active') == 'inactive' ? 'selected' : '' }}>
                                Неактивный
                            </option>
                            <option
                                value="pending" {{ old('status', $user->status ?? 'active') == 'pending' ? 'selected' : '' }}>
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


                <!-- Типы контактов (many-to-many) -->
                <div class="form-group">
                    <label class="form-label">Типы контактов</label>

                    <div id="contactTypesList">
                        @foreach($user->contactTypes as $index => $contactType)
                            @continue(!$contactType)
                            <div class="contact-type-row" data-index="{{ $index }}">
                                <span class="icon-badge">
                                    <i class="fas fa-tag"></i>
                                </span>
                                <select name="contact_types[{{ $index }}][id]"
                                        class="form-select flex-1"
                                        required>
                                    <option value="">— Тип —</option>
                                    @foreach($contactTypes as $type)
                                        <option value="{{ $type->id }}" @selected($type->id == $contactType->id)>
                                            {{ mb_ucfirst(mb_strtolower($type->type)) }}
                                        </option>
                                    @endforeach
                                </select>

                                <input type="text"
                                       name="contact_types[{{ $index }}][value]"
                                       class="form-control flex-1 @error('contact_types.' . $index . '.value') is-invalid @enderror"
                                       value="{{ old('contact_types.' . $index . '.value', $contactType->pivot->subject ?? '') }}"
                                       placeholder="Номер / ссылка / значение">

                                @error('contact_types.' . $index . '.value')
                                <div class="form-error" style="width: 100%; margin-top: 0.25rem;">
                                    <i class="fas fa-exclamation-circle"></i>
                                    {{ $message }}
                                </div>
                                @enderror

                                <button type="button"
                                        class="btn-remove-row js-remove-contact-type"
                                        title="Удалить">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        @endforeach
                    </div>

                    @error('contact_types')
                    <div class="form-error">
                        <i class="fas fa-exclamation-circle"></i>
                        {{ $message }}
                    </div>
                    @enderror
                    @foreach($errors->get('contact_types.*.id') as $msgs)
                        @foreach($msgs as $msg)
                            <div class="form-error"><i class="fas fa-exclamation-circle"></i> {{ $msg }}</div>
                        @endforeach
                    @endforeach

                    @foreach($errors->get('contact_types.*.value') as $msgs)
                        @foreach($msgs as $msg)
                            <div class="form-error"><i class="fas fa-exclamation-circle"></i> {{ $msg }}</div>
                        @endforeach
                    @endforeach

                    <button type="button" id="addContactTypeBtn" class="btn-add-row">
                        <i class="fas fa-plus"></i>
                        Добавить тип контакта
                    </button>

                    <div class="form-text">
                        Нажмите <i class="fas fa-plus text-emerald-500"></i> чтобы добавить,
                        <i class="fas fa-minus text-red-500"></i> — чтобы удалить.
                        Изменения сохранятся вместе с формой.
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

                <!-- Загрузка файлов -->
                <div class="form-group">
                    <label class="form-label">Изображения</label>
                    <div class="upload-zone" id="uploadZone">
                        <div class="upload-zone-content">
                            <i class="fas fa-cloud-upload-alt upload-zone-icon"></i>
                            <p class="upload-zone-text">Перетащите изображения сюда или</p>
                            <label for="images" class="upload-zone-btn">
                                <i class="fas fa-folder-open"></i> Выбрать файлы
                            </label>
                            <input type="file" id="images" name="images[]" multiple accept="image/*"
                                   class="upload-zone-input">
                            <p class="upload-zone-hint">JPEG, PNG, JPG до 4MB</p>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="form-label">Загруженные изображения</label>
                    @if($user->images->count())
                        <div class="image-grid">
                            @foreach($user->images as $image)
                                <div class="image-card">
                                    @if($image->disk === 'private')
                                        <img src="{{ asset('storage/' . '/images/private.webp') }}" alt="private"
                                             class="private-image">
                                    @elseif($image->disk === 'public')
                                        <img src="{{ asset('storage/' . $image->path) }}" alt="{{ $image->name }}">
                                    @endif
                                    <div class="image-card-info">
                                        <span class="image-card-name">{{ $image->name }}</span>
                                        <span class="image-card-id">ID: #{{ $image->id }}</span>
                                        <div>
                                            <input type="checkbox"
                                                   name="remove_images[]"
                                                   id="remove_image_{{ $image->id }}"
                                                   value="{{ $image->id }}"
                                                   class="remove-image-checkbox">
                                            <label for="remove_image_{{ $image->id }}"
                                                   class="remove-image-text">Удалить</label>
                                        </div>
                                        <div>
                                            <input type="checkbox"
                                                   name="change_private_images[]"
                                                   id="change_private_image_{{ $image->id }}"
                                                   value="{{ $image->id }}"
                                                   class="change_private_images"
                                                {{ $image->disk === 'private' ? 'checked' : '' }}>

                                            <label for="change_private_image_{{ $image->id }}"
                                                   class="private-image-text">Приватный</label>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="form-text">Изображения не загружены</p>
                    @endif
                </div>

                <!-- Информация о создании -->
                <div class="bg-gray-50 rounded-xl p-4 mb-4 border border-gray-200">
                    <div class="grid grid-cols-2 gap-3 text-sm">
                        <div>
                            <span class="text-gray-500">Создан:</span>
                            <span
                                class="font-medium text-gray-700">{{ $user->created_at ? $user->created_at->format('d.m.Y H:i') : 'Неизвестно' }}</span>
                        </div>
                        <div>
                            <span class="text-gray-500">Обновлён:</span>
                            <span
                                class="font-medium text-gray-700">{{ $user->updated_at ? $user->updated_at->format('d.m.Y H:i') : 'Неизвестно' }}</span>
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
        <!-- загрузка картинок -->


        <div class="min-h-screen bg-gray-50 py-8 px-4">
            {{-- Красивый заголовок по центру --}}
            <div class="text-center mb-8">
                <h1 class="text-4xl md:text-5xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-blue-600 via-indigo-600 to-purple-600 inline-block">
                    Заявки
                </h1>
                <div class="mt-3 flex items-center justify-center gap-2">
                    <span class="h-1 w-12 rounded-full bg-blue-500"></span>
                    <span class="h-1 w-3 rounded-full bg-indigo-500"></span>
                    <span class="h-1 w-1.5 rounded-full bg-purple-500"></span>
                </div>
                <p class="mt-4 text-gray-500 text-sm md:text-base">
                    Всего заявок: <span class="font-semibold text-gray-700">{{ $user->applications->count() }}</span>
                </p>
            </div>

            {{-- Сетка карточек --}}
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 max-w-7xl mx-auto">
                @foreach($user->applications as $application)
                    <div
                        class="bg-white rounded-xl shadow-md hover:shadow-xl transition-shadow duration-300 overflow-hidden border border-gray-100">
                        {{-- Заголовок с индикатором статуса --}}
                        <div class="p-6 pb-4">
                            <div class="flex items-start justify-between gap-4 mb-3">
                                <h2 class="text-xl font-bold text-gray-800 leading-tight">
                                    {{ $application->title }}
                                </h2>

                                @if($application->status == 1)
                                    <span
                                        class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-700 whitespace-nowrap">
                                <span class="w-2 h-2 rounded-full bg-green-500 animate-pulse"></span>
                                Активный
                            </span>
                                @else
                                    <span
                                        class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold bg-gray-100 text-gray-600 whitespace-nowrap">
                                <span class="w-2 h-2 rounded-full bg-gray-400"></span>
                                Не активный
                            </span>
                                @endif
                            </div>

                            {{-- Описание --}}
                            <p class="text-gray-600 text-sm leading-relaxed line-clamp-3">
                                {{ $application->description }}
                            </p>
                        </div>

                        {{-- Футер карточки --}}
                        <div class="px-6 py-4 bg-gray-50 border-t border-gray-100 flex items-center justify-between">
                    <span class="text-xs text-gray-400">
                        ID: #{{ $application->id }}
                    </span>
                            <button class="text-sm font-medium text-blue-600 hover:text-blue-800 transition-colors">
                                Подробнее →
                            </button>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>


        <!-- Подсказки -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-3 mt-4 max-w-[800px] mx-auto">
            <div class="bg-blue-50 rounded-2xl p-4 border border-blue-100">
                <div class="flex items-start gap-3">
                    <i class="fas fa-info-circle text-blue-500 mt-0.5"></i>
                    <div>
                        <h6 class="font-semibold text-sm text-blue-800">Поля обязательные</h6>
                        <p class="text-xs text-blue-600">Поля с <span class="text-red-500">*</span> обязательны для
                            заполнения</p>
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

    {{-- Шаблон строки типа контакта для JS --}}
    <template id="contactTypeRowTemplate">
        <div class="contact-type-row">
            <span class="icon-badge">
                <i class="fas fa-tag"></i>
            </span>

            <select class="form-select flex-1" required>
                <option value="">— Тип —</option>
                @foreach($contactTypes as $type)
                    <option value="{{ $type->id }}">
                        {{ mb_ucfirst(mb_strtolower($type->type)) }}
                    </option>
                @endforeach
            </select>

            <input type="text"
                   class="form-control flex-1"
                   placeholder="Номер / ссылка / значение">

            <button type="button"
                    class="btn-remove-row js-remove-contact-type"
                    title="Удалить">
                <i class="fas fa-minus"></i>
            </button>
        </div>
    </template>

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
        document.getElementById('avatar')?.addEventListener('change', function (e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    const preview = document.getElementById('avatarPreview');
                    preview.innerHTML = `<img src="${e.target.result}" class="w-full h-full rounded-full object-cover">`;
                }
                reader.readAsDataURL(file);
            }
        });

        // Удаление аватара
        document.getElementById('remove_avatar')?.addEventListener('change', function (e) {
            if (this.checked) {
                if (confirm('Вы уверены, что хотите удалить аватар?')) {
                    const preview = document.getElementById('avatarPreview');
                    preview.innerHTML = `<i class="fas fa-user"></i>`;
                } else {
                    this.checked = false;
                }
            }
        });

        // // Подтверждение перед выходом при наличии изменений
        // let formChanged = false;
        // document.querySelectorAll('input, select, textarea').forEach(el => {
        //     el.addEventListener('change', () => formChanged = true);
        // });
        //
        // window.addEventListener('beforeunload', function(e) {
        //     if (formChanged) {
        //         e.preventDefault();
        //         e.returnValue = 'У вас есть несохраненные изменения. Вы уверены, что хотите покинуть страницу?';
        //     }
        // });
        //
        // // Обработка отправки формы для сброса флага
        // document.querySelector('form')?.addEventListener('submit', function() {
        //     formChanged = false;
        // });

        // Drag & Drop для загрузки изображений
        const uploadZone = document.getElementById('uploadZone');
        const imagesInput = document.getElementById('images');

        if (uploadZone && imagesInput) {
            uploadZone.addEventListener('click', (e) => {
                if (e.target.closest('.upload-zone-btn') || e.target.closest('.upload-zone')) {
                    imagesInput.click();
                }
            });

            uploadZone.addEventListener('dragover', (e) => {
                e.preventDefault();
                uploadZone.classList.add('dragover');
            });

            uploadZone.addEventListener('dragleave', () => {
                uploadZone.classList.remove('dragover');
            });

            uploadZone.addEventListener('drop', (e) => {
                e.preventDefault();
                uploadZone.classList.remove('dragover');
                const files = e.dataTransfer.files;
                imagesInput.files = files;
            });

            imagesInput.addEventListener('change', () => {
                if (imagesInput.files.length) {
                    const names = Array.from(imagesInput.files).map(f => f.name).join(', ');
                    uploadZone.querySelector('.upload-zone-text').textContent = `Выбрано: ${names}`;
                }
            });
        }

        // === Типы контактов (many-to-many) ===
        (function () {
            const list   = document.getElementById('contactTypesList');
            const tpl    = document.getElementById('contactTypeRowTemplate');
            const addBtn = document.getElementById('addContactTypeBtn');

            function reindex() {
                [...list.querySelectorAll('.contact-type-row')].forEach((row, i) => {
                    row.dataset.index = i;

                    const select = row.querySelector('select');
                    const input  = row.querySelector('input[type="text"]');

                    select.name = `contact_types[${i}][id]`;
                    input.name  = `contact_types[${i}][value]`;
                });
            }

            function bindRemove(row) {
                row.querySelector('.js-remove-contact-type')
                    .addEventListener('click', () => {
                        row.remove();
                        reindex();
                    });
            }

            // Привязка к существующим строкам
            list.querySelectorAll('.contact-type-row').forEach(bindRemove);

            // Добавление строки
            addBtn.addEventListener('click', () => {
                const fragment = tpl.content.cloneNode(true);
                const row = fragment.querySelector('.contact-type-row');
                list.appendChild(row);
                bindRemove(row);
                reindex();
            });

            reindex();
        })();

    </script>
@endpush
