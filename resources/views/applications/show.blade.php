@extends('layouts.main')

@section('title', 'Заявка #' . $application->id)

@push('styles')
    <style>
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
            flex-wrap: wrap;
        }
        .page-header .breadcrumb a {
            color: #6366f1;
            text-decoration: none;
        }
        .page-header .breadcrumb a:hover {
            text-decoration: underline;
        }

        .detail-grid {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 1.25rem;
            align-items: start;
        }

        .card {
            background: white;
            border-radius: 16px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.06);
            border: 1px solid #f1f5f9;
            overflow: hidden;
        }

        .card-header {
            padding: 1.25rem 1.5rem;
            border-bottom: 1px solid #f1f5f9;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 1rem;
            flex-wrap: wrap;
        }

        .card-header h2 {
            font-size: 1rem;
            font-weight: 600;
            color: #1e293b;
            margin: 0;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .card-body {
            padding: 1.5rem;
        }

        .description {
            color: #475569;
            font-size: 0.95rem;
            line-height: 1.75;
            white-space: pre-wrap;
            word-break: break-word;
        }

        .description-empty {
            color: #94a3b8;
            font-style: italic;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .detail-list {
            display: flex;
            flex-direction: column;
            gap: 0.25rem;
        }

        .detail-row {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 1rem;
            padding: 0.875rem 0;
            border-bottom: 1px dashed #f1f5f9;
            font-size: 0.9rem;
        }

        .detail-row:last-child {
            border-bottom: none;
        }

        .detail-row .label {
            color: #94a3b8;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            white-space: nowrap;
        }

        .detail-row .label i {
            width: 16px;
            text-align: center;
            color: #6366f1;
        }

        .detail-row .value {
            color: #1e293b;
            font-weight: 500;
            text-align: right;
            word-break: break-word;
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

        .id-chip {
            background: #f1f5f9;
            color: #475569;
            font-size: 13px;
            font-weight: 600;
            padding: 4px 10px;
            border-radius: 8px;
            letter-spacing: 0.3px;
        }

        .actions {
            display: flex;
            gap: 0.625rem;
            flex-wrap: wrap;
        }

        .btn-primary-custom {
            background: linear-gradient(135deg,#6366f1,#8b5cf6);
            border: none;
            color: white;
            padding: 10px 24px;
            border-radius: 12px;
            font-weight: 500;
            font-size: 14px;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            text-decoration: none;
            transition: all 0.2s;
        }
        .btn-primary-custom:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(99,102,241,0.35);
        }

        .btn-outline-custom {
            background: transparent;
            border: 1px solid #e2e8f0;
            color: #475569;
            padding: 10px 24px;
            border-radius: 12px;
            font-weight: 500;
            font-size: 14px;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            text-decoration: none;
            transition: all 0.2s;
        }
        .btn-outline-custom:hover {
            background: #f8fafc;
            border-color: #94a3b8;
        }

        .btn-danger {
            background: transparent;
            border: 1px solid #fecaca;
            color: #dc2626;
            padding: 10px 24px;
            border-radius: 12px;
            font-weight: 500;
            font-size: 14px;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            transition: all 0.2s;
        }
        .btn-danger:hover {
            background: #fef2f2;
            border-color: #ef4444;
        }

        .assignee {
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .assignee-avatar {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background: linear-gradient(135deg, #6366f1, #8b5cf6);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            font-size: 14px;
            flex-shrink: 0;
        }

        @media (max-width: 900px) {
            .detail-grid {
                grid-template-columns: 1fr;
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

        @php
            $status = $application->statusEnum();
        @endphp

        <!-- Хлебные крошки + заголовок -->
        <div class="page-header">
            <div style="flex: 1; min-width: 260px;">
                <div class="breadcrumb">
                    <a href="/">Главная</a>
                    <span>/</span>
                    <a href="{{ route('applications.index') }}">Заявки</a>
                    <span>/</span>
                    <span class="text-gray-600 font-medium">#{{ $application->id }}</span>
                </div>
                <div class="flex flex-wrap items-center gap-3 mt-1">
                    <h1>{{ $application->title }}</h1>
                    <span class="pill badge-{{ $status->color() }}">
                        <i class="fas {{ $status->icon() }}" style="font-size: 10px;"></i>
                        {{ $status->label() }}
                    </span>
                    <span class="id-chip">#{{ $application->id }}</span>
                </div>
                <p class="text-gray-500 text-sm mt-0.5">
                    Создана {{ $application->created_at?->format('d.m.Y H:i') }}
                    ({{ $application->created_at?->diffForHumans() }})
                </p>
            </div>

            <div class="actions">
                <a href="{{ route('applications.index') }}" class="btn-outline-custom">
                    <i class="fas fa-arrow-left"></i> К списку
                </a>
                <a href="{{ route('applications.edit', $application) }}" class="btn-primary-custom">
                    <i class="fas fa-edit"></i> Редактировать
                </a>
                <form action="{{ route('applications.destroy', $application) }}" method="POST" class="contents"
                      onsubmit="return confirm('Удалить заявку «{{ $application->title }}»?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn-danger">
                        <i class="fas fa-trash"></i> Удалить
                    </button>
                </form>
            </div>
        </div>

        <!-- Контент -->
        <div class="detail-grid">
            <!-- Описание -->
            <div class="card">
                <div class="card-header">
                    <h2><i class="fas fa-align-left text-indigo-500"></i> Описание заявки</h2>
                    <span class="text-xs text-gray-400">
                        {{ \Illuminate\Support\Str::of($application->description ?? '')->length() }} симв.
                    </span>
                </div>
                <div class="card-body">
                    @if($application->description)
                        <div class="description">{{ $application->description }}</div>
                    @else
                        <div class="description-empty">
                            <i class="fas fa-pen"></i> Описание не заполнено
                        </div>
                    @endif
                </div>
            </div>

            <!-- Детали -->
            <div class="card">
                <div class="card-header">
                    <h2><i class="fas fa-info-circle text-indigo-500"></i> Детали</h2>
                </div>
                <div class="card-body" style="padding-top: 0.5rem; padding-bottom: 0.5rem;">
                    <div class="detail-list">
                        <div class="detail-row">
                            <span class="label"><i class="fas fa-sitemap"></i> Отдел</span>
                            <span class="value">
                                {{ $application->department?->title ?? '—' }}
                            </span>
                        </div>

                        <div class="detail-row">
                            <span class="label"><i class="fas fa-user-check"></i> Ответственный</span>
                            <span class="value">
                                @if($application->user)
                                    <span class="assignee">
                                        <span class="assignee-avatar">{{ strtoupper(substr($application->user->name, 0, 1)) }}</span>
                                        <span>
                                            {{ $application->user->name }}
                                            <small class="block text-gray-400 font-normal">{{ $application->user->email }}</small>
                                        </span>
                                    </span>
                                @else
                                    <span class="text-gray-400 font-normal">Не назначен</span>
                                @endif
                            </span>
                        </div>

                        <div class="detail-row">
                            <span class="label"><i class="fas fa-flag"></i> Статус</span>
                            <span class="value">
                                <span class="pill badge-{{ $status->color() }}">
                                    <i class="fas {{ $status->icon() }}" style="font-size: 10px;"></i>
                                    {{ $status->label() }}
                                </span>
                            </span>
                        </div>

                        <div class="detail-row">
                            <span class="label"><i class="fas fa-calendar-plus"></i> Создана</span>
                            <span class="value">
                                {{ $application->created_at?->format('d.m.Y H:i') }}
                                <small class="block text-gray-400 font-normal">{{ $application->created_at?->diffForHumans() }}</small>
                            </span>
                        </div>

                        <div class="detail-row">
                            <span class="label"><i class="fas fa-sync"></i> Обновлена</span>
                            <span class="value">
                                {{ $application->updated_at?->format('d.m.Y H:i') }}
                                <small class="block text-gray-400 font-normal">{{ $application->updated_at?->diffForHumans() }}</small>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
