<?php
/**
 * Админ-панель управления чатами
 */
require_once 'config.php';
checkAuth();
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Управление чатами - Админ-панель</title>
    <link href="../assets/css/output.css" rel="stylesheet">
    <style>
        .chat-message-user {
            background: linear-gradient(135deg, #8B5CF6 0%, #06B6D4 100%);
            color: white;
            padding: 0.75rem 1rem;
            border-radius: 1rem;
            margin-bottom: 0.5rem;
            max-width: 80%;
            margin-left: auto;
        }
        .chat-message-admin {
            background: #111118;
            border: 1px solid #1F1F2E;
            color: #E5E7EB;
            padding: 0.75rem 1rem;
            border-radius: 1rem;
            margin-bottom: 0.5rem;
            max-width: 80%;
        }
    </style>
</head>
<body class="bg-dark-bg text-white">
    <div class="min-h-screen">
        <!-- Навигация -->
        <nav class="bg-dark-surface border-b border-dark-border">
            <div class="container mx-auto px-4 md:px-6 lg:px-8">
                <div class="flex items-center justify-between h-16">
                    <h1 class="text-xl font-bold text-gradient">Управление чатами</h1>
                    <div class="flex items-center space-x-4">
                        <a href="index.php" class="text-gray-400 hover:text-neon-purple transition-colors text-sm">
                            Блог
                        </a>
                        <a href="chats.php" class="text-neon-purple font-semibold text-sm">
                            Чаты
                        </a>
                        <a href="projects.php" class="text-gray-400 hover:text-neon-purple transition-colors text-sm">
                            Проекты
                        </a>
                        <a href="../blog" target="_blank" class="text-gray-400 hover:text-neon-purple transition-colors text-sm">
                            Просмотр блога
                        </a>
                        <a href="logout.php" class="text-gray-400 hover:text-red-400 transition-colors text-sm">
                            Выйти
                        </a>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Контент -->
        <div class="container mx-auto px-4 md:px-6 lg:px-8 py-8">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Список чатов -->
                <div class="lg:col-span-1">
                    <div class="bg-dark-surface border border-dark-border rounded-xl p-6">
                        <h2 class="text-2xl font-bold mb-4 text-gradient">Активные чаты</h2>
                        <div id="chatsList" class="space-y-3">
                            <div class="text-center text-gray-400 py-8">
                                <p>Загрузка чатов...</p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Окно чата -->
                <div class="lg:col-span-2">
                    <div id="chatContainer" class="bg-dark-surface border border-dark-border rounded-xl p-6 hidden">
                        <div class="flex items-center justify-between mb-6">
                            <div>
                                <h3 id="chatUserName" class="text-xl font-bold text-gradient"></h3>
                                <p id="chatUserEmail" class="text-sm text-gray-400"></p>
                            </div>
                            <div class="flex items-center space-x-2">
                                <select id="chatStatus" class="px-4 py-2 bg-dark-bg border border-dark-border rounded-lg text-white">
                                    <option value="active">Активный</option>
                                    <option value="closed">Закрыт</option>
                                    <option value="archived">Архив</option>
                                </select>
                                <button id="refreshChat" class="px-4 py-2 bg-neon-purple/20 text-neon-purple rounded-lg hover:bg-neon-purple/30 transition-colors">
                                    Обновить
                                </button>
                            </div>
                        </div>
                        
                        <!-- Сообщения -->
                        <div id="chatMessages" class="bg-dark-bg rounded-lg p-4 mb-4 h-96 overflow-y-auto border border-dark-border">
                            <div class="text-center text-gray-400 py-8">
                                <p>Выберите чат для просмотра сообщений</p>
                            </div>
                        </div>
                        
                        <!-- Форма ответа -->
                        <form id="replyForm" class="flex space-x-2">
                            <input type="text" id="replyMessage" placeholder="Введите ответ..." required class="flex-1 px-4 py-2 bg-dark-bg border border-dark-border rounded-lg text-white placeholder-gray-500 focus:border-neon-purple focus:outline-none transition-colors">
                            <button type="submit" class="px-6 py-2 bg-gradient-to-r from-neon-purple to-neon-blue rounded-lg text-white hover:opacity-90 transition-opacity">
                                Отправить
                            </button>
                        </form>
                    </div>
                    
                    <div id="noChatSelected" class="bg-dark-surface border border-dark-border rounded-xl p-12 text-center">
                        <svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                        </svg>
                        <p class="text-xl text-gray-400">Выберите чат из списка</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script>
        let currentChatId = null;
        let refreshInterval = null;
        
        // Загрузка списка чатов
        function loadChats() {
            fetch('/backend/chat_api.php?action=get_chats')
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        displayChats(data.chats);
                    }
                })
                .catch(error => {
                    console.error('Ошибка загрузки чатов:', error);
                });
        }
        
        // Отображение списка чатов
        function displayChats(chats) {
            const chatsList = document.getElementById('chatsList');
            
            if (chats.length === 0) {
                chatsList.innerHTML = '<div class="text-center text-gray-400 py-8"><p>Нет активных чатов</p></div>';
                return;
            }
            
            chatsList.innerHTML = chats.map(chat => {
                const statusColors = {
                    'active': 'bg-green-600/20 text-green-400 border-green-600/30',
                    'closed': 'bg-gray-600/20 text-gray-400 border-gray-600/30',
                    'archived': 'bg-yellow-600/20 text-yellow-400 border-yellow-600/30'
                };
                
                const statusLabels = {
                    'active': 'Активный',
                    'closed': 'Закрыт',
                    'archived': 'Архив'
                };
                
                const lastMessage = chat.messages && chat.messages.length > 0 
                    ? chat.messages[chat.messages.length - 1].message.substring(0, 50) + '...'
                    : 'Нет сообщений';
                
                return `
                    <div class="chat-item p-4 bg-dark-bg border border-dark-border rounded-lg cursor-pointer hover:border-neon-purple transition-colors" data-chat-id="${chat.id}">
                        <div class="flex items-center justify-between mb-2">
                            <h4 class="font-semibold text-white">${escapeHtml(chat.name)}</h4>
                            <span class="px-2 py-1 text-xs rounded ${statusColors[chat.status]} border">
                                ${statusLabels[chat.status]}
                            </span>
                        </div>
                        <p class="text-sm text-gray-400 mb-1">${escapeHtml(chat.email)}</p>
                        <p class="text-xs text-gray-500">${lastMessage}</p>
                        <p class="text-xs text-gray-600 mt-2">${formatDate(chat.updated_at)}</p>
                    </div>
                `;
            }).join('');
            
            // Добавляем обработчики кликов
            document.querySelectorAll('.chat-item').forEach(item => {
                item.addEventListener('click', function() {
                    const chatId = this.getAttribute('data-chat-id');
                    loadChat(chatId);
                });
            });
        }
        
        // Загрузка конкретного чата
        function loadChat(chatId) {
            currentChatId = chatId;
            
            fetch(`/backend/chat_api.php?action=get_chat&chat_id=${chatId}`)
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        displayChat(data.chat);
                        document.getElementById('chatContainer').classList.remove('hidden');
                        document.getElementById('noChatSelected').classList.add('hidden');
                        
                        // Начинаем автообновление
                        if (refreshInterval) {
                            clearInterval(refreshInterval);
                        }
                        refreshInterval = setInterval(() => {
                            loadChat(chatId);
                            loadChats();
                        }, 5000);
                    }
                })
                .catch(error => {
                    console.error('Ошибка загрузки чата:', error);
                });
        }
        
        // Отображение чата
        function displayChat(chat) {
            document.getElementById('chatUserName').textContent = chat.name;
            document.getElementById('chatUserEmail').textContent = chat.email;
            document.getElementById('chatStatus').value = chat.status;
            
            const messagesContainer = document.getElementById('chatMessages');
            
            if (!chat.messages || chat.messages.length === 0) {
                messagesContainer.innerHTML = '<div class="text-center text-gray-400 py-8"><p>Нет сообщений</p></div>';
                return;
            }
            
            messagesContainer.innerHTML = chat.messages.map(msg => {
                const isUser = msg.from === 'user';
                return `
                    <div class="flex ${isUser ? 'justify-end' : 'justify-start'} mb-4">
                        <div class="${isUser ? 'chat-message-user' : 'chat-message-admin'}">
                            <p>${escapeHtml(msg.message)}</p>
                            <p class="text-xs mt-1 opacity-70">${formatDate(msg.timestamp)}</p>
                        </div>
                    </div>
                `;
            }).join('');
            
            messagesContainer.scrollTop = messagesContainer.scrollHeight;
        }
        
        // Отправка ответа
        document.getElementById('replyForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            if (!currentChatId) return;
            
            const message = document.getElementById('replyMessage').value.trim();
            if (!message) return;
            
            const formData = new FormData();
            formData.append('action', 'admin_send');
            formData.append('chat_id', currentChatId);
            formData.append('message', message);
            
            fetch('/backend/chat_api.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    document.getElementById('replyMessage').value = '';
                    loadChat(currentChatId);
                    loadChats();
                }
            })
            .catch(error => {
                console.error('Ошибка отправки:', error);
            });
        });
        
        // Изменение статуса
        document.getElementById('chatStatus').addEventListener('change', function() {
            if (!currentChatId) return;
            
            const formData = new FormData();
            formData.append('action', 'update_status');
            formData.append('chat_id', currentChatId);
            formData.append('status', this.value);
            
            fetch('/backend/chat_api.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    loadChats();
                }
            })
            .catch(error => {
                console.error('Ошибка обновления статуса:', error);
            });
        });
        
        // Обновление чата
        document.getElementById('refreshChat').addEventListener('click', function() {
            if (currentChatId) {
                loadChat(currentChatId);
                loadChats();
            }
        });
        
        // Вспомогательные функции
        function escapeHtml(text) {
            const div = document.createElement('div');
            div.textContent = text;
            return div.innerHTML;
        }
        
        function formatDate(dateString) {
            const date = new Date(dateString);
            return date.toLocaleString('ru-RU', {
                day: '2-digit',
                month: '2-digit',
                year: 'numeric',
                hour: '2-digit',
                minute: '2-digit'
            });
        }
        
        // Загружаем чаты при загрузке страницы
        loadChats();
        setInterval(loadChats, 10000); // Обновляем список каждые 10 секунд
    </script>
</body>
</html>

