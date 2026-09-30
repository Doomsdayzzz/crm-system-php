@extends('layouts.main')

@section('content')
    <div class="min-h-screen bg-slate-50">

        {{-- ================= HERO ================= --}}
        <section class="relative overflow-hidden bg-gradient-to-br from-indigo-600 via-purple-600 to-pink-600">
            <div class="absolute inset-0 opacity-20">
                <div class="absolute top-0 -left-20 w-96 h-96 bg-white rounded-full blur-3xl"></div>
                <div class="absolute bottom-0 -right-20 w-96 h-96 bg-white rounded-full blur-3xl"></div>
            </div>

            <div class="relative max-w-7xl mx-auto px-6 py-20 lg:py-28">
                <div class="max-w-3xl">
                <span class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-white/20 backdrop-blur text-white text-xs font-semibold uppercase tracking-wider mb-5">
                    <span class="w-2 h-2 rounded-full bg-green-400 animate-pulse"></span>
                    CMS Dashboard
                </span>

                    <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-white leading-tight mb-6">
                        Добро пожаловать
                        @auth
                            , {{ auth()->user()->name }}!
                        @else
                            в панель управления!
                        @endauth
                    </h1>

                    <p class="text-lg md:text-xl text-white/85 leading-relaxed mb-8">
                        Управляйте контентом, пользователями и настройками сайта в одном месте.
                        Всё, что нужно для работы — под рукой.
                    </p>

                    <div class="flex flex-wrap gap-3">
                        @auth
                            <a href="#" class="inline-flex items-center gap-2 px-6 py-3 bg-white text-indigo-700 font-semibold rounded-lg hover:bg-indigo-50 transition shadow-lg shadow-indigo-900/20">
                                <i class="fas fa-gauge-high"></i>
                                Перейти в админку
                            </a>
                            <a href="#" class="inline-flex items-center gap-2 px-6 py-3 bg-white/15 backdrop-blur text-white font-semibold rounded-lg hover:bg-white/25 transition border border-white/30">
                                <i class="fas fa-plus"></i>
                                Создать запись
                            </a>
                        @else
                            <a href="{{ route('register') }}" class="inline-flex items-center gap-2 px-6 py-3 bg-white text-indigo-700 font-semibold rounded-lg hover:bg-indigo-50 transition shadow-lg shadow-indigo-900/20">
                                <i class="fas fa-rocket"></i>
                                Начать бесплатно
                            </a>
                            <a href="{{ route('login') }}" class="inline-flex items-center gap-2 px-6 py-3 bg-white/15 backdrop-blur text-white font-semibold rounded-lg hover:bg-white/25 transition border border-white/30">
                                <i class="fas fa-right-to-bracket"></i>
                                Войти
                            </a>
                        @endauth
                    </div>
                </div>
            </div>
        </section>

        {{-- ================= СТАТИСТИКА ================= --}}
        <section class="max-w-7xl mx-auto px-6 -mt-12 relative z-10">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">

                <div class="bg-white rounded-2xl p-6 shadow-sm border border-slate-100 hover:shadow-lg hover:-translate-y-1 transition-all">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-12 h-12 rounded-xl bg-indigo-50 flex items-center justify-center">
                            <i class="fas fa-file-lines text-indigo-600 text-lg"></i>
                        </div>
                        <span class="text-xs font-semibold text-green-600 bg-green-50 px-2 py-1 rounded-full">+12%</span>
                    </div>
                    <div class="text-3xl font-bold text-slate-800">1 248</div>
                    <div class="text-sm text-slate-500 mt-1">Записей</div>
                </div>

                <div class="bg-white rounded-2xl p-6 shadow-sm border border-slate-100 hover:shadow-lg hover:-translate-y-1 transition-all">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-12 h-12 rounded-xl bg-purple-50 flex items-center justify-center">
                            <i class="fas fa-users text-purple-600 text-lg"></i>
                        </div>
                        <span class="text-xs font-semibold text-green-600 bg-green-50 px-2 py-1 rounded-full">+5%</span>
                    </div>
                    <div class="text-3xl font-bold text-slate-800">324</div>
                    <div class="text-sm text-slate-500 mt-1">Пользователей</div>
                </div>

                <div class="bg-white rounded-2xl p-6 shadow-sm border border-slate-100 hover:shadow-lg hover:-translate-y-1 transition-all">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-12 h-12 rounded-xl bg-pink-50 flex items-center justify-center">
                            <i class="fas fa-comments text-pink-600 text-lg"></i>
                        </div>
                        <span class="text-xs font-semibold text-green-600 bg-green-50 px-2 py-1 rounded-full">+28%</span>
                    </div>
                    <div class="text-3xl font-bold text-slate-800">2 891</div>
                    <div class="text-sm text-slate-500 mt-1">Комментариев</div>
                </div>

                <div class="bg-white rounded-2xl p-6 shadow-sm border border-slate-100 hover:shadow-lg hover:-translate-y-1 transition-all">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-12 h-12 rounded-xl bg-amber-50 flex items-center justify-center">
                            <i class="fas fa-eye text-amber-600 text-lg"></i>
                        </div>
                        <span class="text-xs font-semibold text-green-600 bg-green-50 px-2 py-1 rounded-full">+18%</span>
                    </div>
                    <div class="text-3xl font-bold text-slate-800">58.4K</div>
                    <div class="text-sm text-slate-500 mt-1">Просмотров</div>
                </div>

            </div>
        </section>

        {{-- ================= МОДУЛИ CMS ================= --}}
        <section class="max-w-7xl mx-auto px-6 py-16">
            <div class="flex items-end justify-between mb-8 flex-wrap gap-4">
                <div>
                    <h2 class="text-3xl font-bold text-slate-800 mb-2">Модули системы</h2>
                    <p class="text-slate-500">Всё для управления сайтом — в одном интерфейсе</p>
                </div>
                <a href="#" class="text-indigo-600 font-semibold hover:text-indigo-700 inline-flex items-center gap-2">
                    Все модули <i class="fas fa-arrow-right text-sm"></i>
                </a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

                {{-- Карточка модуля --}}
                <a href="#" class="group bg-white rounded-2xl p-6 border border-slate-100 hover:border-indigo-200 hover:shadow-xl transition-all">
                    <div class="w-14 h-14 rounded-xl bg-indigo-50 group-hover:bg-indigo-600 flex items-center justify-center mb-5 transition-colors">
                        <i class="fas fa-newspaper text-indigo-600 group-hover:text-white text-xl transition-colors"></i>
                    </div>
                    <h3 class="text-lg font-bold text-slate-800 mb-2">Статьи и блог</h3>
                    <p class="text-sm text-slate-500 leading-relaxed mb-4">
                        Публикуйте новости, статьи и материалы с удобным редактором.
                    </p>
                    <span class="text-sm font-semibold text-indigo-600 inline-flex items-center gap-1 group-hover:gap-2 transition-all">
                    Открыть <i class="fas fa-arrow-right text-xs"></i>
                </span>
                </a>

                <a href="#" class="group bg-white rounded-2xl p-6 border border-slate-100 hover:border-purple-200 hover:shadow-xl transition-all">
                    <div class="w-14 h-14 rounded-xl bg-purple-50 group-hover:bg-purple-600 flex items-center justify-center mb-5 transition-colors">
                        <i class="fas fa-images text-purple-600 group-hover:text-white text-xl transition-colors"></i>
                    </div>
                    <h3 class="text-lg font-bold text-slate-800 mb-2">Медиатека</h3>
                    <p class="text-sm text-slate-500 leading-relaxed mb-4">
                        Загружайте изображения, видео и файлы с превью и тегами.
                    </p>
                    <span class="text-sm font-semibold text-purple-600 inline-flex items-center gap-1 group-hover:gap-2 transition-all">
                    Открыть <i class="fas fa-arrow-right text-xs"></i>
                </span>
                </a>

                <a href="#" class="group bg-white rounded-2xl p-6 border border-slate-100 hover:border-pink-200 hover:shadow-xl transition-all">
                    <div class="w-14 h-14 rounded-xl bg-pink-50 group-hover:bg-pink-600 flex items-center justify-center mb-5 transition-colors">
                        <i class="fas fa-user-shield text-pink-600 group-hover:text-white text-xl transition-colors"></i>
                    </div>
                    <h3 class="text-lg font-bold text-slate-800 mb-2">Пользователи и роли</h3>
                    <p class="text-sm text-slate-500 leading-relaxed mb-4">
                        Управляйте доступом, правами и профилями пользователей.
                    </p>
                    <span class="text-sm font-semibold text-pink-600 inline-flex items-center gap-1 group-hover:gap-2 transition-all">
                    Открыть <i class="fas fa-arrow-right text-xs"></i>
                </span>
                </a>

                <a href="#" class="group bg-white rounded-2xl p-6 border border-slate-100 hover:border-emerald-200 hover:shadow-xl transition-all">
                    <div class="w-14 h-14 rounded-xl bg-emerald-50 group-hover:bg-emerald-600 flex items-center justify-center mb-5 transition-colors">
                        <i class="fas fa-folder-tree text-emerald-600 group-hover:text-white text-xl transition-colors"></i>
                    </div>
                    <h3 class="text-lg font-bold text-slate-800 mb-2">Категории и теги</h3>
                    <p class="text-sm text-slate-500 leading-relaxed mb-4">
                        Структурируйте контент с помощью вложенных категорий.
                    </p>
                    <span class="text-sm font-semibold text-emerald-600 inline-flex items-center gap-1 group-hover:gap-2 transition-all">
                    Открыть <i class="fas fa-arrow-right text-xs"></i>
                </span>
                </a>

                <a href="#" class="group bg-white rounded-2xl p-6 border border-slate-100 hover:border-amber-200 hover:shadow-xl transition-all">
                    <div class="w-14 h-14 rounded-xl bg-amber-50 group-hover:bg-amber-600 flex items-center justify-center mb-5 transition-colors">
                        <i class="fas fa-chart-line text-amber-600 group-hover:text-white text-xl transition-colors"></i>
                    </div>
                    <h3 class="text-lg font-bold text-slate-800 mb-2">Аналитика</h3>
                    <p class="text-sm text-slate-500 leading-relaxed mb-4">
                        Следите за трафиком, конверсиями и популярным контентом.
                    </p>
                    <span class="text-sm font-semibold text-amber-600 inline-flex items-center gap-1 group-hover:gap-2 transition-all">
                    Открыть <i class="fas fa-arrow-right text-xs"></i>
                </span>
                </a>

                <a href="#" class="group bg-white rounded-2xl p-6 border border-slate-100 hover:border-cyan-200 hover:shadow-xl transition-all">
                    <div class="w-14 h-14 rounded-xl bg-cyan-50 group-hover:bg-cyan-600 flex items-center justify-center mb-5 transition-colors">
                        <i class="fas fa-gear text-cyan-600 group-hover:text-white text-xl transition-colors"></i>
                    </div>
                    <h3 class="text-lg font-bold text-slate-800 mb-2">Настройки сайта</h3>
                    <p class="text-sm text-slate-500 leading-relaxed mb-4">
                        Заголовки, метатеги, интеграции и параметры системы.
                    </p>
                    <span class="text-sm font-semibold text-cyan-600 inline-flex items-center gap-1 group-hover:gap-2 transition-all">
                    Открыть <i class="fas fa-arrow-right text-xs"></i>
                </span>
                </a>

            </div>
        </section>

        {{-- ================= ПОСЛЕДНИЕ ЗАПИСИ + АКТИВНОСТЬ ================= --}}
        <section class="max-w-7xl mx-auto px-6 pb-16 grid grid-cols-1 lg:grid-cols-3 gap-6">

            {{-- Последние записи --}}
            <div class="lg:col-span-2 bg-white rounded-2xl border border-slate-100 shadow-sm">
                <div class="flex items-center justify-between p-6 border-b border-slate-100">
                    <h3 class="text-lg font-bold text-slate-800">Последние записи</h3>
                    <a href="#" class="text-sm text-indigo-600 font-semibold hover:text-indigo-700">Все →</a>
                </div>

                <div class="divide-y divide-slate-100">
                    @php
                        $posts = [
                            ['title' => 'Обновление системы до версии 2.0', 'author' => 'Админ', 'date' => '2 часа назад', 'status' => 'published'],
                            ['title' => 'Как настроить SEO в панели', 'author' => 'Иван', 'date' => '5 часов назад', 'status' => 'published'],
                            ['title' => 'Черновик: планы на Q4', 'author' => 'Мария', 'date' => 'вчера', 'status' => 'draft'],
                            ['title' => 'Интеграция с Telegram-ботом', 'author' => 'Админ', 'date' => '2 дня назад', 'status' => 'published'],
                        ];
                    @endphp

                    @foreach ($posts as $post)
                        <div class="flex items-center gap-4 p-5 hover:bg-slate-50 transition-colors">
                            <div class="w-10 h-10 rounded-lg bg-slate-100 flex items-center justify-center flex-shrink-0">
                                <i class="fas fa-file-lines text-slate-500"></i>
                            </div>
                            <div class="flex-1 min-w-0">
                                <div class="font-semibold text-slate-800 truncate">{{ $post['title'] }}</div>
                                <div class="text-xs text-slate-500 mt-0.5">
                                    {{ $post['author'] }} · {{ $post['date'] }}
                                </div>
                            </div>
                            @if ($post['status'] === 'published')
                                <span class="text-xs font-semibold text-green-700 bg-green-50 px-2.5 py-1 rounded-full whitespace-nowrap">Опубликовано</span>
                            @else
                                <span class="text-xs font-semibold text-amber-700 bg-amber-50 px-2.5 py-1 rounded-full whitespace-nowrap">Черновик</span>
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>

            {{-- Активность --}}
            <div class="bg-white rounded-2xl border border-slate-100 shadow-sm">
                <div class="p-6 border-b border-slate-100">
                    <h3 class="text-lg font-bold text-slate-800">Активность</h3>
                </div>

                <div class="p-6 space-y-5">
                    @php
                        $activities = [
                            ['icon' => 'fa-user-plus', 'color' => 'indigo', 'text' => 'Новый пользователь зарегистрирован', 'time' => '10 мин'],
                            ['icon' => 'fa-pen', 'color' => 'purple', 'text' => 'Статья "SEO гайд" обновлена', 'time' => '1 ч'],
                            ['icon' => 'fa-comment', 'color' => 'pink', 'text' => 'Новый комментарий', 'time' => '3 ч'],
                            ['icon' => 'fa-image', 'color' => 'emerald', 'text' => 'Загружено 5 изображений', 'time' => '5 ч'],
                            ['icon' => 'fa-shield', 'color' => 'amber', 'text' => 'Роль "editor" изменена', 'time' => 'вчера'],
                        ];
                    @endphp

                    @foreach ($activities as $a)
                        <div class="flex gap-3">
                            <div class="w-9 h-9 rounded-lg bg-{{ $a['color'] }}-50 flex items-center justify-center flex-shrink-0">
                                <i class="fas {{ $a['icon'] }} text-{{ $a['color'] }}-600 text-sm"></i>
                            </div>
                            <div class="flex-1 min-w-0">
                                <div class="text-sm text-slate-700 leading-snug">{{ $a['text'] }}</div>
                                <div class="text-xs text-slate-400 mt-1">{{ $a['time'] }} назад</div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

        </section>

        {{-- ================= CTA для гостя ================= --}}
        @guest
            <section class="max-w-7xl mx-auto px-6 pb-20">
                <div class="relative overflow-hidden rounded-3xl bg-gradient-to-r from-slate-900 to-slate-800 p-10 md:p-14">
                    <div class="absolute top-0 right-0 w-80 h-80 bg-indigo-500 rounded-full blur-3xl opacity-30"></div>
                    <div class="relative max-w-2xl">
                        <h3 class="text-3xl md:text-4xl font-bold text-white mb-4">
                            Готовы начать работу?
                        </h3>
                        <p class="text-slate-300 text-lg mb-8">
                            Создайте аккаунт за минуту и получите доступ ко всем возможностям CMS.
                        </p>
                        <div class="flex flex-wrap gap-3">
                            <a href="{{ route('register') }}" class="inline-flex items-center gap-2 px-6 py-3 bg-indigo-600 hover:bg-indigo-500 text-white font-semibold rounded-lg transition">
                                <i class="fas fa-rocket"></i> Создать аккаунт
                            </a>
                            <a href="{{ route('login') }}" class="inline-flex items-center gap-2 px-6 py-3 bg-white/10 hover:bg-white/20 text-white font-semibold rounded-lg transition border border-white/20">
                                У меня уже есть аккаунт
                            </a>
                        </div>
                    </div>
                </div>
            </section>
        @endguest

    </div>
@endsection
