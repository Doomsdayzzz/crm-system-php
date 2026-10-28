@extends('layouts.main')

@section('title', 'Заявки CRM')

@push('styles')
    <style>
        /* Карточки статистики */
        .stat-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1rem;
            margin-bottom: 1.5rem;
        }

        .stat-card {
            background: white;
            border-radius: 16px;
            padding: 1.25rem 1.5rem;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.06);
            border: 1px solid #f1f5f9;
            transition: all 0.3s ease;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .stat-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.08);
        }

        .stat-icon {
            width: 48px;
            height: 48px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            flex-shrink: 0;
        }

        /* Таблица */
        .table-wrapper {
            background: white;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.06);
            border: 1px solid #f1f5f9;
        }

        .table-wrapper table {
            width: 100%;
            border-collapse: collapse;
        }

        .table-wrapper thead {
            background: #f8fafc;
            border-bottom: 2px solid #f1f5f9;
        }

        .table-wrapper thead th {
            font-weight: 600;
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: #64748b;
            padding: 12px 16px;
            text-align: left;
            border: none;
            white-space: nowrap;
        }

        .table-wrapper tbody td {
            padding: 12px 16px;
            vertical-align: middle;
            border-bottom: 1px solid #f1f5f9;
            color: #1e293b;
            font-size: 14px;
        }

        .table-wrapper tbody tr:last-child td {
            border-bottom: none;
        }

        .table-wrapper tbody tr:hover {
            background: #f8fafc;
        }

        .app-cell {
            display: flex;
            align-items: center;
            gap: 12px;
            min-width: 220px;
        }

        .app-icon {
            width: 40px;
            height: 40px;
            border-radius: 12px;
            background: linear-gradient(135deg, #6366f1, #8b5cf6);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .app-title {
            font-weight: 600;
            color: #1e293b;
            display: block;
        }

        .app-title:hover {
            color: #4f46e5;
        }

        .app-desc {
            font-size: 12px;
            color: #94a3b8;
            display: block;
            max-width: 320px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        /* Плашки */
        .pill {
            padding: 4px 12px;
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

        .dept-badge {
            background: #f1f5f9;
            color: #475569;
            padding: 4px 10px;
            border-radius: 8px;
            font-size: 12px;
            font-weight: 500;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            white-space: nowrap;
        }

        /* Кнопки действий */
        .btn-action {
            width: 32px;
            height: 32px;
            border-radius: 8px;
            border: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            transition: all 0.2s;
            color: #94a3b8;
            background: transparent;
            cursor: pointer;
        }

        .btn-action:hover {
            background: #f1f5f9;
            color: #1e293b;
        }

        .btn-action-edit:hover {
            background: #eef2ff;
            color: #4f46e5;
        }

        .btn-action-view:hover {
            background: #ecfeff;
            color: #0891b2;
        }

        .btn-action-delete:hover {
            background: #fee2e2;
            color: #dc2626;
        }

        /* Пагинация */
        .pagination-wrapper {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            justify-content: space-between;
            padding: 1rem 1.5rem;
            border-top: 1px solid #f1f5f9;
            gap: 1rem;
        }

        .pagination-links {
            display: flex;
            gap: 4px;
            flex-wrap: wrap;
        }

        .pagination-links a,
        .pagination-links span {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 36px;
            height: 36px;
            padding: 0 10px;
            border-radius: 8px;
            border: 1px solid #e2e8f0;
            color: #1e293b;
            font-size: 14px;
            font-weight: 500;
            transition: all 0.2s;
            background: white;
            text-decoration: none;
        }

        .pagination-links a:hover {
            background: #f1f5f9;
            border-color: #cbd5e1;
        }

        .pagination-links .active span {
            background: #6366f1;
            border-color: #6366f1;
            color: white;
        }

        .pagination-links .disabled span {
            opacity: 0.5;
            pointer-events: none;
        }

        /* Фильтры */
        .filter-bar {
            background: white;
            border-radius: 16px;
            padding: 1rem 1.25rem;
            border: 1px solid #f1f5f9;
            margin-bottom: 1.5rem;
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            gap: 0.75rem;
        }

        .filter-bar input,
        .filter-bar select {
            border-radius: 10px;
            border: 1px solid #e2e8f0;
            font-size: 14px;
            padding: 8px 14px;
            background: #f8fafc;
            transition: all 0.2s;
            min-width: 140px;
            outline: none;
        }

        .filter-bar input:focus,
        .filter-bar select:focus {
            background: white;
            border-color: #6366f1;
            box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.1);
        }

        .filter-bar .search-wrap {
            flex: 1;
            min-width: 180px;
            display: flex;
            align-items: center;
            background: #f8fafc;
            border-radius: 10px;
            border: 1px solid #e2e8f0;
            padding: 0 12px;
            transition: all 0.2s;
        }

        .filter-bar .search-wrap:focus-within {
            background: white;
            border-color: #6366f1;
            box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.1);
        }

        .filter-bar .search-wrap input {
            border: none;
            background: transparent;
            padding: 8px 8px;
            flex: 1;
            min-width: 100px;
        }

        .filter-bar .search-wrap input:focus {
            box-shadow: none;
        }

        .filter-bar .search-wrap i {
            color: #94a3b8;
        }

        /* Адаптив */
        @media (max-width: 768px) {
            .table-wrapper {
                overflow-x: auto;
            }

            .stat-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .filter-bar {
                flex-direction: column;
                align-items: stretch;
            }

            .filter-bar .search-wrap {
                min-width: auto;
            }

            .pagination-wrapper {
                flex-direction: column;
                align-items: center;
                text-align: center;
            }
        }

        @media (max-width: 480px) {
            .stat-grid {
                grid-template-columns: 1fr;
            }

            .stat-card {
                padding: 1rem;
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

        <!-- Заголовок -->
        <div class="flex flex-wrap items-center justify-between gap-3 mb-6">
            <div>
                <h1 class="text-2xl md:text-3xl font-bold text-gray-800">
                    <i class="fas fa-inbox text-indigo-500 mr-2"></i>Заявки
                </h1>
                <p class="text-gray-500 text-sm mt-0.5">Управление заявками CRM-системы</p>
            </div>
            <div class="flex flex-wrap gap-2">
                <button class="btn-outline-custom text-sm" onclick="alert('📥 Экспорт данных (заглушка)')">
                    <i class="fas fa-download"></i> Экспорт
                </button>

                <a href="{{ route('applications.create') }}">
                    <button class="btn-primary-custom text-sm">
                        <i class="fas fa-plus"></i> Создать заявку
                    </button>
                </a>
            </div>
        </div>

        <!-- Статистика -->
        <div class="stat-grid">
            <div class="stat-card">
                <div>
                    <p class="text-gray-500 text-xs font-semibold uppercase tracking-wider">Всего</p>
                    <h3 class="text-2xl font-bold">{{ $countApplications }}</h3>
                </div>
                <div class="stat-icon" style="background: #eef2ff; color: #6366f1;">
                    <i class="fas fa-layer-group"></i>
                </div>
            </div>
            <div class="stat-card">
                <div>
                    <p class="text-gray-500 text-xs font-semibold uppercase tracking-wider">Новые</p>
                    <h3 class="text-2xl font-bold text-blue-600">{{ $countNew }}</h3>
                </div>
                <div class="stat-icon" style="background: #dbeafe; color: #2563eb;">
                    <i class="fas fa-inbox"></i>
                </div>
            </div>
            <div class="stat-card">
                <div>
                    <p class="text-gray-500 text-xs font-semibold uppercase tracking-wider">В работе</p>
                    <h3 class="text-2xl font-bold text-amber-600">{{ $countInProgress }}</h3>
                </div>
                <div class="stat-icon" style="background: #fef3c7; color: #d97706;">
                    <i class="fas fa-spinner"></i>
                </div>
            </div>
            <div class="stat-card">
                <div>
                    <p class="text-gray-500 text-xs font-semibold uppercase tracking-wider">Закрыты</p>
                    <h3 class="text-2xl font-bold text-emerald-600">{{ $countClosed }}</h3>
                </div>
                <div class="stat-icon" style="background: #dcfce7; color: #059669;">
                    <i class="fas fa-check-double"></i>
                </div>
            </div>
        </div>

        <!-- Фильтры -->
        <form action="{{ route('applications.index') }}" method="GET">
            <div class="filter-bar">
                <div class="search-wrap">
                    <i class="fas fa-search"></i>
                    <input name="search" value="{{ request('search') }}" type="text" placeholder="Поиск по названию заявки...">
                </div>
                <select name="status">
                    @foreach(\App\Enums\ApplicationStatusEnum::filterOptions() as $value => $label)
                        <option value="{{ $value }}" @if((string) request('status') === (string) $value) selected @endif>
                            {{ $label }}
                        </option>
                    @endforeach
                </select>
                <select name="department_id">
                    <option value="">Все отделы</option>
                    @foreach($departments as $department)
                        <option value="{{ $department->id }}" @if(request('department_id') == $department->id) selected @endif>
                            {{ $department->title }}
                        </option>
                    @endforeach
                </select>
                <button class="btn-primary-custom text-sm px-4 py-2" type="submit">
                    <i class="fas fa-filter"></i> Применить
                </button>
                <a href="{{ route('applications.index') }}" class="btn-outline-custom text-sm px-4 py-2">
                    <i class="fas fa-undo"></i> Сбросить
                </a>
            </div>
        </form>

        <!-- Таблица -->
        <div class="table-wrapper">
            <div class="overflow-x-auto">
                <table>
                    <thead>
                    <tr>
                        <th style="width: 40px;">
                            <input type="checkbox" class="rounded border-gray-300 text-indigo-600 focus:ring-indigo-500"
                                   id="selectAll">
                        </th>
                        <th>№</th>
                        <th>Заявка</th>
                        <th>Отдел</th>
                        <th>Ответственный</th>
                        <th>Статус</th>
                        <th>Создана</th>
                        <th style="text-align: right;">Действия</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($applications as $application)
                        @php
                            $status = $application->statusEnum();
                        @endphp
                        <tr>
                            <td>
                                <input type="checkbox"
                                       class="rounded border-gray-300 text-indigo-600 focus:ring-indigo-500 app-checkbox">
                            </td>
                            <td>
                                <span class="text-gray-400 font-medium">#{{ $application->id }}</span>
                            </td>
                            <td>
                                <div class="app-cell">
                                    <div class="app-icon">
                                        <i class="fas fa-file-alt"></i>
                                    </div>
                                    <div>
                                        <a href="{{ route('applications.show', $application) }}" class="app-title">
                                            {{ $application->title }}
                                        </a>
                                        <span class="app-desc">{{ $application->description ?: 'Без описания' }}</span>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <span class="dept-badge">
                                    <i class="fas fa-sitemap text-indigo-400"></i>
                                    {{ $application->department?->title ?? '—' }}
                                </span>
                            </td>
                            <td>
                                @if($application->user)
                                    <div class="flex items-center gap-2">
                                        <i class="fas fa-user-circle text-gray-400"></i>
                                        <span>{{ $application->user->name }}</span>
                                    </div>
                                @else
                                    <span class="text-gray-400">Не назначен</span>
                                @endif
                            </td>
                            <td>
                                <span class="pill badge-{{ $status->color() }}">
                                    <i class="fas {{ $status->icon() }}" style="font-size: 10px;"></i>
                                    {{ $status->label() }}
                                </span>
                            </td>
                            <td>
                                <div class="flex flex-col">
                                    <span>{{ $application->created_at?->format('d.m.Y') }}</span>
                                    <small class="text-gray-400 text-xs">{{ $application->created_at?->diffForHumans() }}</small>
                                </div>
                            </td>
                            <td>
                                <div class="flex justify-end gap-1">
                                    <a href="{{ route('applications.show', $application) }}">
                                        <button class="btn-action btn-action-view" title="Просмотр">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                    </a>
                                    <a href="{{ route('applications.edit', $application) }}">
                                        <button class="btn-action btn-action-edit" title="Редактировать">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                    </a>
                                    <form method="POST" action="{{ route('applications.destroy', $application) }}"
                                          onsubmit="return confirm('Удалить заявку «{{ $application->title }}»?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-action btn-action-delete" title="Удалить">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center py-12">
                                <div class="flex flex-col items-center">
                                    <i class="fas fa-inbox text-gray-300 text-5xl"></i>
                                    <p class="text-gray-500 mt-3">Заявки не найдены</p>
                                    <a href="{{ route('applications.create') }}" class="btn-primary-custom mt-4">
                                        <i class="fas fa-plus"></i> Создать первую заявку
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Пагинация -->
            @if($applications->hasPages())
                <div class="pagination-wrapper">
                    <div class="text-gray-500 text-sm">
                        Показано <strong>{{ $applications->firstItem() ?? 0 }}</strong> —
                        <strong>{{ $applications->lastItem() ?? 0 }}</strong>
                        из <strong>{{ $applications->total() }}</strong> заявок
                    </div>
                    <div class="pagination-links">
                        {{-- Previous --}}
                        @if($applications->onFirstPage())
                            <span class="disabled"><span><i class="fas fa-chevron-left"></i></span></span>
                        @else
                            <a href="{{ $applications->previousPageUrl() }}"><i class="fas fa-chevron-left"></i></a>
                        @endif

                        {{-- Pages --}}
                        @foreach($applications->links()->elements as $element)
                            @if(is_string($element))
                                <span class="disabled"><span>…</span></span>
                            @endif
                            @if(is_array($element))
                                @foreach($element as $page => $url)
                                    @if($page == $applications->currentPage())
                                        <span class="active"><span>{{ $page }}</span></span>
                                    @else
                                        <a href="{{ $url }}">{{ $page }}</a>
                                    @endif
                                @endforeach
                            @endif
                        @endforeach

                        {{-- Next --}}
                        @if($applications->hasMorePages())
                            <a href="{{ $applications->nextPageUrl() }}"><i class="fas fa-chevron-right"></i></a>
                        @else
                            <span class="disabled"><span><i class="fas fa-chevron-right"></i></span></span>
                        @endif
                    </div>
                </div>
            @endif
        </div>

        <!-- Легенда статусов -->
        <div class="bg-white rounded-2xl p-4 border border-gray-100 shadow-sm mt-4">
            <div class="flex flex-wrap items-center gap-x-5 gap-y-2">
                <h6 class="font-semibold text-sm text-gray-700 mr-1">Статусы:</h6>
                @foreach(\App\Enums\ApplicationStatusEnum::cases() as $case)
                    <span class="pill badge-{{ $case->color() }}">
                        <i class="fas {{ $case->icon() }}" style="font-size: 10px;"></i>
                        {{ $case->label() }}
                    </span>
                @endforeach
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        // Выбрать все
        document.getElementById('selectAll')?.addEventListener('change', function () {
            document.querySelectorAll('.app-checkbox').forEach(cb => {
                cb.checked = this.checked;
            });
        });
    </script>
@endpush
