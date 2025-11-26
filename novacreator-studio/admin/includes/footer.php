    </main>
    
    <script>
        // Мобильное меню
        const menuToggle = document.getElementById('menuToggle');
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('overlay');
        
        if (menuToggle) {
            menuToggle.addEventListener('click', () => {
                sidebar.classList.toggle('open');
                overlay.classList.toggle('hidden');
            });
        }
        
        if (overlay) {
            overlay.addEventListener('click', () => {
                sidebar.classList.remove('open');
                overlay.classList.add('hidden');
            });
        }
        
        // Функция показа уведомлений
        function showNotification(message, type = 'success') {
            const notifications = document.getElementById('notifications');
            if (!notifications) return;
            
            const notification = document.createElement('div');
            const bgColor = type === 'success' ? 'bg-green-600/90' : type === 'error' ? 'bg-red-600/90' : 'bg-blue-600/90';
            const icon = type === 'success' ? 'fa-check-circle' : type === 'error' ? 'fa-exclamation-circle' : 'fa-info-circle';
            
            notification.className = `notification ${bgColor} border border-${type === 'success' ? 'green' : type === 'error' ? 'red' : 'blue'}-400 rounded-lg p-4 text-white shadow-lg max-w-sm flex items-center space-x-3`;
            notification.innerHTML = `
                <i class="fas ${icon} text-xl"></i>
                <span class="flex-1">${message}</span>
                <button onclick="this.parentElement.remove()" class="text-white/80 hover:text-white">
                    <i class="fas fa-times"></i>
                </button>
            `;
            
            notifications.appendChild(notification);
            
            // Автоматическое удаление через 5 секунд
            setTimeout(() => {
                notification.classList.add('hide');
                setTimeout(() => notification.remove(), 500);
            }, 5000);
        }
        
        // Показываем уведомления из URL параметров
        const urlParams = new URLSearchParams(window.location.search);
        const message = urlParams.get('message');
        const error = urlParams.get('error');
        
        if (message) {
            const messages = {
                'saved': { text: 'Статья успешно сохранена!', type: 'success' },
                'deleted': { text: 'Статья успешно удалена!', type: 'success' },
                'created': { text: 'Новая статья создана!', type: 'success' }
            };
            
            if (messages[message]) {
                showNotification(messages[message].text, messages[message].type);
                // Очищаем URL от параметров
                const newUrl = window.location.pathname + (error ? '?error=' + encodeURIComponent(error) : '');
                window.history.replaceState({}, document.title, newUrl);
            }
        }
        
        if (error && !message) {
            showNotification(decodeURIComponent(error), 'error');
            // Очищаем URL от параметров
            window.history.replaceState({}, document.title, window.location.pathname);
        }
        
        // Подтверждение удаления с улучшенным дизайном
        function confirmDelete(message = 'Вы уверены, что хотите удалить этот элемент?') {
            return new Promise((resolve) => {
                const modal = document.createElement('div');
                modal.className = 'fixed inset-0 z-50 flex items-center justify-center p-4';
                modal.innerHTML = `
                    <div class="bg-dark-surface border border-dark-border rounded-xl p-6 max-w-md w-full animate-fade-in">
                        <h3 class="text-xl font-bold mb-4 text-gradient">Подтверждение</h3>
                        <p class="text-gray-300 mb-6">${message}</p>
                        <div class="flex space-x-4">
                            <button class="flex-1 px-4 py-2 bg-red-600/20 text-red-400 rounded-lg hover:bg-red-600/30 transition-colors" id="confirmYes">
                                Да, удалить
                            </button>
                            <button class="flex-1 px-4 py-2 bg-dark-bg text-gray-300 rounded-lg hover:bg-dark-border transition-colors" id="confirmNo">
                                Отмена
                            </button>
                        </div>
                    </div>
                `;
                
                document.body.appendChild(modal);
                
                modal.querySelector('#confirmYes').addEventListener('click', () => {
                    document.body.removeChild(modal);
                    resolve(true);
                });
                
                modal.querySelector('#confirmNo').addEventListener('click', () => {
                    document.body.removeChild(modal);
                    resolve(false);
                });
                
                modal.addEventListener('click', (e) => {
                    if (e.target === modal) {
                        document.body.removeChild(modal);
                        resolve(false);
                    }
                });
            });
        }
        
        // Плавная прокрутка
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });
    </script>
</body>
</html>

