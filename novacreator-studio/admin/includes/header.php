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
        /* Плавные переходы для всех элементов */
        * {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        /* Кастомный скроллбар */
        ::-webkit-scrollbar {
            width: 8px;
            height: 8px;
        }
        
        ::-webkit-scrollbar-track {
            background: #1a1a24;
        }
        
        ::-webkit-scrollbar-thumb {
            background: #8B5CF6;
            border-radius: 4px;
        }
        
        ::-webkit-scrollbar-thumb:hover {
            background: #06B6D4;
        }
        
        /* Анимации появления */
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
        
        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateX(-20px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }
        
        .animate-fade-in {
            animation: fadeIn 0.5s ease-out;
        }
        
        .animate-slide-in {
            animation: slideIn 0.5s ease-out;
        }
        
        /* Улучшенные формы */
        .form-input, .form-textarea, .form-select {
            transition: all 0.3s ease;
        }
        
        .form-input:focus, .form-textarea:focus, .form-select:focus {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(139, 92, 246, 0.3);
        }
        
        /* Карточки с hover эффектом */
        .admin-card {
            transition: all 0.3s ease;
        }
        
        .admin-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 40px rgba(139, 92, 246, 0.2);
        }
        
        /* Кнопки с эффектом */
        .btn-admin {
            position: relative;
            overflow: hidden;
        }
        
        .btn-admin::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 0;
            height: 0;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.2);
            transform: translate(-50%, -50%);
            transition: width 0.6s, height 0.6s;
        }
        
        .btn-admin:hover::before {
            width: 300px;
            height: 300px;
        }
        
        /* Уведомления */
        .notification {
            animation: slideIn 0.5s ease-out;
        }
        
        .notification.hide {
            animation: slideOut 0.5s ease-out forwards;
        }
        
        @keyframes slideOut {
            to {
                opacity: 0;
                transform: translateX(100%);
            }
        }
        
        /* Таблица с hover эффектами */
        .table-row {
            transition: all 0.2s ease;
        }
        
        .table-row:hover {
            background: rgba(139, 92, 246, 0.1);
            transform: scale(1.01);
        }
        
        /* Боковое меню */
        .sidebar {
            transition: transform 0.3s ease;
        }
        
        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
            }
            
            .sidebar.open {
                transform: translateX(0);
            }
        }
        
        /* Загрузка */
        .loading {
            display: inline-block;
            width: 20px;
            height: 20px;
            border: 3px solid rgba(139, 92, 246, 0.3);
            border-radius: 50%;
            border-top-color: #8B5CF6;
            animation: spin 1s ease-in-out infinite;
        }
        
        @keyframes spin {
            to { transform: rotate(360deg); }
        }
    </style>
</head>
<body class="bg-dark-bg text-white">
    <!-- Боковое меню (для мобильных) -->
    <div class="sidebar fixed inset-y-0 left-0 z-50 w-64 bg-dark-surface border-r border-dark-border lg:hidden" id="sidebar">
        <div class="p-6">
            <h2 class="text-xl font-bold text-gradient mb-6">Меню</h2>
            <nav class="space-y-4">
                <a href="index.php" class="flex items-center space-x-3 text-gray-400 hover:text-neon-purple transition-colors">
                    <i class="fas fa-home w-5"></i>
                    <span>Главная</span>
                </a>
                <a href="edit.php" class="flex items-center space-x-3 text-gray-400 hover:text-neon-purple transition-colors">
                    <i class="fas fa-plus w-5"></i>
                    <span>Новая статья</span>
                </a>
                <a href="../blog" target="_blank" class="flex items-center space-x-3 text-gray-400 hover:text-neon-purple transition-colors">
                    <i class="fas fa-eye w-5"></i>
                    <span>Просмотр блога</span>
                </a>
                <a href="logout.php" class="flex items-center space-x-3 text-gray-400 hover:text-red-400 transition-colors">
                    <i class="fas fa-sign-out-alt w-5"></i>
                    <span>Выйти</span>
                </a>
            </nav>
        </div>
    </div>
    
    <!-- Overlay для мобильного меню -->
    <div class="fixed inset-0 bg-black/50 z-40 hidden" id="overlay"></div>
    
    <!-- Основная навигация -->
    <nav class="bg-dark-surface border-b border-dark-border sticky top-0 z-30 backdrop-blur-sm bg-opacity-95">
        <div class="container mx-auto px-4 md:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                <!-- Логотип и название -->
                <div class="flex items-center space-x-4">
                    <button class="lg:hidden text-gray-400 hover:text-neon-purple transition-colors" id="menuToggle">
                        <i class="fas fa-bars text-xl"></i>
                    </button>
                    <a href="index.php" class="flex items-center space-x-3">
                        <div class="w-10 h-10 bg-gradient-to-r from-neon-purple to-neon-blue rounded-lg flex items-center justify-center">
                            <i class="fas fa-cog text-white"></i>
                        </div>
                        <h1 class="text-xl font-bold text-gradient hidden sm:block">Админ-панель</h1>
                    </a>
                </div>
                
                <!-- Навигация (десктоп) -->
                <div class="hidden lg:flex items-center space-x-6 border-l border-dark-border pl-6">
                    <a href="index.php" class="text-gray-400 hover:text-neon-purple transition-colors text-sm font-medium flex items-center space-x-2">
                        <i class="fas fa-home"></i>
                        <span>Блог</span>
                    </a>
                    <a href="edit.php" class="text-gray-400 hover:text-neon-purple transition-colors text-sm font-medium flex items-center space-x-2">
                        <i class="fas fa-plus"></i>
                        <span>Новая статья</span>
                    </a>
                </div>
                
                <!-- Действия -->
                <div class="flex items-center space-x-4">
                    <a href="../blog" target="_blank" class="hidden md:flex items-center space-x-2 text-gray-400 hover:text-neon-purple transition-colors text-sm">
                        <i class="fas fa-external-link-alt"></i>
                        <span>Просмотр блога</span>
                    </a>
                    <a href="logout.php" class="flex items-center space-x-2 text-gray-400 hover:text-red-400 transition-colors text-sm">
                        <i class="fas fa-sign-out-alt"></i>
                        <span class="hidden sm:inline">Выйти</span>
                    </a>
                </div>
            </div>
        </div>
    </nav>
    
    <!-- Контент -->
    <main class="min-h-screen pb-8">
        <!-- Уведомления -->
        <div id="notifications" class="fixed top-20 right-4 z-50 space-y-2"></div>

