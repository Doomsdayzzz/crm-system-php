@extends('layouts.main')

@section('title', 'Пользователи CRM')

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

        /* Аватар */
        .user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            font-size: 16px;
            color: white;
            flex-shrink: 0;
        }

        .avatar-colors {
            background: linear-gradient(135deg, #6366f1, #8b5cf6);
        }

        .avatar-colors-2 {
            background: linear-gradient(135deg, #3b82f6, #06b6d4);
        }

        .avatar-colors-3 {
            background: linear-gradient(135deg, #8b5cf6, #ec4899);
        }

        .avatar-colors-4 {
            background: linear-gradient(135deg, #f59e0b, #f97316);
        }

        .avatar-colors-5 {
            background: linear-gradient(135deg, #10b981, #34d399);
        }

        .avatar-colors-6 {
            background: linear-gradient(135deg, #ef4444, #f87171);
        }

        /* Статусы */
        .status-badge {
            padding: 4px 12px;
            border-radius: 50px;
            font-size: 12px;
            font-weight: 500;
            display: inline-flex;
            align-items: center;
            gap: 4px;
            white-space: nowrap;
        }

        .status-active {
            background: #dcfce7;
            color: #166534;
        }

        .status-pending {
            background: #fef3c7;
            color: #92400e;
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
        <!-- Заголовок -->
        <div class="flex flex-wrap items-center justify-between gap-3 mb-6">
            <div>
                <h1 class="text-2xl md:text-3xl font-bold text-gray-800">
                    <i class="fas fa-users text-indigo-500 mr-2"></i>Пользователи
                </h1>
                <p class="text-gray-500 text-sm mt-0.5">Управление пользователями CRM-системы</p>
            </div>
            <div class="flex flex-wrap gap-2">
                <button class="btn-outline-custom text-sm" onclick="alert('📥 Экспорт данных (заглушка)')">
                    <i class="fas fa-download"></i> Экспорт
                </button>

                <a href="{{ route('users.create') }}">
                    <button class="btn-primary-custom text-sm">
                        <i class="fas fa-user-plus"></i> Добавить
                    </button>
                </a>
            </div>
        </div>

        <!-- Статистика -->
        <div class="stat-grid">
            <div class="stat-card">
                <div>
                    <p class="text-gray-500 text-xs font-semibold uppercase tracking-wider">Всего</p>
                    <h3 class="text-2xl font-bold">{{ $users->total() }}</h3>
                </div>
                <div class="stat-icon" style="background: #eef2ff; color: #6366f1;">
                    <i class="fas fa-users"></i>
                </div>
            </div>
            <div class="stat-card">
                <div>
                    <p class="text-gray-500 text-xs font-semibold uppercase tracking-wider">Активные</p>
                    <h3 class="text-2xl font-bold text-emerald-600">{{ $countActiveUsers }}</h3>
                </div>
                <div class="stat-icon" style="background: #dcfce7; color: #059669;">
                    <i class="fas fa-check-circle"></i>
                </div>
            </div>
            <div class="stat-card">
                <div>
                    <p class="text-gray-500 text-xs font-semibold uppercase tracking-wider">Не подтверждены</p>
                    <h3 class="text-2xl font-bold text-amber-600">{{ $countDeactivatedUsers }}</h3>
                </div>
                <div class="stat-icon" style="background: #fef3c7; color: #d97706;">
                    <i class="fas fa-clock"></i>
                </div>
            </div>
            <div class="stat-card">
                <div>
                    <p class="text-gray-500 text-xs font-semibold uppercase tracking-wider">Создано заявок</p>
                    <h3 class="text-2xl font-bold text-purple-600">{{ $countApplications }}</h3>
                </div>
                <div class="stat-icon" style="background: #f3e8ff; color: #7c3aed;">
                    <i class="fas fa-file-inbox"></i>
                </div>
            </div>
        </div>

        <!-- Фильтры -->
        <div class="filter-bar">
            <div class="search-wrap">
                <i class="fas fa-search"></i>
                <input type="text" placeholder="Поиск по имени или email...">
            </div>
            <select>
                <option value="">Все статусы</option>
                <option value="active">Активные</option>
                <option value="pending">Ожидают</option>
                <option value="inactive">Неактивные</option>
            </select>
            <select>
                <option value="">Сортировка</option>
                <option value="name">По имени</option>
                <option value="email">По email</option>
                <option value="created">По дате</option>
            </select>
            <button class="btn-primary-custom text-sm px-4 py-2" onclick="alert('🔍 Фильтры применены (заглушка)')">
                <i class="fas fa-filter"></i> Применить
            </button>
            <button class="btn-outline-custom text-sm px-4 py-2" onclick="alert('🔄 Фильтры сброшены (заглушка)')">
                <i class="fas fa-undo"></i> Сбросить
            </button>
        </div>

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
                        <th>Пользователь</th>
                        <th>Email</th>
                        <th>Статус</th>
                        <th>Заявок</th>
                        <th>Дата регистрации</th>
                        <th style="text-align: right;">Действия</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($users as $user)

                        <tr>
                            <td>
                                <input type="checkbox"
                                       class="rounded border-gray-300 text-indigo-600 focus:ring-indigo-500 user-checkbox">
                            </td>
                            <td>
                                <div class="flex items-center gap-3">
                                    @php
                                        $colors = ['avatar-colors', 'avatar-colors-2', 'avatar-colors-3', 'avatar-colors-4', 'avatar-colors-5', 'avatar-colors-6'];
                                        $colorClass = $colors[array_rand($colors)];
                                        $initial = strtoupper(substr($user->name, 0, 1));
                                    @endphp
                                    <div class="user-avatar {{ $colorClass }}">
                                        {{ $initial }}
                                    </div>
                                    <div>
                                        <div class="font-semibold text-gray-800">{{ $user->name }}</div>
                                        <small class="text-gray-400">ID: #{{ $user->id }}</small>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="flex items-center gap-2">
                                    <i class="fas fa-envelope text-gray-400 text-xs"></i>
                                    <span>{{ $user->email }}</span>
                                </div>
                            </td>
                            <td>
                                @if($user->email_verified_at)
                                    <span class="status-badge status-active">
                                        <i class="fas fa-circle" style="font-size: 6px;"></i>Активный
                                    </span>
                                @else
                                    <span class="status-badge status-pending">
                                        <i class="fas fa-circle" style="font-size: 6px;"></i>Ожидает
                                    </span>
                                @endif
                            </td>
                            <td>
                                <span class="bg-gray-100 text-gray-700 rounded-full px-3 py-1.5 text-sm">
                                    <i class="fas fa-file-inbox mr-1 text-indigo-500"></i>
                                    {{ $user->applications->count() }}
                                </span>
                            </td>
                            <td>
                                <div class="flex flex-col">
                                    <span>{{ $user->created_at->format('d.m.Y') }}</span>
                                    <small
                                        class="text-gray-400 text-xs">{{ $user->created_at->diffForHumans() }}</small>
                                </div>
                            </td>
                            <td>
                                <div class="flex justify-end gap-1">
                                    <a href="{{ route('users.edit', $user->id) }}">
                                        <button class="btn-action btn-action-edit" title="Редактировать">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                    </a>
                                    <form method="POST" action="{{ route('users.destroy', $user) }}">
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit" class="btn-action btn-action-delete" title="Удалить">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                    <button class="btn-action" title="Подробнее"
                                            onclick="alert('📋 Информация о пользователе (заглушка)')">
                                        <i class="fas fa-ellipsis-v"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-12">
                                <div class="flex flex-col items-center">
                                    <i class="fas fa-users-slash text-gray-300 text-5xl"></i>
                                    <p class="text-gray-500 mt-3">Пользователи не найдены</p>
                                    <button class="btn-primary-custom mt-4"
                                            onclick="alert('➕ Добавить первого пользователя (заглушка)')">
                                        <i class="fas fa-user-plus"></i> Добавить первого пользователя
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Пагинация -->
            @if($users->hasPages())
                <div class="pagination-wrapper">
                    <div class="text-gray-500 text-sm">
                        Показано <strong>{{ $users->firstItem() ?? 0 }}</strong> —
                        <strong>{{ $users->lastItem() ?? 0 }}</strong>
                        из <strong>{{ $users->total() }}</strong> пользователей
                    </div>
                    <div class="pagination-links">
                        {{-- Previous --}}
                        @if($users->onFirstPage())
                            <span class="disabled"><span><i class="fas fa-chevron-left"></i></span></span>
                        @else
                            <a href="{{ $users->previousPageUrl() }}"><i class="fas fa-chevron-left"></i></a>
                        @endif

                        {{-- Pages --}}
                        @foreach($users->links()->elements as $element)
                            @if(is_string($element))
                                <span class="disabled"><span>…</span></span>
                            @endif
                            @if(is_array($element))
                                @foreach($element as $page => $url)
                                    @if($page == $users->currentPage())
                                        <span class="active"><span>{{ $page }}</span></span>
                                    @else
                                        <a href="{{ $url }}">{{ $page }}</a>
                                    @endif
                                @endforeach
                            @endif
                        @endforeach

                        {{-- Next --}}
                        @if($users->hasMorePages())
                            <a href="{{ $users->nextPageUrl() }}"><i class="fas fa-chevron-right"></i></a>
                        @else
                            <span class="disabled"><span><i class="fas fa-chevron-right"></i></span></span>
                        @endif
                    </div>
                </div>
            @endif
        </div>

        <!-- Информационные панели -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-3 mt-4">
            <div class="bg-white rounded-2xl p-4 border border-gray-100 shadow-sm">
                <div class="flex items-center gap-3">
                    <div class="w-3 h-3 bg-indigo-500 rounded-full flex-shrink-0"></div>
                    <div>
                        <h6 class="font-semibold text-sm">Активные пользователи</h6>
                        <p class="text-gray-500 text-xs">Пользователи с подтвержденным email имеют доступ ко всем
                            функциям</p>
                    </div>
                </div>
            </div>
            <div class="bg-white rounded-2xl p-4 border border-gray-100 shadow-sm">
                <div class="flex items-center gap-3">
                    <div class="w-3 h-3 bg-amber-500 rounded-full flex-shrink-0"></div>
                    <div>
                        <h6 class="font-semibold text-sm">Ожидают подтверждения</h6>
                        <p class="text-gray-500 text-xs">Этим пользователям еще не отправлено письмо с
                            подтверждением</p>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection

@push('scripts')
    <script>
        // Выбрать все
        document.getElementById('selectAll')?.addEventListener('change', function () {
            document.querySelectorAll('.user-checkbox').forEach(cb => {
                cb.checked = this.checked;
            });
        });
    </script>
@endpush
