<?php
/**
 * Страница редактирования/создания статьи
 */
require_once 'config.php';
checkAuth();

$articles = loadArticles();
$article = null;
$isEdit = false;

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
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $isEdit ? 'Редактирование статьи' : 'Новая статья'; ?> - Админ-панель</title>
    <link href="../assets/css/output.css" rel="stylesheet">
    <!-- CKEditor для редактирования контента -->
    <script src="https://cdn.ckeditor.com/4.22.1/standard/ckeditor.js"></script>
    <style>
        /* Стили для CKEditor в темной теме */
        .cke_chrome {
            background: #1a1a24 !important;
            border: 1px solid #2a2a3a !important;
        }
        .cke_top {
            background: #1a1a24 !important;
            border-bottom: 1px solid #2a2a3a !important;
        }
        .cke_bottom {
            background: #1a1a24 !important;
            border-top: 1px solid #2a2a3a !important;
        }
        .cke_contents {
            background: #0a0a0f !important;
        }
        .cke_wysiwyg_frame, .cke_wysiwyg_div {
            background: #0a0a0f !important;
            color: #fff !important;
        }
    </style>
</head>
<body class="bg-dark-bg text-white">
    <div class="min-h-screen">
        <!-- Навигация -->
        <nav class="bg-dark-surface border-b border-dark-border">
            <div class="container mx-auto px-4 md:px-6 lg:px-8">
                <div class="flex items-center justify-between h-16">
                    <h1 class="text-xl font-bold text-gradient">
                        <?php echo $isEdit ? 'Редактирование статьи' : 'Новая статья'; ?>
                    </h1>
                    <div class="flex items-center space-x-4">
                        <a href="index.php" class="text-gray-400 hover:text-neon-purple transition-colors text-sm">
                            ← Назад к списку
                        </a>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Форма -->
        <div class="container mx-auto px-4 md:px-6 lg:px-8 py-8">
            <form method="POST" action="save.php" class="max-w-4xl mx-auto">
                <input type="hidden" name="id" value="<?php echo $article['id']; ?>">
                <input type="hidden" name="is_edit" value="<?php echo $isEdit ? '1' : '0'; ?>">
                
                <div class="bg-dark-surface border border-dark-border rounded-xl p-6 md:p-8 space-y-6">
                    <!-- Заголовок -->
                    <div>
                        <label class="block text-sm font-semibold mb-2 text-gray-300">Заголовок статьи *</label>
                        <input type="text" name="title" value="<?php echo htmlspecialchars($article['title']); ?>" required 
                               class="form-input" placeholder="Введите заголовок статьи">
                        <p class="text-xs text-gray-500 mt-1">Slug будет сгенерирован автоматически из заголовка</p>
                    </div>

                    <!-- Категория -->
                    <div>
                        <label class="block text-sm font-semibold mb-2 text-gray-300">Категория *</label>
                        <select name="category" required class="form-input">
                            <option value="SEO" <?php echo $article['category'] === 'SEO' ? 'selected' : ''; ?>>SEO</option>
                            <option value="Google Ads" <?php echo $article['category'] === 'Google Ads' ? 'selected' : ''; ?>>Google Ads</option>
                            <option value="Разработка" <?php echo $article['category'] === 'Разработка' ? 'selected' : ''; ?>>Разработка</option>
                            <option value="Маркетинг" <?php echo $article['category'] === 'Маркетинг' ? 'selected' : ''; ?>>Маркетинг</option>
                            <option value="Кейсы" <?php echo $article['category'] === 'Кейсы' ? 'selected' : ''; ?>>Кейсы</option>
                            <option value="Аналитика" <?php echo $article['category'] === 'Аналитика' ? 'selected' : ''; ?>>Аналитика</option>
                        </select>
                    </div>

                    <!-- Дата -->
                    <div>
                        <label class="block text-sm font-semibold mb-2 text-gray-300">Дата публикации *</label>
                        <input type="date" name="date" value="<?php echo htmlspecialchars($article['date']); ?>" required class="form-input">
                    </div>

                    <!-- Краткое описание -->
                    <div>
                        <label class="block text-sm font-semibold mb-2 text-gray-300">Краткое описание (excerpt) *</label>
                        <textarea name="excerpt" required rows="3" class="form-textarea" placeholder="Краткое описание статьи, которое будет отображаться в списке статей"><?php echo htmlspecialchars($article['excerpt']); ?></textarea>
                    </div>

                    <!-- Полный контент -->
                    <div>
                        <label class="block text-sm font-semibold mb-2 text-gray-300">Полный текст статьи *</label>
                        <textarea name="content" id="content" required rows="20" class="form-textarea"><?php echo htmlspecialchars($article['content']); ?></textarea>
                        <p class="text-xs text-gray-500 mt-1">Используйте HTML теги для форматирования (h2, h3, p, ul, li, strong, em, a)</p>
                    </div>

                    <!-- Изображение -->
                    <div>
                        <label class="block text-sm font-semibold mb-2 text-gray-300">URL изображения</label>
                        <input type="text" name="image" value="<?php echo htmlspecialchars($article['image']); ?>" 
                               class="form-input" placeholder="/assets/img/blog/article.jpg">
                    </div>

                    <!-- Автор -->
                    <div>
                        <label class="block text-sm font-semibold mb-2 text-gray-300">Автор</label>
                        <input type="text" name="author" value="<?php echo htmlspecialchars($article['author']); ?>" 
                               class="form-input" placeholder="NovaCreator Studio">
                    </div>

                    <!-- Кнопки -->
                    <div class="flex items-center justify-between pt-6 border-t border-dark-border">
                        <a href="index.php" class="text-gray-400 hover:text-neon-purple transition-colors">
                            Отмена
                        </a>
                        <button type="submit" class="btn-neon">
                            <?php echo $isEdit ? 'Сохранить изменения' : 'Создать статью'; ?>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Инициализация CKEditor для редактирования контента
        CKEDITOR.replace('content', {
            language: 'ru',
            height: 400,
            toolbar: [
                { name: 'basicstyles', items: ['Bold', 'Italic', 'Underline', 'Strike'] },
                { name: 'paragraph', items: ['NumberedList', 'BulletedList', '-', 'Blockquote'] },
                { name: 'links', items: ['Link', 'Unlink'] },
                { name: 'styles', items: ['Format', 'FontSize'] },
                { name: 'colors', items: ['TextColor', 'BGColor'] },
                { name: 'tools', items: ['Maximize', 'Source'] }
            ]
        });
    </script>
</body>
</html>

