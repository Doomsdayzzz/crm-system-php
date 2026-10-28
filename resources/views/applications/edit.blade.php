@extends('layouts.main')

@section('title', 'Редактирование заявки #' . $application->id)

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
        .btn-danger {
            background: transparent;
            border: 1px solid #fecaca;
            color: #dc2626;
            padding: 0.625rem 1.5rem;
            border-radius: 10px;
            font-weight: 500;
            transition: all 0.2s;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }
        .btn-danger:hover {
            background: #fef2f2;
            border-color: #ef4444;
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
        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1rem;
        }
        .pill {
            padding: 5px 14px;
            border-radius: 50px;
            font-size: 12px;
            font-weight: 500;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            white-space: nowrap;
        }
        .badge-blue { background: #dbeafe; color: #1e40af; }
        .badge-indigo { background: #e0e7ff; color: #3730a3; }
        .badge-yellow { background: #fef3c7; color: #92400e; }
        .badge-green { background: #dcfce7; color: #166534; }
        .badge-red { background: #fee2e2; color: #991b1b; }
        .badge-gray { background: #f1f5f9; color: #475569; }
        .meta-card {
            background: #f8fafc;
            border: 1px solid #f1f5f9;
            border-radius: 12px;
            padding: 0.875rem 1rem;
            display: flex;
            align-items: center;
            gap: 0.75rem;
            font-size: 0.875rem;
            color: #475569;
        }
        .meta-card i {
            color: #6366f1;
            width: 16px;
            text-align: center;
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
            .btn-submit,
            .btn-cancel,
            .btn-danger {
                width: 100%;
                justify-content: center;
            }
        }
    </style>
@endpush

@section('content')
    <div class="px-0">
        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-xl relative mb-4" role="alert">
                <strong class="font-bold">Успешно!</strong>
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif

        <!-- Хлебные крошки -->
        <div class="page-header">
            <div>
                <div class="breadcrumb">
                    <a href="/">Главная</a>
                    <span>/</span>
                    <a href="{{ route('applications.index') }}">Заявки</a>
                    <span>/</span>
                    <a href="{{ route('applications.show', $application) }}">#{{ $application->id }}</a>
                    <span>/</span>
                    <span class="text-gray-600 font-medium">Редактирование</span>
                </div>
                <h1>
                    <i class="fas fa-edit text-indigo-500 mr-2"></i>
                    Редактирование заявки #{{ $application->id }}
                </h1>
                <p class="text-gray-500 text-sm mt-0.5">{{ $application->title }}</p>
            </div>
        </div>

        <!-- Форма -->
        <div class="form-container">
            <form action="{{ route('applications.update', $application) }}" method="POST">
                @csrf
                @method('PUT')

                <!-- Название -->
                <div class="form-group">
                    <label for="title" class="form-label">
                        Название <span class="required">*</span>
                    </label>
                    <input type="text"
                           id="title"
                           name="title"
                           class="form-control @error('title') is-invalid @enderror"
                           value="{{ old('title', $application->title) }}"
                           placeholder="Например: Запрос на подключение тарифа"
                           required>
                    @error('title')
                    <div class="form-error">
                        <i class="fas fa-exclamation-circle"></i>
                        {{ $message }}
                    </div>
                    @enderror
                    <div class="form-text">Кратко опишите суть заявки (до 255 символов)</div>
                </div>

                <!-- Отдел / Ответственный -->
                <div class="form-row">
                    <div class="form-group">
                        <label for="department_id" class="form-label">
                            Отдел <span class="required">*</span>
                        </label>
                        <select id="department_id"
                                name="department_id"
                                class="form-select @error('department_id') is-invalid @enderror"
                                required>
                            <option value="">— Выберите отдел —</option>
                            @foreach($departments as $department)
                                <option value="{{ $department->id }}"
                                    @selected(old('department_id', $application->department_id) == $department->id)>
                                    {{ $department->title }}
                                </option>
                            @endforeach
                        </select>
                        @error('department_id')
                        <div class="form-error">
                            <i class="fas fa-exclamation-circle"></i>
                            {{ $message }}
                        </div>
                        @enderror
                        <div class="form-text">Отдел, который будет обрабатывать заявку</div>
                    </div>

                    <div class="form-group">
                        <label for="user_id" class="form-label">Ответственный</label>
                        <select id="user_id"
                                name="user_id"
                                class="form-select @error('user_id') is-invalid @enderror">
                            <option value="">— Не назначен —</option>
                            @foreach($users as $user)
                                <option value="{{ $user->id }}"
                                    @selected(old('user_id', $application->user_id) == $user->id)>
                                    {{ $user->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('user_id')
                        <div class="form-error">
                            <i class="fas fa-exclamation-circle"></i>
                            {{ $message }}
                        </div>
                        @enderror
                        <div class="form-text">Можно назначить позже</div>
                    </div>
                </div>

                <!-- Статус -->
                <div class="form-group">
                    <label for="status" class="form-label">
                        Статус <span class="required">*</span>
                    </label>
                    <div class="flex flex-wrap items-center gap-3">
                        <select id="status"
                                name="status"
                                class="form-select @error('status') is-invalid @enderror"
                                style="flex: 1; min-width: 220px;"
                                onchange="updateStatusPreview(this)">
                            @foreach(\App\Enums\ApplicationStatusEnum::options() as $value => $label)
                                <option value="{{ $value }}"
                                        data-color="{{ \App\Enums\ApplicationStatusEnum::from($value)->color() }}"
                                        data-icon="{{ \App\Enums\ApplicationStatusEnum::from($value)->icon() }}"
                                        @selected((int) old('status', $application->status) === $value)>
                                    {{ $label }}
                                </option>
                            @endforeach
                        </select>
                        <span id="statusPreview" class="pill badge-blue">
                            <i class="fas fa-inbox" style="font-size: 10px;"></i>
                            <span>Новая</span>
                        </span>
                    </div>
                    @error('status')
                    <div class="form-error">
                        <i class="fas fa-exclamation-circle"></i>
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <!-- Описание -->
                <div class="form-group">
                    <label for="description" class="form-label">Описание</label>
                    <textarea id="description"
                              name="description"
                              class="form-control @error('description') is-invalid @enderror"
                              rows="5"
                              placeholder="Подробное описание заявки, пожелания клиента, контактные данные...">{{ old('description', $application->description) }}</textarea>
                    @error('description')
                    <div class="form-error">
                        <i class="fas fa-exclamation-circle"></i>
                        {{ $message }}
                    </div>
                    @enderror
                    <div class="form-text">Необязательное поле. Максимум 5000 символов</div>
                </div>

                <!-- Кнопки -->
                <div class="form-actions">
                    <a href="{{ route('applications.show', $application) }}" class="btn-cancel">
                        <i class="fas fa-arrow-left"></i>
                        Назад
                    </a>
                    <button type="submit" class="btn-submit">
                        <i class="fas fa-save"></i>
                        Сохранить изменения
                    </button>
                </div>

            </form>
        </div>

        <!-- Удаление -->
        <div class="max-w-[800px] mx-auto mt-3 text-right">
            <form action="{{ route('applications.destroy', $application) }}" method="POST" class="contents"
                  onsubmit="return confirm('Удалить заявку «{{ $application->title }}»?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn-danger">
                    <i class="fas fa-trash"></i>
                    Удалить заявку
                </button>
            </form>
        </div>

        <!-- Мета-информация -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-3 mt-4 max-w-[800px] mx-auto">
            <div class="meta-card">
                <i class="fas fa-hashtag"></i>
                <span>Заявка <strong>#{{ $application->id }}</strong></span>
            </div>
            <div class="meta-card">
                <i class="fas fa-calendar-plus"></i>
                <span>Создана <strong>{{ $application->created_at?->format('d.m.Y H:i') }}</strong></span>
            </div>
            <div class="meta-card">
                <i class="fas fa-sync"></i>
                <span>Обновлена <strong>{{ $application->updated_at?->format('d.m.Y H:i') }}</strong></span>
            </div>
        </div>

    </div>
@endsection

@push('scripts')
    <script>
        // Превью статуса
        function updateStatusPreview(select) {
            const option = select.options[select.selectedIndex];
            const preview = document.getElementById('statusPreview');
            preview.className = 'pill badge-' + option.dataset.color;
            preview.innerHTML = '<i class="fas ' + option.dataset.icon + '" style="font-size: 10px;"></i><span>' + option.text.trim() + '</span>';
        }
        updateStatusPreview(document.getElementById('status'));
    </script>
@endpush
