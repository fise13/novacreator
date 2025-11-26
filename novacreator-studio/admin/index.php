<?php
/**
 * Главная страница админ-панели
 * Список всех статей блога с поиском и фильтрацией
 */
require_once 'config.php';
checkAuth();

$articles = loadArticles();
$pageTitle = 'Управление блогом';

// Фильтрация и поиск
$search = $_GET['search'] ?? '';
$category = $_GET['category'] ?? '';

$filteredArticles = $articles;
if ($search) {
    $filteredArticles = array_filter($filteredArticles, function($article) use ($search) {
        return stripos($article['title'], $search) !== false || 
               stripos($article['excerpt'], $search) !== false ||
               stripos($article['content'], $search) !== false;
    });
}
if ($category) {
    $filteredArticles = array_filter($filteredArticles, function($article) use ($category) {
        return $article['category'] === $category;
    });
}
$filteredArticles = array_values($filteredArticles);

// Получаем уникальные категории
$categories = array_unique(array_column($articles, 'category'));
sort($categories);

// Статистика
$totalViews = array_sum(array_column($articles, 'views'));
$totalArticles = count($articles);
$avgViews = $totalArticles > 0 ? round($totalViews / $totalArticles, 1) : 0;

include 'includes/header.php';
?>

<div class="container mx-auto px-4 md:px-6 lg:px-8 py-8">
    <!-- Статистика -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <div class="admin-card bg-gradient-to-br from-neon-purple/20 to-neon-blue/20 border border-neon-purple/30 rounded-xl p-6 animate-fade-in">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-400 text-sm mb-1">Всего статей</p>
                    <p class="text-3xl font-bold text-gradient"><?php echo $totalArticles; ?></p>
                </div>
                <div class="w-12 h-12 bg-gradient-to-r from-neon-purple to-neon-blue rounded-lg flex items-center justify-center">
                    <i class="fas fa-file-alt text-white text-xl"></i>
                </div>
            </div>
        </div>
        
        <div class="admin-card bg-gradient-to-br from-neon-blue/20 to-neon-purple/20 border border-neon-blue/30 rounded-xl p-6 animate-fade-in" style="animation-delay: 0.1s;">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-400 text-sm mb-1">Всего просмотров</p>
                    <p class="text-3xl font-bold text-gradient"><?php echo number_format($totalViews); ?></p>
                </div>
                <div class="w-12 h-12 bg-gradient-to-r from-neon-blue to-neon-purple rounded-lg flex items-center justify-center">
                    <i class="fas fa-eye text-white text-xl"></i>
                </div>
            </div>
        </div>
        
        <div class="admin-card bg-gradient-to-br from-neon-purple/20 to-neon-blue/20 border border-neon-purple/30 rounded-xl p-6 animate-fade-in" style="animation-delay: 0.2s;">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-400 text-sm mb-1">Среднее просмотров</p>
                    <p class="text-3xl font-bold text-gradient"><?php echo $avgViews; ?></p>
                </div>
                <div class="w-12 h-12 bg-gradient-to-r from-neon-purple to-neon-blue rounded-lg flex items-center justify-center">
                    <i class="fas fa-chart-line text-white text-xl"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Заголовок и действия -->
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-6">
        <h2 class="text-3xl font-bold text-gradient">Статьи блога</h2>
        <a href="edit.php" class="btn-neon btn-admin inline-flex items-center space-x-2">
            <i class="fas fa-plus"></i>
            <span>Новая статья</span>
        </a>
    </div>

    <!-- Поиск и фильтры -->
    <div class="bg-dark-surface border border-dark-border rounded-xl p-6 mb-6 animate-fade-in">
        <form method="GET" class="flex flex-col md:flex-row gap-4">
            <div class="flex-1 relative">
                <i class="fas fa-search absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                <input type="text" name="search" value="<?php echo htmlspecialchars($search); ?>" 
                       placeholder="Поиск по статьям..." 
                       class="form-input w-full pl-10 pr-4 py-2">
            </div>
            <select name="category" class="form-select bg-dark-bg border border-dark-border rounded-lg px-4 py-2 text-white">
                <option value="">Все категории</option>
                <?php foreach ($categories as $cat): ?>
                    <option value="<?php echo htmlspecialchars($cat); ?>" <?php echo $category === $cat ? 'selected' : ''; ?>>
                        <?php echo htmlspecialchars($cat); ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <button type="submit" class="btn-neon px-6 py-2">
                <i class="fas fa-filter mr-2"></i>
                Применить
            </button>
            <?php if ($search || $category): ?>
                <a href="index.php" class="px-6 py-2 bg-dark-bg border border-dark-border rounded-lg hover:bg-dark-border transition-colors text-center">
                    <i class="fas fa-times mr-2"></i>
                    Сбросить
                </a>
            <?php endif; ?>
        </form>
    </div>

    <!-- Список статей -->
    <?php if (empty($filteredArticles)): ?>
        <div class="bg-dark-surface border border-dark-border rounded-xl p-12 text-center animate-fade-in">
            <i class="fas fa-inbox text-6xl text-gray-600 mb-4"></i>
            <p class="text-xl text-gray-400 mb-6">
                <?php echo $search || $category ? 'Статьи не найдены' : 'Статьи пока не добавлены'; ?>
            </p>
            <?php if (!$search && !$category): ?>
                <a href="edit.php" class="btn-neon btn-admin inline-flex items-center space-x-2">
                    <i class="fas fa-plus"></i>
                    <span>Создать первую статью</span>
                </a>
            <?php endif; ?>
        </div>
    <?php else: ?>
        <div class="bg-dark-surface border border-dark-border rounded-xl overflow-hidden animate-fade-in">
            <!-- Десктоп таблица -->
            <div class="hidden md:block overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-dark-bg border-b border-dark-border">
                        <tr>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-gray-300">ID</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-gray-300">Заголовок</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-gray-300">Категория</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-gray-300">Дата</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-gray-300">Просмотры</th>
                            <th class="px-6 py-4 text-right text-sm font-semibold text-gray-300">Действия</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($filteredArticles as $article): ?>
                            <tr class="table-row border-b border-dark-border">
                                <td class="px-6 py-4 text-gray-400"><?php echo $article['id']; ?></td>
                                <td class="px-6 py-4">
                                    <a href="../blog-post?slug=<?php echo htmlspecialchars($article['slug']); ?>" 
                                       target="_blank" 
                                       class="text-neon-purple hover:text-neon-blue transition-colors font-semibold flex items-center space-x-2">
                                        <span><?php echo htmlspecialchars($article['title']); ?></span>
                                        <i class="fas fa-external-link-alt text-xs"></i>
                                    </a>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="px-3 py-1 bg-neon-purple/20 text-neon-purple rounded-full text-sm">
                                        <?php echo htmlspecialchars($article['category']); ?>
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-gray-400"><?php echo htmlspecialchars($article['date']); ?></td>
                                <td class="px-6 py-4 text-gray-400">
                                    <span class="flex items-center space-x-2">
                                        <i class="fas fa-eye text-xs"></i>
                                        <span><?php echo $article['views'] ?? 0; ?></span>
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <div class="flex items-center justify-end space-x-2">
                                        <a href="edit.php?id=<?php echo $article['id']; ?>" 
                                           class="px-4 py-2 bg-neon-purple/20 text-neon-purple rounded-lg hover:bg-neon-purple/30 transition-colors text-sm flex items-center space-x-2">
                                            <i class="fas fa-edit"></i>
                                            <span class="hidden lg:inline">Редактировать</span>
                                        </a>
                                        <a href="delete.php?id=<?php echo $article['id']; ?>" 
                                           onclick="event.preventDefault(); handleDelete(<?php echo $article['id']; ?>, '<?php echo htmlspecialchars(addslashes($article['title'])); ?>');" 
                                           class="px-4 py-2 bg-red-600/20 text-red-400 rounded-lg hover:bg-red-600/30 transition-colors text-sm flex items-center space-x-2">
                                            <i class="fas fa-trash"></i>
                                            <span class="hidden lg:inline">Удалить</span>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            
            <!-- Мобильные карточки -->
            <div class="md:hidden divide-y divide-dark-border">
                <?php foreach ($filteredArticles as $article): ?>
                    <div class="p-4 hover:bg-dark-bg/50 transition-colors">
                        <div class="flex items-start justify-between mb-2">
                            <div class="flex-1">
                                <a href="../blog-post?slug=<?php echo htmlspecialchars($article['slug']); ?>" 
                                   target="_blank" 
                                   class="text-neon-purple hover:text-neon-blue transition-colors font-semibold block mb-2">
                                    <?php echo htmlspecialchars($article['title']); ?>
                                </a>
                                <div class="flex flex-wrap items-center gap-2 text-sm text-gray-400">
                                    <span class="px-2 py-1 bg-neon-purple/20 text-neon-purple rounded">
                                        <?php echo htmlspecialchars($article['category']); ?>
                                    </span>
                                    <span><?php echo htmlspecialchars($article['date']); ?></span>
                                    <span class="flex items-center space-x-1">
                                        <i class="fas fa-eye"></i>
                                        <span><?php echo $article['views'] ?? 0; ?></span>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="flex space-x-2 mt-4">
                            <a href="edit.php?id=<?php echo $article['id']; ?>" 
                               class="flex-1 px-4 py-2 bg-neon-purple/20 text-neon-purple rounded-lg hover:bg-neon-purple/30 transition-colors text-sm text-center">
                                <i class="fas fa-edit mr-2"></i>Редактировать
                            </a>
                            <a href="delete.php?id=<?php echo $article['id']; ?>" 
                               onclick="event.preventDefault(); handleDelete(<?php echo $article['id']; ?>, '<?php echo htmlspecialchars(addslashes($article['title'])); ?>');" 
                               class="flex-1 px-4 py-2 bg-red-600/20 text-red-400 rounded-lg hover:bg-red-600/30 transition-colors text-sm text-center">
                                <i class="fas fa-trash mr-2"></i>Удалить
                            </a>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    <?php endif; ?>
</div>

<script>
// Обработка удаления с подтверждением
async function handleDelete(id, title) {
    const confirmed = await confirmDelete(`Вы уверены, что хотите удалить статью "${title}"?`);
    if (confirmed) {
        // Показываем индикатор загрузки
        showNotification('Удаление статьи...', 'info');
        
        // Выполняем удаление
        window.location.href = `delete.php?id=${id}`;
    }
}
</script>

<?php include 'includes/footer.php'; ?>
