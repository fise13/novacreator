<?php
/**
 * Общий header для админ-панели
 */
if (!isset($pageTitle)) {
    $pageTitle = 'Админ-панель';
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($pageTitle); ?> - NovaCreator Studio</title>
    <link href="../assets/css/output.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        /* ============================================
           БАЗОВЫЕ СТИЛИ И СБРОС
           ============================================ */
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }
        
        html, body {
            margin: 0;
            padding: 0;
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
            background-color: #0A0A0F;
            color: #ffffff;
            overflow-x: hidden;
            width: 100%;
            max-width: 100vw;
        }
        
        /* ============================================
           ЦВЕТОВАЯ ПАЛИТРА
           ============================================ */
        :root {
            --dark-bg: #0A0A0F;
            --dark-surface: #1a1a24;
            --dark-border: #2a2a3a;
            --neon-purple: #8B5CF6;
            --neon-blue: #06B6D4;
            --gray-300: #D1D5DB;
            --gray-400: #9CA3AF;
            --gray-500: #6B7280;
        }
        
        .bg-dark-bg { background-color: var(--dark-bg) !important; }
        .bg-dark-surface { background-color: var(--dark-surface) !important; }
        .bg-dark-border { background-color: var(--dark-border) !important; }
        .border-dark-border { border-color: var(--dark-border) !important; }
        .text-gray-300 { color: var(--gray-300) !important; }
        .text-gray-400 { color: var(--gray-400) !important; }
        .text-gray-500 { color: var(--gray-500) !important; }
        .text-neon-purple { color: var(--neon-purple) !important; }
        .text-neon-blue { color: var(--neon-blue) !important; }
        
        /* ============================================
           БОКОВОЕ МЕНЮ (МОБИЛЬНОЕ)
           ============================================ */
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            width: 280px;
            height: 100vh;
            background-color: var(--dark-surface);
            border-right: 1px solid var(--dark-border);
            z-index: 1000;
            transform: translateX(-100%);
            transition: transform 0.3s ease;
            overflow-y: auto;
        }
        
        .sidebar.open {
            transform: translateX(0);
        }
        
        #overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 999;
            opacity: 0;
            visibility: hidden;
            transition: opacity 0.3s ease, visibility 0.3s ease;
        }
        
        #overlay.show {
            opacity: 1;
            visibility: visible;
        }
        
        /* На десктопе меню скрыто */
        @media (min-width: 1024px) {
            .sidebar {
                display: none !important;
            }
            #overlay {
                display: none !important;
            }
        }
        
        /* ============================================
           НАВИГАЦИЯ
           ============================================ */
        nav {
            background-color: var(--dark-surface);
            border-bottom: 1px solid var(--dark-border);
            position: sticky;
            top: 0;
            z-index: 100;
            width: 100%;
        }
        
        /* ============================================
           КОНТЕЙНЕРЫ
           ============================================ */
        .container {
            width: 100%;
            max-width: 100%;
            margin-left: auto;
            margin-right: auto;
            padding-left: 1rem;
            padding-right: 1rem;
        }
        
        @media (min-width: 640px) {
            .container {
                max-width: 640px;
                padding-left: 1.5rem;
                padding-right: 1.5rem;
            }
        }
        
        @media (min-width: 768px) {
            .container {
                max-width: 768px;
            }
        }
        
        @media (min-width: 1024px) {
            .container {
                max-width: 1024px;
            }
        }
        
        @media (min-width: 1280px) {
            .container {
                max-width: 1280px;
            }
        }
        
        /* ============================================
           ТИПОГРАФИКА
           ============================================ */
        h1, h2, h3, h4, h5, h6 {
            margin: 0;
            padding: 0;
            font-weight: 700;
            line-height: 1.2;
            word-wrap: break-word;
            overflow-wrap: break-word;
            max-width: 100%;
        }
        
        h1 { font-size: 1.5rem; }
        h2 { font-size: 1.25rem; }
        h3 { font-size: 1.125rem; }
        
        @media (min-width: 640px) {
            h1 { font-size: 1.875rem; }
            h2 { font-size: 1.5rem; }
        }
        
        .text-gradient {
            background: linear-gradient(135deg, var(--neon-purple) 0%, var(--neon-blue) 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            display: inline-block;
            word-wrap: break-word;
            overflow-wrap: break-word;
            max-width: 100%;
        }
        
        /* ============================================
           ФОРМЫ
           ============================================ */
        .form-input,
        .form-textarea,
        .form-select {
            width: 100%;
            padding: 0.75rem 1rem;
            background-color: var(--dark-bg);
            border: 1px solid var(--dark-border);
            border-radius: 0.5rem;
            color: #ffffff;
            font-size: 1rem;
            line-height: 1.5;
            transition: all 0.3s ease;
        }
        
        .form-input:focus,
        .form-textarea:focus,
        .form-select:focus {
            outline: none;
            border-color: var(--neon-purple);
            box-shadow: 0 0 0 2px rgba(139, 92, 246, 0.2);
        }
        
        .form-input::placeholder,
        .form-textarea::placeholder {
            color: var(--gray-500);
        }
        
        .form-textarea {
            resize: vertical;
            min-height: 120px;
        }
        
        .form-select {
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3E%3Cpath stroke='%236B7280' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='M6 8l4 4 4-4'/%3E%3C/svg%3E");
            background-position: right 0.75rem center;
            background-repeat: no-repeat;
            background-size: 1.25em 1.25em;
            padding-right: 2.5rem;
        }
        
        .form-select:focus {
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3E%3Cpath stroke='%238B5CF6' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='M6 8l4 4 4-4'/%3E%3C/svg%3E");
        }
        
        /* ============================================
           КНОПКИ
           ============================================ */
        .btn-neon {
            background: linear-gradient(135deg, var(--neon-purple) 0%, var(--neon-blue) 100%);
            color: white;
            padding: 0.75rem 1.5rem;
            border-radius: 0.5rem;
            font-weight: 600;
            transition: all 0.3s ease;
            border: none;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
            white-space: nowrap;
        }
        
        .btn-neon:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(139, 92, 246, 0.4);
        }
        
        /* ============================================
           УТИЛИТЫ
           ============================================ */
        .flex {
            display: flex;
            min-width: 0;
        }
        
        .flex-1 {
            flex: 1 1 0%;
            min-width: 0;
        }
        
        .items-center {
            align-items: center;
        }
        
        .justify-between {
            justify-content: space-between;
        }
        
        .space-x-2 > * + * { margin-left: 0.5rem; }
        .space-x-3 > * + * { margin-left: 0.75rem; }
        .space-x-4 > * + * { margin-left: 1rem; }
        .space-x-6 > * + * { margin-left: 1.5rem; }
        
        .space-y-2 > * + * { margin-top: 0.5rem; }
        .space-y-4 > * + * { margin-top: 1rem; }
        .space-y-6 > * + * { margin-top: 1.5rem; }
        
        .gap-4 { gap: 1rem; }
        .gap-6 { gap: 1.5rem; }
        
        .w-full { width: 100%; }
        .w-5 { width: 1.25rem; }
        .w-10 { width: 2.5rem; }
        .w-12 { width: 3rem; }
        .w-64 { width: 16rem; }
        
        .h-5 { height: 1.25rem; }
        .h-10 { height: 2.5rem; }
        .h-12 { height: 3rem; }
        .h-16 { height: 4rem; }
        .min-h-screen { min-height: 100vh; }
        
        .p-4 { padding: 1rem; }
        .p-6 { padding: 1.5rem; }
        .p-8 { padding: 2rem; }
        .px-4 { padding-left: 1rem; padding-right: 1rem; }
        .px-6 { padding-left: 1.5rem; padding-right: 1.5rem; }
        .px-8 { padding-left: 2rem; padding-right: 2rem; }
        .py-2 { padding-top: 0.5rem; padding-bottom: 0.5rem; }
        .py-3 { padding-top: 0.75rem; padding-bottom: 0.75rem; }
        .py-4 { padding-top: 1rem; padding-bottom: 1rem; }
        .py-8 { padding-top: 2rem; padding-bottom: 2rem; }
        
        .mb-1 { margin-bottom: 0.25rem; }
        .mb-2 { margin-bottom: 0.5rem; }
        .mb-4 { margin-bottom: 1rem; }
        .mb-6 { margin-bottom: 1.5rem; }
        .mb-8 { margin-bottom: 2rem; }
        
        .mt-1 { margin-top: 0.25rem; }
        .mt-4 { margin-top: 1rem; }
        
        .rounded-lg { border-radius: 0.5rem; }
        .rounded-xl { border-radius: 0.75rem; }
        .rounded-full { border-radius: 9999px; }
        
        .border { border-width: 1px; }
        .border-b { border-bottom-width: 1px; }
        .border-r { border-right-width: 1px; }
        .border-t { border-top-width: 1px; }
        
        .text-sm { font-size: 0.875rem; }
        .text-xl { font-size: 1.25rem; }
        .text-2xl { font-size: 1.5rem; }
        .text-3xl { font-size: 1.875rem; }
        
        .font-bold { font-weight: 700; }
        .font-semibold { font-weight: 600; }
        .font-medium { font-weight: 500; }
        
        .text-center { text-align: center; }
        .text-left { text-align: left; }
        .text-right { text-align: right; }
        
        .hidden { display: none !important; }
        
        @media (min-width: 640px) {
            .sm\:block { display: block !important; }
            .sm\:inline { display: inline !important; }
        }
        
        @media (min-width: 768px) {
            .md\:flex { display: flex !important; }
            .md\:grid-cols-2 { grid-template-columns: repeat(2, minmax(0, 1fr)); }
            .md\:grid-cols-3 { grid-template-columns: repeat(3, minmax(0, 1fr)); }
        }
        
        @media (min-width: 1024px) {
            .lg\:hidden { display: none !important; }
            .lg\:flex { display: flex !important; }
            .lg\:w-80 { width: 20rem; }
            .lg\:flex-row { flex-direction: row; }
        }
        
        /* Дополнительные утилиты */
        .mx-auto { margin-left: auto; margin-right: auto; }
        .cursor-pointer { cursor: pointer; }
        .text-white { color: #ffffff !important; }
        .text-red-400 { color: #f87171 !important; }
        .bg-red-600\/20 { background-color: rgba(220, 38, 38, 0.2); }
        .border-red-600 { border-color: #dc2626; }
        .bg-green-600\/90 { background-color: rgba(22, 163, 74, 0.9); }
        .bg-red-600\/90 { background-color: rgba(220, 38, 38, 0.9); }
        .bg-blue-600\/90 { background-color: rgba(37, 99, 235, 0.9); }
        .border-green-400 { border-color: #4ade80; }
        .border-red-400 { border-color: #f87171; }
        .border-blue-400 { border-color: #60a5fa; }
        .shadow-lg { box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05); }
        .max-w-sm { max-width: 24rem; }
        .max-w-md { max-width: 28rem; }
        .text-white\/80 { color: rgba(255, 255, 255, 0.8); }
        .hover\:text-white:hover { color: #ffffff !important; }
        .bg-dark-bg { background-color: var(--dark-bg) !important; }
        .bg-dark-border { background-color: var(--dark-border) !important; }
        .hover\:bg-dark-border:hover { background-color: var(--dark-border) !important; }
        .hover\:bg-red-600\/30:hover { background-color: rgba(220, 38, 38, 0.3); }
        .text-gray-300 { color: var(--gray-300) !important; }
        
        /* Исправление для ссылок */
        a {
            text-decoration: none;
            color: inherit;
        }
        
        /* Исправление для кнопок */
        button {
            background: none;
            border: none;
            color: inherit;
            font: inherit;
            cursor: pointer;
        }
        
        /* Исправление для select */
        select {
            cursor: pointer;
        }
        
        .grid { display: grid; }
        .grid-cols-1 { grid-template-columns: repeat(1, minmax(0, 1fr)); }
        
        .relative { position: relative; }
        .fixed { position: fixed; }
        .sticky { position: sticky; }
        .absolute { position: absolute; }
        
        .inset-0 { top: 0; right: 0; bottom: 0; left: 0; }
        .inset-y-0 { top: 0; bottom: 0; }
        .left-0 { left: 0; }
        .right-4 { right: 1rem; }
        .top-0 { top: 0; }
        .top-20 { top: 5rem; }
        .z-30 { z-index: 30; }
        .z-40 { z-index: 40; }
        .z-50 { z-index: 50; }
        .z-1000 { z-index: 1000; }
        
        .overflow-hidden { overflow: hidden; }
        .overflow-x-hidden { overflow-x: hidden; }
        .overflow-y-auto { overflow-y: auto; }
        
        .bg-gradient-to-r { background-image: linear-gradient(to right, var(--tw-gradient-stops)); }
        .from-neon-purple { --tw-gradient-from: var(--neon-purple); }
        .to-neon-blue { --tw-gradient-to: var(--neon-blue); }
        
        .bg-gradient-to-br { background-image: linear-gradient(to bottom right, var(--tw-gradient-stops)); }
        .from-neon-purple\/20 { --tw-gradient-from: rgba(139, 92, 246, 0.2); }
        .to-neon-blue\/20 { --tw-gradient-to: rgba(6, 182, 212, 0.2); }
        .from-neon-blue\/20 { --tw-gradient-from: rgba(6, 182, 212, 0.2); }
        .to-neon-purple\/20 { --tw-gradient-to: rgba(139, 92, 246, 0.2); }
        
        .border-neon-purple\/30 { border-color: rgba(139, 92, 246, 0.3); }
        .border-neon-blue\/30 { border-color: rgba(6, 182, 212, 0.3); }
        
        .hover\:text-neon-purple:hover { color: var(--neon-purple) !important; }
        .hover\:text-red-400:hover { color: #f87171 !important; }
        
        .transition-colors { transition-property: color, background-color, border-color; transition-duration: 150ms; }
        .transition-all { transition-property: all; transition-duration: 150ms; }
        
        /* ============================================
           АНИМАЦИИ
           ============================================ */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .animate-fade-in {
            animation: fadeIn 0.5s ease-out;
        }
        
        /* ============================================
           КАРТОЧКИ
           ============================================ */
        .admin-card {
            transition: all 0.3s ease;
        }
        
        .admin-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 40px rgba(139, 92, 246, 0.2);
        }
        
        /* ============================================
           СКРОЛЛБАР
           ============================================ */
        ::-webkit-scrollbar {
            width: 8px;
            height: 8px;
        }
        
        ::-webkit-scrollbar-track {
            background: var(--dark-surface);
        }
        
        ::-webkit-scrollbar-thumb {
            background: var(--neon-purple);
            border-radius: 4px;
        }
        
        ::-webkit-scrollbar-thumb:hover {
            background: var(--neon-blue);
        }
    </style>
</head>
<body class="bg-dark-bg text-white">
    <!-- Боковое меню (для мобильных) -->
    <div class="sidebar" id="sidebar">
        <div class="p-6">
            <h2 class="text-xl font-bold text-gradient mb-6">Меню</h2>
            <nav class="space-y-4">
                <a href="index.php" class="flex items-center space-x-3 text-gray-400 hover:text-neon-purple transition-colors">
                    <i class="fas fa-home" style="width: 1.25rem;"></i>
                    <span>Главная</span>
                </a>
                <a href="edit.php" class="flex items-center space-x-3 text-gray-400 hover:text-neon-purple transition-colors">
                    <i class="fas fa-plus" style="width: 1.25rem;"></i>
                    <span>Новая статья</span>
                </a>
                <a href="../blog" target="_blank" class="flex items-center space-x-3 text-gray-400 hover:text-neon-purple transition-colors">
                    <i class="fas fa-eye" style="width: 1.25rem;"></i>
                    <span>Просмотр блога</span>
                </a>
                <a href="logout.php" class="flex items-center space-x-3 text-gray-400 hover:text-red-400 transition-colors">
                    <i class="fas fa-sign-out-alt" style="width: 1.25rem;"></i>
                    <span>Выйти</span>
                </a>
            </nav>
        </div>
    </div>
    
    <!-- Overlay для мобильного меню -->
    <div id="overlay"></div>
    
    <!-- Основная навигация -->
    <nav>
        <div class="container" style="max-width: 1280px; margin: 0 auto; padding-left: 1rem; padding-right: 1rem;">
            <div class="flex items-center justify-between" style="height: 4rem;">
                <!-- Логотип и название -->
                <div class="flex items-center space-x-4">
                    <button class="lg:hidden text-gray-400 hover:text-neon-purple transition-colors" id="menuToggle" style="background: none; border: none; cursor: pointer; padding: 0.5rem;">
                        <i class="fas fa-bars" style="font-size: 1.25rem;"></i>
                    </button>
                    <a href="index.php" class="flex items-center space-x-3" style="text-decoration: none;">
                        <div class="w-10 h-10 bg-gradient-to-r from-neon-purple to-neon-blue rounded-lg flex items-center justify-center">
                            <i class="fas fa-cog" style="color: white;"></i>
                        </div>
                        <h1 class="text-xl font-bold text-gradient hidden sm:block">Админ-панель</h1>
                    </a>
                </div>
                
                <!-- Навигация (десктоп) -->
                <div class="hidden lg:flex items-center space-x-6" style="border-left: 1px solid var(--dark-border); padding-left: 1.5rem;">
                    <a href="index.php" class="text-gray-400 hover:text-neon-purple transition-colors text-sm font-medium flex items-center space-x-2" style="text-decoration: none;">
                        <i class="fas fa-home"></i>
                        <span>Блог</span>
                    </a>
                    <a href="edit.php" class="text-gray-400 hover:text-neon-purple transition-colors text-sm font-medium flex items-center space-x-2" style="text-decoration: none;">
                        <i class="fas fa-plus"></i>
                        <span>Новая статья</span>
                    </a>
                </div>
                
                <!-- Действия -->
                <div class="flex items-center space-x-4">
                    <a href="../blog" target="_blank" class="hidden md:flex items-center space-x-2 text-gray-400 hover:text-neon-purple transition-colors text-sm" style="text-decoration: none;">
                        <i class="fas fa-external-link-alt"></i>
                        <span>Просмотр блога</span>
                    </a>
                    <a href="logout.php" class="flex items-center space-x-2 text-gray-400 hover:text-red-400 transition-colors text-sm" style="text-decoration: none;">
                        <i class="fas fa-sign-out-alt"></i>
                        <span class="hidden sm:inline">Выйти</span>
                    </a>
                </div>
            </div>
        </div>
    </nav>
    
    <!-- Контент -->
    <main class="min-h-screen" style="padding-bottom: 2rem;">
        <!-- Уведомления -->
        <div id="notifications" class="fixed top-20 right-4 z-50" style="display: flex; flex-direction: column; gap: 0.5rem;"></div>
