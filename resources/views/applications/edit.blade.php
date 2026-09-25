@extends('layouts.main')

@section('title', 'Редактирование заявки')

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
        .app-icon-preview {
            width: 80px;
            height: 80px;
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 32px;
            color: white;
            margin: 0 auto 1rem;
        }
        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1rem;
        }
        .app-status-badge {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.25rem 0.75rem;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 600;
        }
        .app-status-badge.new {
            background: #dbeafe;
            color: #1e40af;
        }
        .app-status-badge.in-progress {
            background: #fef3c7;
            color: #92400e;
        }
        .app-status-badge.completed {
            background: #dcfce7;
            color: #166534;
        }
        .app-status-badge.rejected {
            background: #fee2e2;
            color: #991b1b;
        }
        .char-counter {
            font-size: 0.75rem;
            color: #94a3b8;
            text-align: right;
            margin-top: 0.25rem;
        }
        .char-counter.warning {
            color: #f59e0b;
        }
        .char-counter.danger {
            color: #ef4444;
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
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
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
                    <a href="{{ route('applications.index') }}">Заявки</a>
                    <span>/</span>
                    <span class="text-gray-600 font-medium">Редактирование</span>
                </div>
                <h1>
                    <i class="fas fa-file-pen text-indigo-500 mr-2"></i>
                    Редактирование заявки
                </h1>
                <p class="text-gray-500 text-sm mt-0.5">Измените данные заявки в системе</p>
            </div>
            <div class="ml-auto">
                @php
                    $statusMap = [
                        0 => ['class' => 'new', 'label' => 'Новая', 'icon' => 'fa-sparkles'],
                        1 => ['class' => 'in-progress', 'label' => 'В работе', 'icon' => 'fa-spinner'],
                        2 => ['class' => 'completed', 'label' => 'Завершена', 'icon' => 'fa-check-circle'],
                        3 => ['class' => 'rejected', 'label' => 'Отклонена', 'icon' => 'fa-times-circle'],
                    ];
                    $status = $statusMap[$application->status] ?? $statusMap[0];
                @endphp
                <span class="app-status-badge {{ $status['class'] }}">
                    <i class="fas {{ $status['icon'] }}"></i>
                    {{ $status['label'] }}
                </span>
            </div>
        </div>

        <!-- Форма -->
        <div class="form-container">
            <form action="{{ route('applications.update', $application) }}" method="POST">
                @csrf
                @method('PUT')

                <!-- Иконка (превью) -->
                <div class="text-center mb-6">
                    <div class="app-icon-preview"
                         style="background: linear-gradient(135deg, #6366f1, #8b5cf6);">
                        <i class="fas fa-file-invoice"></i>
                    </div>
                    <p class="text-xs text-gray-400">ID заявки: #{{ $application->id }}</p>
                </div>

                <!-- Название -->
                <div class="form-group">
                    <label for="title" class="form-label">
                        Название заявки <span class="required">*</span>
                    </label>
                    <input type="text"
                           id="title"
                           name="title"
                           class="form-control @error('title') is-invalid @enderror"
                           value="{{ old('title', $application->title) }}"
                           placeholder="Например: Не работает принтер в офисе"
                           minlength="8"
                           required
                           readonly>
                    @error('title')
                    <div class="form-error">
                        <i class="fas fa-exclamation-circle"></i>
                        {{ $message }}
                    </div>
                    @enderror
{{--                    <div class="form-text">Минимум 8 символов. Название должно быть уникальным</div>--}}
                </div>

                <!-- Описание -->
                <div class="form-group">
                    <label for="description" class="form-label">
                        Описание <span class="required">*</span>
                    </label>
                    <textarea id="description"
                              name="description"
                              class="form-control @error('description') is-invalid @enderror"
                              rows="5"
                              maxlength="255"
                              placeholder="Подробно опишите суть заявки..."
                              required>{{ old('description', $application->description) }}</textarea>
                    <div class="char-counter" id="descCounter">0 / 255</div>
                    @error('description')
                    <div class="form-error">
                        <i class="fas fa-exclamation-circle"></i>
                        {{ $message }}
                    </div>
                    @enderror
                    <div class="form-text">От 5 до 255 символов</div>
                </div>

                <!-- Статус и пользователь -->
                <div class="form-row">
                    <div class="form-group">
                        <label for="status" class="form-label">Статус</label>
                        <select id="status" name="status" class="form-select @error('status') is-invalid @enderror">
                            <option value="0" {{ old('status', $application->status) == 0 ? 'selected' : '' }}>Новая</option>
                            <option value="1" {{ old('status', $application->status) == 1 ? 'selected' : '' }}>В работе</option>
                            <option value="2" {{ old('status', $application->status) == 2 ? 'selected' : '' }}>Завершена</option>
                            <option value="3" {{ old('status', $application->status) == 3 ? 'selected' : '' }}>Отклонена</option>
                        </select>
                        @error('status')
                        <div class="form-error">
                            <i class="fas fa-exclamation-circle"></i>
                            {{ $message }}
                        </div>
                        @enderror
                        <div class="form-text">Текущий статус обработки заявки</div>
                    </div>

                    <div class="form-group">
                        <label for="user_id" class="form-label">Ответственный пользователь</label>
                        <select id="user_id" name="user_id" class="form-select @error('user_id') is-invalid @enderror">
                            <option value="">— Не назначен —</option>
                            @foreach($users ?? [] as $user)
                                <option value="{{ $user->id }}"
                                    {{ old('user_id', $application->user_id) == $user->id ? 'selected' : '' }}>
                                    {{ $user->name }} ({{ $user->email }})
                                </option>
                            @endforeach
                        </select>
                        @error('user_id')
                        <div class="form-error">
                            <i class="fas fa-exclamation-circle"></i>
                            {{ $message }}
                        </div>
                        @enderror
                        <div class="form-text">Пользователь, ответственный за выполнение заявки</div>
                    </div>
                </div>

                <!-- Информация о создании -->
                <div class="bg-gray-50 rounded-xl p-4 mb-4 border border-gray-200">
                    <div class="grid grid-cols-2 gap-3 text-sm">
                        <div>
                            <span class="text-gray-500">Создана:</span>
                            <span class="font-medium text-gray-700">
                                {{ $application->created_at ? $application->created_at->format('d.m.Y H:i') : 'Неизвестно' }}
                            </span>
                        </div>
                        <div>
                            <span class="text-gray-500">Обновлена:</span>
                            <span class="font-medium text-gray-700">
                                {{ $application->updated_at ? $application->updated_at->format('d.m.Y H:i') : 'Неизвестно' }}
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Кнопки -->
                <div class="form-actions">
                    <a href="{{ route('applications.index') }}" class="btn-cancel">
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
                        <h6 class="font-semibold text-sm text-blue-800">Обязательные поля</h6>
                        <p class="text-xs text-blue-600">Поля с <span class="text-red-500">*</span> обязательны для заполнения</p>
                    </div>
                </div>
            </div>
            <div class="bg-purple-50 rounded-2xl p-4 border border-purple-100">
                <div class="flex items-start gap-3">
                    <i class="fas fa-list-check text-purple-500 mt-0.5"></i>
                    <div>
                        <h6 class="font-semibold text-sm text-purple-800">Уникальность</h6>
                        <p class="text-xs text-purple-600">Название заявки должно быть уникальным</p>
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
        // Счётчик символов для описания
        const descField = document.getElementById('description');
        const descCounter = document.getElementById('descCounter');

        function updateCounter() {
            if (!descField || !descCounter) return;
            const len = descField.value.length;
            descCounter.textContent = `${len} / 255`;

            descCounter.classList.remove('warning', 'danger');
            if (len > 230) {
                descCounter.classList.add('danger');
            } else if (len > 200) {
                descCounter.classList.add('warning');
            }
        }

        descField?.addEventListener('input', updateCounter);
        updateCounter();

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

        document.querySelector('form')?.addEventListener('submit', function() {
            formChanged = false;
        });
    </script>
@endpush
