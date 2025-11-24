/**
 * Виджет онлайн-чата
 */
(function() {
    'use strict';
    
    // Создаем HTML структуру виджета
    const chatHTML = `
        <div id="chatWidget" class="fixed bottom-6 right-6 z-50" style="display: none;">
            <!-- Кнопка открытия чата -->
            <button id="chatToggle" class="w-16 h-16 bg-gradient-to-r from-neon-purple to-neon-blue rounded-full shadow-lg hover:scale-110 transition-all duration-300 flex items-center justify-center group">
                <svg id="chatIcon" class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                </svg>
                <svg id="chatCloseIcon" class="w-8 h-8 text-white hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
            
            <!-- Окно чата -->
            <div id="chatWindow" class="hidden fixed bottom-24 right-6 w-96 h-[600px] bg-dark-surface border border-dark-border rounded-xl shadow-2xl flex flex-col overflow-hidden">
                <!-- Заголовок -->
                <div class="bg-gradient-to-r from-neon-purple to-neon-blue p-4 flex items-center justify-between">
                    <div>
                        <h3 class="text-white font-bold text-lg">Онлайн чат</h3>
                        <p class="text-white/80 text-sm">Мы ответим в течение нескольких минут</p>
                    </div>
                    <button id="chatMinimize" class="text-white hover:text-gray-200 transition-colors">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"></path>
                        </svg>
                    </button>
                </div>
                
                <!-- Область сообщений -->
                <div id="chatMessages" class="flex-1 overflow-y-auto p-4 space-y-4 bg-dark-bg">
                    <div class="text-center text-gray-400 text-sm py-8">
                        <p>Добро пожаловать! Задайте свой вопрос, и мы ответим вам.</p>
                    </div>
                </div>
                
                <!-- Форма ввода -->
                <div id="chatForm" class="p-4 border-t border-dark-border bg-dark-surface">
                    <form id="chatMessageForm" class="space-y-3">
                        <input type="text" id="chatName" placeholder="Ваше имя" required class="w-full px-4 py-2 bg-dark-bg border border-dark-border rounded-lg text-white placeholder-gray-500 focus:border-neon-purple focus:outline-none transition-colors">
                        <input type="email" id="chatEmail" placeholder="Email" required class="w-full px-4 py-2 bg-dark-bg border border-dark-border rounded-lg text-white placeholder-gray-500 focus:border-neon-purple focus:outline-none transition-colors">
                        <div class="flex space-x-2">
                            <input type="text" id="chatMessageInput" placeholder="Напишите сообщение..." required class="flex-1 px-4 py-2 bg-dark-bg border border-dark-border rounded-lg text-white placeholder-gray-500 focus:border-neon-purple focus:outline-none transition-colors">
                            <button type="submit" class="px-4 py-2 bg-gradient-to-r from-neon-purple to-neon-blue rounded-lg text-white hover:opacity-90 transition-opacity">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                                </svg>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    `;
    
    // Вставляем HTML в body
    document.body.insertAdjacentHTML('beforeend', chatHTML);
    
    const chatWidget = document.getElementById('chatWidget');
    const chatToggle = document.getElementById('chatToggle');
    const chatWindow = document.getElementById('chatWindow');
    const chatMinimize = document.getElementById('chatMinimize');
    const chatIcon = document.getElementById('chatIcon');
    const chatCloseIcon = document.getElementById('chatCloseIcon');
    const chatMessages = document.getElementById('chatMessages');
    const chatForm = document.getElementById('chatForm');
    const chatMessageForm = document.getElementById('chatMessageForm');
    const chatName = document.getElementById('chatName');
    const chatEmail = document.getElementById('chatEmail');
    const chatMessageInput = document.getElementById('chatMessageInput');
    
    let chatId = null;
    let isOpen = false;
    
    // Показываем виджет
    chatWidget.style.display = 'block';
    
    // Открытие/закрытие чата
    chatToggle.addEventListener('click', function() {
        if (isOpen) {
            chatWindow.classList.add('hidden');
            chatIcon.classList.remove('hidden');
            chatCloseIcon.classList.add('hidden');
            isOpen = false;
        } else {
            chatWindow.classList.remove('hidden');
            chatIcon.classList.add('hidden');
            chatCloseIcon.classList.remove('hidden');
            isOpen = true;
        }
    });
    
    chatMinimize.addEventListener('click', function() {
        chatWindow.classList.add('hidden');
        chatIcon.classList.remove('hidden');
        chatCloseIcon.classList.add('hidden');
        isOpen = false;
    });
    
    // Добавление сообщения в чат
    function addMessage(from, message, timestamp) {
        const messageDiv = document.createElement('div');
        messageDiv.className = `flex ${from === 'user' ? 'justify-end' : 'justify-start'}`;
        
        const messageBubble = document.createElement('div');
        messageBubble.className = `max-w-[80%] rounded-lg px-4 py-2 ${
            from === 'user' 
                ? 'bg-gradient-to-r from-neon-purple to-neon-blue text-white' 
                : 'bg-dark-surface border border-dark-border text-gray-300'
        }`;
        
        messageBubble.innerHTML = `
            <p class="text-sm">${escapeHtml(message)}</p>
            <p class="text-xs mt-1 opacity-70">${formatTime(timestamp)}</p>
        `;
        
        messageDiv.appendChild(messageBubble);
        chatMessages.appendChild(messageDiv);
        chatMessages.scrollTop = chatMessages.scrollHeight;
    }
    
    // Отправка сообщения
    chatMessageForm.addEventListener('submit', function(e) {
        e.preventDefault();
        
        const name = chatName.value.trim();
        const email = chatEmail.value.trim();
        const message = chatMessageInput.value.trim();
        
        if (!name || !email || !message) {
            return;
        }
        
        // Показываем сообщение пользователя сразу
        addMessage('user', message, new Date().toISOString());
        chatMessageInput.value = '';
        
        // Отправляем на сервер
        const formData = new FormData();
        formData.append('action', 'send_message');
        formData.append('name', name);
        formData.append('email', email);
        formData.append('message', message);
        
        fetch('/backend/chat_api.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                chatId = data.chat_id;
                // Сохраняем данные в localStorage
                localStorage.setItem('chatName', name);
                localStorage.setItem('chatEmail', email);
                localStorage.setItem('chatId', chatId);
            } else {
                console.error('Ошибка отправки:', data.error);
            }
        })
        .catch(error => {
            console.error('Ошибка:', error);
        });
    });
    
    // Загружаем сохраненные данные
    if (localStorage.getItem('chatName')) {
        chatName.value = localStorage.getItem('chatName');
    }
    if (localStorage.getItem('chatEmail')) {
        chatEmail.value = localStorage.getItem('chatEmail');
    }
    if (localStorage.getItem('chatId')) {
        chatId = localStorage.getItem('chatId');
    }
    
    // Вспомогательные функции
    function escapeHtml(text) {
        const div = document.createElement('div');
        div.textContent = text;
        return div.innerHTML;
    }
    
    function formatTime(timestamp) {
        const date = new Date(timestamp);
        const now = new Date();
        const diff = now - date;
        
        if (diff < 60000) {
            return 'только что';
        } else if (diff < 3600000) {
            return Math.floor(diff / 60000) + ' мин назад';
        } else {
            return date.toLocaleTimeString('ru-RU', { hour: '2-digit', minute: '2-digit' });
        }
    }
})();

