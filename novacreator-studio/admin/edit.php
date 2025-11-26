<?php
/**
 * Страница редактирования/создания статьи
 * Современный редактор с предпросмотром
 */
require_once 'config.php';
checkAuth();

$articles = loadArticles();
$article = null;
$isEdit = false;
$error = isset($_GET['error']) ? $_GET['error'] : '';

// Если передан ID, загружаем статью для редактирования
if (isset($_GET['id'])) {
    $id = (int)$_GET['id'];
    foreach ($articles as $item) {
        if ($item['id'] === $id) {
            $article = $item;
            $isEdit = true;
            break;
        }
    }
}

// Если статья не найдена, создаем новую
if (!$article) {
    $article = [
        'id' => !empty($articles) ? max(array_column($articles, 'id')) + 1 : 1,
        'title' => '',
        'slug' => '',
        'category' => 'SEO',
        'date' => date('Y-m-d'),
        'excerpt' => '',
        'content' => '',
        'image' => '',
        'author' => 'NovaCreator Studio',
        'views' => 0
    ];
}

$pageTitle = $isEdit ? 'Редактирование статьи' : 'Новая статья';
include 'includes/header.php';
?>

<div class="container mx-auto px-4 md:px-6 lg:px-8 py-8">
    <div class="flex flex-col lg:flex-row gap-6">
        <!-- Форма редактирования -->
        <div class="flex-1">
            <div class="bg-dark-surface border border-dark-border rounded-xl p-6 md:p-8 animate-fade-in">
                <!-- Заголовок -->
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-2xl font-bold text-gradient">
                        <?php echo $isEdit ? 'Редактирование статьи' : 'Новая статья'; ?>
                    </h2>
                    <a href="index.php" class="text-gray-400 hover:text-neon-purple transition-colors">
                        <i class="fas fa-times text-xl"></i>
                    </a>
                </div>

                <?php if ($error): ?>
                    <div class="bg-red-600/20 border border-red-600 rounded-lg p-4 mb-6 text-red-400 flex items-center space-x-2 animate-fade-in">
                        <i class="fas fa-exclamation-circle"></i>
                        <span><?php echo htmlspecialchars($error); ?></span>
                    </div>
                <?php endif; ?>

                <form method="POST" action="save.php" id="articleForm" class="space-y-6">
                    <input type="hidden" name="id" value="<?php echo $article['id']; ?>">
                    <input type="hidden" name="is_edit" value="<?php echo $isEdit ? '1' : '0'; ?>">
                    
                    <!-- Заголовок -->
                    <div>
                        <label class="block text-sm font-semibold mb-2 text-gray-300">
                            Заголовок статьи <span class="text-red-400">*</span>
                        </label>
                        <input type="text" 
                               name="title" 
                               id="title"
                               value="<?php echo htmlspecialchars($article['title']); ?>" 
                               required 
                               class="form-input w-full px-4 py-3 bg-dark-bg border border-dark-border rounded-lg text-white focus:outline-none focus:border-neon-purple focus:ring-2 focus:ring-neon-purple/20"
                               placeholder="Введите заголовок статьи">
                        <p class="text-xs text-gray-500 mt-1">
                            <i class="fas fa-info-circle"></i> Slug будет сгенерирован автоматически из заголовка
                        </p>
                    </div>

                    <!-- Категория и дата в одной строке -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-semibold mb-2 text-gray-300">
                                Категория <span class="text-red-400">*</span>
                            </label>
                            <select name="category" required class="form-select w-full px-4 py-3 bg-dark-bg border border-dark-border rounded-lg text-white focus:outline-none focus:border-neon-purple focus:ring-2 focus:ring-neon-purple/20">
                                <option value="SEO" <?php echo $article['category'] === 'SEO' ? 'selected' : ''; ?>>SEO</option>
                                <option value="Google Ads" <?php echo $article['category'] === 'Google Ads' ? 'selected' : ''; ?>>Google Ads</option>
                                <option value="Разработка" <?php echo $article['category'] === 'Разработка' ? 'selected' : ''; ?>>Разработка</option>
                                <option value="Маркетинг" <?php echo $article['category'] === 'Маркетинг' ? 'selected' : ''; ?>>Маркетинг</option>
                                <option value="Кейсы" <?php echo $article['category'] === 'Кейсы' ? 'selected' : ''; ?>>Кейсы</option>
                                <option value="Аналитика" <?php echo $article['category'] === 'Аналитика' ? 'selected' : ''; ?>>Аналитика</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-semibold mb-2 text-gray-300">
                                Дата публикации <span class="text-red-400">*</span>
                            </label>
                            <input type="date" 
                                   name="date" 
                                   value="<?php echo htmlspecialchars($article['date']); ?>" 
                                   required 
                                   class="form-input w-full px-4 py-3 bg-dark-bg border border-dark-border rounded-lg text-white focus:outline-none focus:border-neon-purple focus:ring-2 focus:ring-neon-purple/20">
                        </div>
                    </div>

                    <!-- Краткое описание -->
                    <div>
                        <label class="block text-sm font-semibold mb-2 text-gray-300">
                            Краткое описание (excerpt) <span class="text-red-400">*</span>
                        </label>
                        <textarea name="excerpt" 
                                  required 
                                  rows="3" 
                                  class="form-textarea w-full px-4 py-3 bg-dark-bg border border-dark-border rounded-lg text-white focus:outline-none focus:border-neon-purple focus:ring-2 focus:ring-neon-purple/20"
                                  placeholder="Краткое описание статьи, которое будет отображаться в списке статей"><?php echo htmlspecialchars($article['excerpt']); ?></textarea>
                    </div>

                    <!-- Полный контент -->
                    <div>
                        <label class="block text-sm font-semibold mb-2 text-gray-300">
                            Полный текст статьи <span class="text-red-400">*</span>
                        </label>
                        <div class="mb-2 flex items-center space-x-4 text-xs text-gray-500">
                            <span><i class="fas fa-info-circle"></i> Используйте HTML теги для форматирования</span>
                            <button type="button" onclick="togglePreview()" class="text-neon-purple hover:text-neon-blue transition-colors">
                                <i class="fas fa-eye"></i> Предпросмотр
                            </button>
                        </div>
                        <textarea name="content" 
                                  id="content" 
                                  required 
                                  rows="20" 
                                  class="form-textarea w-full px-4 py-3 bg-dark-bg border border-dark-border rounded-lg text-white focus:outline-none focus:border-neon-purple focus:ring-2 focus:ring-neon-purple/20 font-mono text-sm"
                                  placeholder="Введите HTML контент статьи..."><?php echo htmlspecialchars($article['content']); ?></textarea>
                        <div id="preview" class="hidden mt-4 p-6 bg-dark-bg border border-dark-border rounded-lg prose prose-invert max-w-none">
                            <!-- Предпросмотр будет здесь -->
                        </div>
                    </div>

                    <!-- Изображение и автор -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-semibold mb-2 text-gray-300">URL изображения</label>
                            <input type="text" 
                                   name="image" 
                                   value="<?php echo htmlspecialchars($article['image']); ?>" 
                                   class="form-input w-full px-4 py-3 bg-dark-bg border border-dark-border rounded-lg text-white focus:outline-none focus:border-neon-purple focus:ring-2 focus:ring-neon-purple/20"
                                   placeholder="/assets/img/blog/article.jpg">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold mb-2 text-gray-300">Автор</label>
                            <input type="text" 
                                   name="author" 
                                   value="<?php echo htmlspecialchars($article['author']); ?>" 
                                   class="form-input w-full px-4 py-3 bg-dark-bg border border-dark-border rounded-lg text-white focus:outline-none focus:border-neon-purple focus:ring-2 focus:ring-neon-purple/20"
                                   placeholder="NovaCreator Studio">
                        </div>
                    </div>

                    <!-- Кнопки -->
                    <div class="flex items-center justify-between pt-6 border-t border-dark-border">
                        <a href="index.php" class="text-gray-400 hover:text-neon-purple transition-colors flex items-center space-x-2">
                            <i class="fas fa-arrow-left"></i>
                            <span>Отмена</span>
                        </a>
                        <div class="flex space-x-4">
                            <button type="button" onclick="saveDraft()" class="px-6 py-2 bg-dark-bg border border-dark-border rounded-lg hover:bg-dark-border transition-colors">
                                Сохранить черновик
                            </button>
                            <button type="submit" class="btn-neon btn-admin px-6 py-2 flex items-center space-x-2">
                                <i class="fas fa-save"></i>
                                <span><?php echo $isEdit ? 'Сохранить изменения' : 'Создать статью'; ?></span>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Боковая панель с подсказками -->
        <div class="lg:w-80 space-y-6">
            <!-- Подсказки -->
            <div class="bg-dark-surface border border-dark-border rounded-xl p-6 animate-fade-in">
                <h3 class="text-lg font-bold mb-4 text-gradient flex items-center space-x-2">
                    <i class="fas fa-lightbulb"></i>
                    <span>Подсказки</span>
                </h3>
                <ul class="space-y-3 text-sm text-gray-400">
                    <li class="flex items-start space-x-2">
                        <i class="fas fa-check-circle text-neon-purple mt-1"></i>
                        <span>Используйте заголовки h2, h3 для структуры</span>
                    </li>
                    <li class="flex items-start space-x-2">
                        <i class="fas fa-check-circle text-neon-purple mt-1"></i>
                        <span>Добавляйте списки для читаемости</span>
                    </li>
                    <li class="flex items-start space-x-2">
                        <i class="fas fa-check-circle text-neon-purple mt-1"></i>
                        <span>Используйте теги strong и em для выделения</span>
                    </li>
                    <li class="flex items-start space-x-2">
                        <i class="fas fa-check-circle text-neon-purple mt-1"></i>
                        <span>Добавляйте ссылки на релевантные страницы</span>
                    </li>
                </ul>
            </div>

            <!-- Быстрые действия -->
            <div class="bg-dark-surface border border-dark-border rounded-xl p-6 animate-fade-in" style="animation-delay: 0.1s;">
                <h3 class="text-lg font-bold mb-4 text-gradient flex items-center space-x-2">
                    <i class="fas fa-bolt"></i>
                    <span>Быстрые действия</span>
                </h3>
                <div class="space-y-2">
                    <button onclick="insertTag('h2')" class="w-full text-left px-4 py-2 bg-dark-bg rounded-lg hover:bg-dark-border transition-colors text-sm">
                        <i class="fas fa-heading mr-2"></i>Вставить заголовок H2
                    </button>
                    <button onclick="insertTag('h3')" class="w-full text-left px-4 py-2 bg-dark-bg rounded-lg hover:bg-dark-border transition-colors text-sm">
                        <i class="fas fa-heading mr-2"></i>Вставить заголовок H3
                    </button>
                    <button onclick="insertTag('p')" class="w-full text-left px-4 py-2 bg-dark-bg rounded-lg hover:bg-dark-border transition-colors text-sm">
                        <i class="fas fa-paragraph mr-2"></i>Вставить параграф
                    </button>
                    <button onclick="insertTag('ul')" class="w-full text-left px-4 py-2 bg-dark-bg rounded-lg hover:bg-dark-border transition-colors text-sm">
                        <i class="fas fa-list-ul mr-2"></i>Вставить список
                    </button>
                </div>
            </div>

            <!-- Статистика (если редактирование) -->
            <?php if ($isEdit): ?>
                <div class="bg-dark-surface border border-dark-border rounded-xl p-6 animate-fade-in" style="animation-delay: 0.2s;">
                    <h3 class="text-lg font-bold mb-4 text-gradient flex items-center space-x-2">
                        <i class="fas fa-chart-bar"></i>
                        <span>Статистика</span>
                    </h3>
                    <div class="space-y-3">
                        <div class="flex justify-between">
                            <span class="text-gray-400">Просмотры:</span>
                            <span class="font-semibold text-neon-purple"><?php echo $article['views'] ?? 0; ?></span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-400">Дата создания:</span>
                            <span class="font-semibold"><?php echo htmlspecialchars($article['date']); ?></span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-400">Slug:</span>
                            <span class="font-mono text-xs text-gray-500 break-all"><?php echo htmlspecialchars($article['slug']); ?></span>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<script>
// Предпросмотр контента
function togglePreview() {
    const content = document.getElementById('content').value;
    const preview = document.getElementById('preview');
    const button = event.target.closest('button');
    
    if (preview.classList.contains('hidden')) {
        preview.innerHTML = content;
        preview.classList.remove('hidden');
        button.innerHTML = '<i class="fas fa-code"></i> Редактор';
    } else {
        preview.classList.add('hidden');
        button.innerHTML = '<i class="fas fa-eye"></i> Предпросмотр';
    }
}

// Вставка HTML тегов
function insertTag(tag) {
    const textarea = document.getElementById('content');
    const start = textarea.selectionStart;
    const end = textarea.selectionEnd;
    const text = textarea.value;
    const selectedText = text.substring(start, end);
    
    let insertText = '';
    switch(tag) {
        case 'h2':
            insertText = selectedText ? `<h2>${selectedText}</h2>` : '<h2>Заголовок</h2>\n\n';
            break;
        case 'h3':
            insertText = selectedText ? `<h3>${selectedText}</h3>` : '<h3>Подзаголовок</h3>\n\n';
            break;
        case 'p':
            insertText = selectedText ? `<p>${selectedText}</p>` : '<p>Текст параграфа</p>\n\n';
            break;
        case 'ul':
            insertText = selectedText ? `<ul>\n<li>${selectedText}</li>\n</ul>` : '<ul>\n<li>Элемент списка</li>\n<li>Элемент списка</li>\n</ul>\n\n';
            break;
    }
    
    textarea.value = text.substring(0, start) + insertText + text.substring(end);
    textarea.focus();
    textarea.setSelectionRange(start + insertText.length, start + insertText.length);
    
    showNotification('Тег вставлен', 'success');
}

// Сохранение черновика (в localStorage)
function saveDraft() {
    const form = document.getElementById('articleForm');
    const formData = new FormData(form);
    const draft = {
        title: formData.get('title'),
        category: formData.get('category'),
        date: formData.get('date'),
        excerpt: formData.get('excerpt'),
        content: formData.get('content'),
        image: formData.get('image'),
        author: formData.get('author')
    };
    
    localStorage.setItem('article_draft', JSON.stringify(draft));
    showNotification('Черновик сохранен локально', 'success');
}

// Загрузка черновика при загрузке страницы
window.addEventListener('DOMContentLoaded', function() {
    const draft = localStorage.getItem('article_draft');
    if (draft && !<?php echo $isEdit ? 'true' : 'false'; ?>) {
        try {
            const data = JSON.parse(draft);
            if (confirm('Найден сохраненный черновик. Загрузить?')) {
                document.getElementById('title').value = data.title || '';
                document.querySelector('[name="category"]').value = data.category || 'SEO';
                document.querySelector('[name="date"]').value = data.date || '';
                document.querySelector('[name="excerpt"]').value = data.excerpt || '';
                document.getElementById('content').value = data.content || '';
                document.querySelector('[name="image"]').value = data.image || '';
                document.querySelector('[name="author"]').value = data.author || '';
                showNotification('Черновик загружен', 'success');
            }
        } catch(e) {
            console.error('Ошибка загрузки черновика:', e);
        }
    }
});

// Очистка черновика после успешной отправки
document.getElementById('articleForm').addEventListener('submit', function() {
    localStorage.removeItem('article_draft');
});
</script>

<?php include 'includes/footer.php'; ?>
