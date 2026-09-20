<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'CRM System')</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,wght@0,300;0,400;0,500;0,600;0,700;1,400&display=swap" rel="stylesheet">

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        * {
            font-family: 'Inter', sans-serif;
        }

        .min-h-screen {
            min-height: 100vh;
        }

        .glass-effect {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-bottom: 1px solid rgba(229, 231, 235, 0.5);
        }

        .notification-dot {
            animation: pulse-dot 2s infinite;
        }
        @keyframes pulse-dot {
            0%, 100% { transform: scale(1); opacity: 1; }
            50% { transform: scale(1.3); opacity: 0.7; }
        }

        .footer-gradient {
            background: linear-gradient(135deg, #1e1b4b 0%, #312e81 50%, #4c1d95 100%);
        }

        .search-input-wrapper {
            position: relative;
            width: 100%;
            max-width: 480px;
        }
        .search-input-wrapper input {
            width: 100%;
            padding: 10px 16px 10px 44px;
            background: #f1f5f9;
            border: 1px solid transparent;
            border-radius: 12px;
            font-size: 14px;
            transition: all 0.3s ease;
            outline: none;
        }
        .search-input-wrapper input:focus {
            background: white;
            border-color: #6366f1;
            box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.1);
        }
        .search-input-wrapper .search-icon {
            position: absolute;
            left: 16px;
            top: 50%;
            transform: translateY(-50%);
            color: #94a3b8;
            font-size: 14px;
        }
        .search-input-wrapper .search-shortcut {
            position: absolute;
            right: 12px;
            top: 50%;
            transform: translateY(-50%);
            font-size: 11px;
            color: #94a3b8;
            background: white;
            padding: 2px 10px;
            border-radius: 6px;
            border: 1px solid #e2e8f0;
            font-family: monospace;
            display: none;
        }
        @media (min-width: 640px) {
            .search-input-wrapper .search-shortcut {
                display: block;
            }
        }

        #mobileMenu {
            max-height: 80vh;
            overflow-y: auto;
        }

        .footer-grid {
            display: grid;
            grid-template-columns: 1fr;
            gap: 2rem;
        }
        @media (min-width: 768px) {
            .footer-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }
        @media (min-width: 1024px) {
            .footer-grid {
                grid-template-columns: repeat(4, 1fr);
            }
        }

        .main-content {
            padding: 1.5rem 1rem;
        }
        @media (min-width: 640px) {
            .main-content {
                padding: 2rem 1.5rem;
            }
        }
        @media (min-width: 1024px) {
            .main-content {
                padding: 2rem 2rem;
            }
        }

        .btn-primary-custom {
            background: linear-gradient(135deg, #6366f1, #8b5cf6);
            border: none;
            color: white;
            padding: 10px 24px;
            border-radius: 12px;
            font-weight: 500;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            cursor: pointer;
        }
        .btn-primary-custom:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(99, 102, 241, 0.4);
            color: white;
        }

        .btn-outline-custom {
            background: transparent;
            border: 1px solid #e2e8f0;
            color: #475569;
            padding: 10px 24px;
            border-radius: 12px;
            font-weight: 500;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            cursor: pointer;
        }
        .btn-outline-custom:hover {
            background: #f8fafc;
            border-color: #94a3b8;
        }

        /* Сброс Bootstrap конфликтов */
        .container-fluid {
            width: 100%;
        }
        .px-0 {
            padding-left: 0;
            padding-right: 0;
        }
    </style>

    @stack('styles')
</head>
<body class="bg-gray-50 antialiased">
<div class="min-h-screen flex flex-col">

    <!-- ========== ШАПКА (HEADER) ========== -->
    <header class="glass-effect sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-wrap items-center justify-between py-3 md:py-4 gap-3">

                <!-- Левая часть -->
                <div class="flex items-center gap-3 flex-shrink-0">
                    <button id="mobileMenuToggle" class="lg:hidden text-gray-600 hover:text-indigo-600 transition-colors p-1">
                        <i class="fas fa-bars text-2xl"></i>
                    </button>

                    <a href="#" class="flex items-center gap-3 group flex-shrink-0">
                        <div class="w-10 h-10 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-xl flex items-center justify-center shadow-lg group-hover:shadow-indigo-300/50 transition-shadow flex-shrink-0">
                            <i class="fas fa-rocket text-white text-xl"></i>
                        </div>
                        <div class="hidden sm:block">
                            <span class="text-xl font-bold bg-gradient-to-r from-indigo-600 to-purple-600 bg-clip-text text-transparent">
                                CRM<span class="text-gray-800">Pro</span>
                            </span>
                            <span class="text-xs text-gray-400 block -mt-1">v2.0</span>
                        </div>
                    </a>
                </div>

                <!-- Поиск -->
                <div class="hidden md:block flex-1 max-w-xl mx-4">
                    <div class="search-input-wrapper">
                        <i class="fas fa-search search-icon"></i>
                        <input type="text" placeholder="Поиск контактов, заявок, сделок...">
                        <span class="search-shortcut">⌘K</span>
                    </div>
                </div>

                <!-- Правая часть -->
                <div class="flex items-center gap-2 sm:gap-4 flex-shrink-0">
                    <button class="md:hidden text-gray-600 hover:text-indigo-600 transition-colors p-1">
                        <i class="fas fa-search text-xl"></i>
                    </button>

                    <div class="relative">
                        <button class="relative p-2 rounded-xl hover:bg-gray-100 transition-colors">
                            <i class="far fa-bell text-xl text-gray-600"></i>
                            <span class="notification-dot absolute -top-0.5 -right-0.5 w-5 h-5 bg-red-500 text-white text-[10px] font-bold rounded-full flex items-center justify-center">
                                12
                            </span>
                        </button>
                    </div>

                    <div class="hidden sm:block w-px h-8 bg-gray-200"></div>

                    <div class="relative" x-data="{ open: false }">
                        <button @click="open = !open" class="flex items-center gap-2 group">
                            <div class="relative flex-shrink-0">
                                <img src="https://ui-avatars.com/api/?name=Admin+User&background=6366f1&color=fff&size=40"
                                     alt="Avatar"
                                     class="w-10 h-10 rounded-full border-2 border-white shadow-md group-hover:border-indigo-400 transition-all">
                                <div class="absolute bottom-0 right-0 w-3 h-3 bg-green-400 border-2 border-white rounded-full"></div>
                            </div>
                            <div class="hidden lg:block text-left min-w-0">
                                <p class="text-sm font-semibold text-gray-800 truncate">Алексей Иванов</p>
                                <p class="text-xs text-gray-500">Администратор</p>
                            </div>
                            <i class="fas fa-chevron-down text-xs text-gray-400 hidden lg:block group-hover:text-indigo-600 transition-colors"></i>
                        </button>

                        <div x-show="open" @click.away="open = false"
                             class="absolute right-0 mt-3 w-72 bg-white rounded-2xl shadow-2xl border border-gray-100 overflow-hidden transition-all origin-top-right"
                             x-transition:enter="transition ease-out duration-200"
                             x-transition:enter-start="opacity-0 scale-95"
                             x-transition:enter-end="opacity-100 scale-100">

                            <div class="px-4 py-4 bg-gradient-to-r from-indigo-50 to-purple-50 border-b border-gray-100">
                                <div class="flex items-center gap-3">
                                    <img src="https://ui-avatars.com/api/?name=Admin+User&background=6366f1&color=fff&size=40"
                                         alt="Avatar" class="w-12 h-12 rounded-full border-2 border-white shadow flex-shrink-0">
                                    <div class="min-w-0">
                                        <p class="font-semibold text-gray-800 truncate">Алексей Иванов</p>
                                        <p class="text-sm text-gray-500 truncate">alex@crmpro.com</p>
                                    </div>
                                </div>
                            </div>

                            <div class="py-2">
                                <a href="#" class="flex items-center px-4 py-3 hover:bg-indigo-50 transition-colors group">
                                    <i class="fas fa-user w-6 text-indigo-500 group-hover:text-indigo-700"></i>
                                    <span class="text-sm text-gray-700 group-hover:text-indigo-700">Мой профиль</span>
                                </a>
                                <a href="#" class="flex items-center px-4 py-3 hover:bg-indigo-50 transition-colors group">
                                    <i class="fas fa-cog w-6 text-indigo-500 group-hover:text-indigo-700"></i>
                                    <span class="text-sm text-gray-700 group-hover:text-indigo-700">Настройки</span>
                                </a>
                                <a href="#" class="flex items-center px-4 py-3 hover:bg-indigo-50 transition-colors group">
                                    <i class="fas fa-question-circle w-6 text-indigo-500 group-hover:text-indigo-700"></i>
                                    <span class="text-sm text-gray-700 group-hover:text-indigo-700">Помощь</span>
                                </a>
                                <div class="border-t border-gray-100 my-1"></div>
                                <a href="#" class="flex items-center px-4 py-3 hover:bg-red-50 transition-colors group">
                                    <i class="fas fa-sign-out-alt w-6 text-red-500 group-hover:text-red-700"></i>
                                    <span class="text-sm text-red-600 group-hover:text-red-700">Выйти</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Мобильное меню -->
        <div id="mobileMenu" class="lg:hidden hidden bg-white border-t border-gray-100 shadow-lg">
            <div class="px-4 py-3 space-y-1">
                <a href="#" class="flex items-center px-4 py-2.5 rounded-xl hover:bg-indigo-50 transition-colors">
                    <i class="fas fa-th-large w-6 text-indigo-500"></i>
                    <span class="text-sm text-gray-700">Дашборд</span>
                </a>
                <a href="#" class="flex items-center px-4 py-2.5 rounded-xl hover:bg-indigo-50 transition-colors">
                    <i class="fas fa-inbox w-6 text-indigo-500"></i>
                    <span class="text-sm text-gray-700">Заявки</span>
                    <span class="ml-auto bg-red-500 text-white text-xs px-2 py-0.5 rounded-full">12</span>
                </a>
                <a href="#" class="flex items-center px-4 py-2.5 rounded-xl hover:bg-indigo-50 transition-colors">
                    <i class="fas fa-users w-6 text-indigo-500"></i>
                    <span class="text-sm text-gray-700">Контакты</span>
                </a>
                <a href="#" class="flex items-center px-4 py-2.5 rounded-xl hover:bg-indigo-50 transition-colors">
                    <i class="fas fa-chart-line w-6 text-indigo-500"></i>
                    <span class="text-sm text-gray-700">Сделки</span>
                </a>
                <a href="#" class="flex items-center px-4 py-2.5 rounded-xl hover:bg-indigo-50 transition-colors">
                    <i class="fas fa-tasks w-6 text-indigo-500"></i>
                    <span class="text-sm text-gray-700">Задачи</span>
                </a>
            </div>
        </div>
    </header>

    <!-- ========== ОСНОВНОЙ КОНТЕНТ ========== -->
    <main class="flex-1 main-content">
        <div class="max-w-7xl mx-auto">
            @yield('content')
        </div>
    </main>

    <!-- ========== ФУТЕР ========== -->
    <footer class="footer-gradient text-white mt-auto">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="py-8 md:py-12">
                <div class="footer-grid">

                    <div>
                        <div class="flex items-center gap-2 mb-4">
                            <div class="w-8 h-8 bg-white/20 rounded-lg flex items-center justify-center flex-shrink-0">
                                <i class="fas fa-rocket text-white"></i>
                            </div>
                            <span class="text-lg font-bold">CRM<span class="text-indigo-300">Pro</span></span>
                        </div>
                        <p class="text-gray-300 text-sm leading-relaxed">
                            Современная CRM-система для управления клиентами, заявками и продажами.
                        </p>
                        <div class="flex gap-3 mt-4">
                            <a href="#" class="w-9 h-9 bg-white/10 hover:bg-white/20 rounded-lg flex items-center justify-center transition-all">
                                <i class="fab fa-telegram-plane"></i>
                            </a>
                            <a href="#" class="w-9 h-9 bg-white/10 hover:bg-white/20 rounded-lg flex items-center justify-center transition-all">
                                <i class="fab fa-vk"></i>
                            </a>
                            <a href="#" class="w-9 h-9 bg-white/10 hover:bg-white/20 rounded-lg flex items-center justify-center transition-all">
                                <i class="fab fa-youtube"></i>
                            </a>
                            <a href="#" class="w-9 h-9 bg-white/10 hover:bg-white/20 rounded-lg flex items-center justify-center transition-all">
                                <i class="fab fa-github"></i>
                            </a>
                        </div>
                    </div>

                    <div>
                        <h3 class="text-sm font-semibold uppercase tracking-wider text-indigo-300 mb-4">Навигация</h3>
                        <ul class="space-y-2.5">
                            <li><a href="#" class="text-gray-300 hover:text-white transition-colors text-sm">Главная</a></li>
                            <li><a href="#" class="text-gray-300 hover:text-white transition-colors text-sm">Заявки</a></li>
                            <li><a href="#" class="text-gray-300 hover:text-white transition-colors text-sm">Контакты</a></li>
                            <li><a href="#" class="text-gray-300 hover:text-white transition-colors text-sm">Сделки</a></li>
                            <li><a href="#" class="text-gray-300 hover:text-white transition-colors text-sm">Отчеты</a></li>
                        </ul>
                    </div>

                    <div>
                        <h3 class="text-sm font-semibold uppercase tracking-wider text-indigo-300 mb-4">Поддержка</h3>
                        <ul class="space-y-2.5">
                            <li><a href="#" class="text-gray-300 hover:text-white transition-colors text-sm">FAQ</a></li>
                            <li><a href="#" class="text-gray-300 hover:text-white transition-colors text-sm">Документация</a></li>
                            <li><a href="#" class="text-gray-300 hover:text-white transition-colors text-sm">API</a></li>
                            <li><a href="#" class="text-gray-300 hover:text-white transition-colors text-sm">Блог</a></li>
                            <li><a href="#" class="text-gray-300 hover:text-white transition-colors text-sm">Контакты</a></li>
                        </ul>
                    </div>

                    <div>
                        <h3 class="text-sm font-semibold uppercase tracking-wider text-indigo-300 mb-4">Контакты</h3>
                        <ul class="space-y-3">
                            <li class="flex items-start gap-3 text-sm text-gray-300">
                                <i class="fas fa-envelope mt-0.5 text-indigo-300 flex-shrink-0"></i>
                                <span class="break-all">support@crmpro.com</span>
                            </li>
                            <li class="flex items-start gap-3 text-sm text-gray-300">
                                <i class="fas fa-phone mt-0.5 text-indigo-300 flex-shrink-0"></i>
                                <span>+7 (495) 123-45-67</span>
                            </li>
                            <li class="flex items-start gap-3 text-sm text-gray-300">
                                <i class="fas fa-map-marker-alt mt-0.5 text-indigo-300 flex-shrink-0"></i>
                                <span>Москва, ул. Тверская, д. 1</span>
                            </li>
                        </ul>
                        <div class="mt-4">
                            <div class="flex">
                                <input type="email" placeholder="Email для рассылки"
                                       class="flex-1 px-3 py-2 text-sm bg-white/10 border border-white/10 rounded-l-lg text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-400 min-w-0">
                                <button class="px-4 bg-indigo-500 hover:bg-indigo-600 rounded-r-lg transition-colors flex-shrink-0">
                                    <i class="fas fa-paper-plane"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="mt-8 pt-6 border-t border-white/10 flex flex-col md:flex-row justify-between items-center gap-3">
                    <p class="text-sm text-gray-400 text-center md:text-left">
                        © 2026 CRMPro. Все права защищены.
                    </p>
                    <div class="flex items-center gap-6 text-sm text-gray-400 flex-wrap justify-center">
                        <a href="#" class="hover:text-white transition-colors">Политика конфиденциальности</a>
                        <a href="#" class="hover:text-white transition-colors">Условия использования</a>
                        <a href="#" class="hover:text-white transition-colors">
                            <i class="fas fa-arrow-up"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </footer>

</div>

<!-- Alpine.js -->
<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const toggle = document.getElementById('mobileMenuToggle');
        const menu = document.getElementById('mobileMenu');

        if (toggle && menu) {
            toggle.addEventListener('click', function(e) {
                e.stopPropagation();
                menu.classList.toggle('hidden');
            });

            document.addEventListener('click', function(event) {
                if (!menu.contains(event.target) && !toggle.contains(event.target)) {
                    menu.classList.add('hidden');
                }
            });
        }
    });
</script>

@stack('scripts')
</body>
</html>
