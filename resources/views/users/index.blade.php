@extends('layouts.main')

@section('title', 'Пользователи CRM')

@push('styles')
    <style>
        .stat-card {
            background: white;
            border-radius: 16px;
            padding: 20px 24px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.06);
            border: 1px solid #f1f5f9;
            transition: all 0.3s ease;
        }
        .stat-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(0,0,0,0.08);
            border-color: #e2e8f0;
        }
        .stat-icon {
            width: 48px;
            height: 48px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
        }
        .table-custom {
            background: white;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 1px 3px rgba(0,0,0,0.06);
            border: 1px solid #f1f5f9;
        }
        .table-custom thead {
            background: #f8fafc;
            border-bottom: 2px solid #f1f5f9;
        }
        .table-custom thead th {
            font-weight: 600;
            font-size: 13px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: #64748b;
            padding: 14px 20px;
            border: none;
        }
        .table-custom tbody td {
            padding: 16px 20px;
            vertical-align: middle;
            border-bottom: 1px solid #f1f5f9;
            color: #1e293b;
            font-size: 14px;
        }
        .table-custom tbody tr:last-child td {
            border-bottom: none;
        }
        .table-custom tbody tr:hover {
            background: #f8fafc;
            transition: background 0.2s;
        }
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
        .status-badge {
            padding: 4px 12px;
            border-radius: 50px;
            font-size: 12px;
            font-weight: 500;
            display: inline-block;
        }
        .status-active {
            background: #dcfce7;
            color: #166534;
        }
        .status-inactive {
            background: #fee2e2;
            color: #991b1b;
        }
        .status-pending {
            background: #fef3c7;
            color: #92400e;
        }
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
        .filter-bar {
            background: white;
            border-radius: 16px;
            padding: 16px 20px;
            border: 1px solid #f1f5f9;
            margin-bottom: 24px;
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            gap: 12px;
        }
        .filter-bar .form-control,
        .filter-bar .form-select {
            border-radius: 10px;
            border: 1px solid #e2e8f0;
            font-size: 14px;
            padding: 8px 14px;
            background: #f8fafc;
            transition: all 0.2s;
        }
        .filter-bar .form-control:focus,
        .filter-bar .form-select:focus {
            background: white;
            border-color: #6366f1;
            box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.1);
        }
        .pagination-custom {
            display: flex;
            gap: 6px;
            align-items: center;
        }
        .pagination-custom .page-item {
            list-style: none;
        }
        .pagination-custom .page-link {
            display: flex;
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
        .pagination-custom .page-link:hover {
            background: #f1f5f9;
            border-color: #cbd5e1;
        }
        .pagination-custom .active .page-link {
            background: #6366f1;
            border-color: #6366f1;
            color: white;
        }
        .pagination-custom .disabled .page-link {
            opacity: 0.5;
            pointer-events: none;
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
    </style>
@endpush

@section('content')
    <div class="container-fluid px-0">

        <!-- Заголовок страницы -->
        <div class="d-flex flex-wrap align-items-center justify-content-between mb-4">
            <div>
                <h1 class="h2 fw-bold text-gray-800 mb-1">
                    <i class="fas fa-users text-indigo-500 me-2"></i>Пользователи
                </h1>
                <p class="text-muted small">Управление пользователями CRM-системы</p>
            </div>
            <div class="d-flex gap-2">
                <button class="btn btn-outline-secondary rounded-xl px-4 py-2" style="border-color: #e2e8f0;">
                    <i class="fas fa-download me-2"></i>Экспорт
                </button>
                <button class="btn btn-primary rounded-xl px-4 py-2" style="background: linear-gradient(135deg, #6366f1, #8b5cf6); border: none;">
                    <i class="fas fa-user-plus me-2"></i>Добавить пользователя
                </button>
            </div>
        </div>

        <!-- Статистика -->
        <div class="row g-3 mb-4">
            <div class="col-xl-3 col-md-6">
                <div class="stat-card d-flex align-items-center justify-content-between">
                    <div>
                        <p class="text-muted small fw-semibold text-uppercase mb-1">Всего</p>
                        <h3 class="fw-bold mb-0">{{ $users->total() }}</h3>
                    </div>
                    <div class="stat-icon" style="background: #eef2ff; color: #6366f1;">
                        <i class="fas fa-users"></i>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="stat-card d-flex align-items-center justify-content-between">
                    <div>
                        <p class="text-muted small fw-semibold text-uppercase mb-1">Активные</p>
                        <h3 class="fw-bold mb-0 text-emerald-600">{{ $users->where('email_verified_at', '!=', null)->count() }}</h3>
                    </div>
                    <div class="stat-icon" style="background: #dcfce7; color: #059669;">
                        <i class="fas fa-check-circle"></i>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="stat-card d-flex align-items-center justify-content-between">
                    <div>
                        <p class="text-muted small fw-semibold text-uppercase mb-1">Не подтверждены</p>
                        <h3 class="fw-bold mb-0 text-amber-600">{{ $users->where('email_verified_at', null)->count() }}</h3>
                    </div>
                    <div class="stat-icon" style="background: #fef3c7; color: #d97706;">
                        <i class="fas fa-clock"></i>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="stat-card d-flex align-items-center justify-content-between">
                    <div>
                        <p class="text-muted small fw-semibold text-uppercase mb-1">Создано заявок</p>
{{--                        <h3 class="fw-bold mb-0 text-purple-600">{{ $users->sum(fn($u) => $u->applications->count()) }}</h3>--}}
                    </div>
                    <div class="stat-icon" style="background: #f3e8ff; color: #7c3aed;">
                        <i class="fas fa-file-inbox"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Фильтры -->
        <div class="filter-bar">
            <div class="flex-grow-1" style="min-width: 200px;">
                <div class="input-group">
                <span class="input-group-text bg-transparent border-0 pe-0" style="color: #94a3b8;">
                    <i class="fas fa-search"></i>
                </span>
                    <input type="text" class="form-control border-0 ps-1" placeholder="Поиск по имени или email..." style="background: transparent; box-shadow: none;">
                </div>
            </div>
            <select class="form-select" style="width: auto; min-width: 140px;">
                <option value="">Все статусы</option>
                <option value="active">Активные</option>
                <option value="pending">Ожидают</option>
                <option value="inactive">Неактивные</option>
            </select>
            <select class="form-select" style="width: auto; min-width: 140px;">
                <option value="">Сортировка</option>
                <option value="name">По имени</option>
                <option value="email">По email</option>
                <option value="created">По дате</option>
            </select>
            <button class="btn btn-primary rounded-xl px-4" style="background: #6366f1; border: none;">
                <i class="fas fa-filter me-2"></i>Применить
            </button>
            <button class="btn btn-light rounded-xl px-4 border" style="border-color: #e2e8f0;">
                <i class="fas fa-undo me-2"></i>Сбросить
            </button>
        </div>

        <!-- Таблица пользователей -->
        <div class="table-custom">
            <div class="table-responsive">
                <table class="table mb-0">
                    <thead>
                    <tr>
                        <th style="width: 40px;">
                            <input type="checkbox" class="form-check-input" style="cursor: pointer;">
                        </th>
                        <th>Пользователь</th>
                        <th>Email</th>
                        <th>Статус</th>
                        <th>Заявок</th>
                        <th>Дата регистрации</th>
                        <th style="width: 120px; text-align: right;">Действия</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($users as $user)
                        <tr>
                            <td>
                                <input type="checkbox" class="form-check-input" style="cursor: pointer;">
                            </td>
                            <td>
                                <div class="d-flex align-items-center gap-3">
                                    @php
                                        $colors = ['avatar-colors', 'avatar-colors-2', 'avatar-colors-3', 'avatar-colors-4', 'avatar-colors-5', 'avatar-colors-6'];
                                        $colorClass = $colors[array_rand($colors)];
                                        $initial = strtoupper(substr($user->name, 0, 1));
                                    @endphp
                                    <div class="user-avatar {{ $colorClass }}">
                                        {{ $initial }}
                                    </div>
                                    <div>
                                        <div class="fw-semibold text-gray-800">{{ $user->name }}</div>
                                        <small class="text-muted">ID: #{{ $user->id }}</small>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="d-flex align-items-center gap-2">
                                    <i class="fas fa-envelope text-muted small"></i>
                                    <span>{{ $user->email }}</span>
                                </div>
                            </td>
                            <td>
                                @if($user->email_verified_at)
                                    <span class="status-badge status-active">
                                        <i class="fas fa-circle me-1" style="font-size: 6px;"></i>Активный
                                    </span>
                                @else
                                    <span class="status-badge status-pending">
                                        <i class="fas fa-circle me-1" style="font-size: 6px;"></i>Ожидает
                                    </span>
                                @endif
                            </td>
                            <td>
                                <span class="badge bg-light text-dark rounded-pill px-3 py-2">
                                    <i class="fas fa-file-inbox me-1 text-indigo-500"></i>
{{--                                    {{ $user->applications->count() }}--}}
                                </span>
                            </td>
                            <td>
                                <div class="d-flex flex-column">
                                    <span>{{ $user->created_at->format('d.m.Y') }}</span>
                                    <small class="text-muted">{{ $user->created_at->diffForHumans() }}</small>
                                </div>
                            </td>
                            <td>
                                <div class="d-flex justify-content-end gap-1">
                                    <button class="btn-action btn-action-edit" title="Редактировать">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="btn-action btn-action-delete" title="Удалить">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                    <button class="btn-action" title="Подробнее">
                                        <i class="fas fa-ellipsis-v"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-5">
                                <div class="d-flex flex-column align-items-center">
                                    <i class="fas fa-users-slash text-muted" style="font-size: 48px; opacity: 0.3;"></i>
                                    <p class="text-muted mt-3 mb-0">Пользователи не найдены</p>
                                    <button class="btn btn-primary mt-3 rounded-xl px-4" style="background: linear-gradient(135deg, #6366f1, #8b5cf6); border: none;">
                                        <i class="fas fa-user-plus me-2"></i>Добавить первого пользователя
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
                <div class="d-flex flex-wrap align-items-center justify-content-between px-4 py-3 border-top border-light">
                    <div class="text-muted small mb-2 mb-md-0">
                        Показано <strong>{{ $users->firstItem() ?? 0 }}</strong> — <strong>{{ $users->lastItem() ?? 0 }}</strong>
                        из <strong>{{ $users->total() }}</strong> пользователей
                    </div>
                    <div>
                        <ul class="pagination-custom mb-0">
                            {{-- Previous Page Link --}}
                            @if($users->onFirstPage())
                                <li class="page-item disabled"><span class="page-link"><i class="fas fa-chevron-left"></i></span></li>
                            @else
                                <li class="page-item"><a class="page-link" href="{{ $users->previousPageUrl() }}"><i class="fas fa-chevron-left"></i></a></li>
                            @endif

                            {{-- Pagination Elements --}}
                            @foreach($users->links()->elements as $element)
                                {{-- "Three Dots" Separator --}}
                                @if(is_string($element))
                                    <li class="page-item disabled"><span class="page-link">…</span></li>
                                @endif

                                {{-- Array Of Links --}}
                                @if(is_array($element))
                                    @foreach($element as $page => $url)
                                        @if($page == $users->currentPage())
                                            <li class="page-item active"><span class="page-link">{{ $page }}</span></li>
                                        @else
                                            <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                                        @endif
                                    @endforeach
                                @endif
                            @endforeach

                            {{-- Next Page Link --}}
                            @if($users->hasMorePages())
                                <li class="page-item"><a class="page-link" href="{{ $users->nextPageUrl() }}"><i class="fas fa-chevron-right"></i></a></li>
                            @else
                                <li class="page-item disabled"><span class="page-link"><i class="fas fa-chevron-right"></i></span></li>
                            @endif
                        </ul>
                    </div>
                </div>
            @endif
        </div>

        <!-- Информационная панель внизу -->
        <div class="row g-3 mt-3">
            <div class="col-md-6">
                <div class="bg-white rounded-4 p-4 border border-light shadow-sm">
                    <div class="d-flex align-items-center gap-3">
                        <div style="width: 12px; height: 12px; background: #6366f1; border-radius: 50%;"></div>
                        <div>
                            <h6 class="fw-semibold mb-1">Активные пользователи</h6>
                            <p class="text-muted small mb-0">Пользователи с подтвержденным email имеют доступ ко всем функциям</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="bg-white rounded-4 p-4 border border-light shadow-sm">
                    <div class="d-flex align-items-center gap-3">
                        <div style="width: 12px; height: 12px; background: #f59e0b; border-radius: 50%;"></div>
                        <div>
                            <h6 class="fw-semibold mb-1">Ожидают подтверждения</h6>
                            <p class="text-muted small mb-0">Этим пользователям еще не отправлено письмо с подтверждением</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection

@push('scripts')
    <script>
        // Обработка чекбоксов "Выбрать все"
        document.querySelector('thead input[type="checkbox"]')?.addEventListener('change', function() {
            document.querySelectorAll('tbody input[type="checkbox"]').forEach(cb => {
                cb.checked = this.checked;
            });
        });

        // Обработка действий (заглушки)
        document.querySelectorAll('.btn-action-edit').forEach(btn => {
            btn.addEventListener('click', function(e) {
                e.preventDefault();
                alert('✏️ Редактирование пользователя (заглушка)');
            });
        });

        document.querySelectorAll('.btn-action-delete').forEach(btn => {
            btn.addEventListener('click', function(e) {
                e.preventDefault();
                if(confirm('Вы уверены, что хотите удалить этого пользователя?')) {
                    alert('🗑️ Пользователь удален (заглушка)');
                }
            });
        });

        // Кнопка "Добавить пользователя"
        document.querySelector('.btn-primary')?.addEventListener('click', function(e) {
            e.preventDefault();
            alert('➕ Открыть форму добавления пользователя (заглушка)');
        });
    </script>
@endpush
