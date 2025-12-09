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
    <!-- Статистика - улучшенный дизайн с большими числами -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
        <div class="admin-card bg-gradient-to-br from-neon-purple/20 to-neon-blue/20 border-2 border-neon-purple/40 rounded-2xl p-8 animate-fade-in hover:scale-105 transition-transform shadow-lg hover:shadow-xl">
            <div class="flex items-center justify-between mb-4">
                <div class="flex-1">
                    <p class="text-gray-400 text-base mb-2 font-medium">Всего статей</p>
                    <p class="text-5xl md:text-6xl font-extrabold text-gradient leading-none"><?php echo $totalArticles; ?></p>
                        </div>
                <div class="w-16 h-16 bg-gradient-to-r from-neon-purple to-neon-blue rounded-xl flex items-center justify-center shadow-lg">
                    <i class="fas fa-file-alt text-white text-2xl"></i>
                </div>
            </div>
            <div class="pt-4 border-t border-neon-purple/20">
                <p class="text-xs text-gray-500">Активный контент</p>
            </div>
        </div>

        <div class="admin-card bg-gradient-to-br from-neon-blue/20 to-neon-purple/20 border-2 border-neon-blue/40 rounded-2xl p-8 animate-fade-in hover:scale-105 transition-transform shadow-lg hover:shadow-xl" style="animation-delay: 0.1s;">
            <div class="flex items-center justify-between mb-4">
                <div class="flex-1">
                    <p class="text-gray-400 text-base mb-2 font-medium">Всего просмотров</p>
                    <p class="text-5xl md:text-6xl font-extrabold text-gradient leading-none"><?php echo number_format($totalViews); ?></p>
                </div>
                <div class="w-16 h-16 bg-gradient-to-r from-neon-blue to-neon-purple rounded-xl flex items-center justify-center shadow-lg">
                    <i class="fas fa-eye text-white text-2xl"></i>
                </div>
                        </div>
            <div class="pt-4 border-t border-neon-blue/20">
                <p class="text-xs text-gray-500">Общая статистика</p>
                    </div>
                </div>
        
        <div class="admin-card bg-gradient-to-br from-neon-purple/20 to-neon-blue/20 border-2 border-neon-purple/40 rounded-2xl p-8 animate-fade-in hover:scale-105 transition-transform shadow-lg hover:shadow-xl" style="animation-delay: 0.2s;">
            <div class="flex items-center justify-between mb-4">
                <div class="flex-1">
                    <p class="text-gray-400 text-base mb-2 font-medium">Среднее просмотров</p>
                    <p class="text-5xl md:text-6xl font-extrabold text-gradient leading-none"><?php echo $avgViews; ?></p>
                        </div>
                <div class="w-16 h-16 bg-gradient-to-r from-neon-purple to-neon-blue rounded-xl flex items-center justify-center shadow-lg">
                    <i class="fas fa-chart-line text-white text-2xl"></i>
                        </div>
            </div>
            <div class="pt-4 border-t border-neon-purple/20">
                <p class="text-xs text-gray-500">На статью</p>
                    </div>
                </div>
            </div>

    <!-- Заголовок и действия - увеличенный и улучшенный -->
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-6 mb-8">
        <div>
            <h2 class="text-4xl md:text-5xl lg:text-6xl font-extrabold text-gradient mb-2">Статьи блога</h2>
            <p class="text-gray-400 text-lg">Управление контентом и публикациями</p>
        </div>
        <a href="edit.php" class="btn-neon btn-admin inline-flex items-center space-x-3 px-6 py-4 text-lg font-semibold rounded-xl hover:scale-105 transition-transform">
            <i class="fas fa-plus text-xl"></i>
            <span>Новая статья</span>
        </a>
    </div>

    <!-- Поиск и фильтры - улучшенный дизайн -->
    <div class="bg-dark-surface border-2 border-dark-border rounded-2xl p-8 mb-8 animate-fade-in shadow-lg">
        <h3 class="text-xl font-bold text-gradient mb-6">Поиск и фильтрация</h3>
        <form method="GET" class="flex flex-col md:flex-row gap-4">
            <div class="flex-1 relative">
                <i class="fas fa-search absolute left-5 top-1/2 transform -translate-y-1/2 text-gray-400 text-lg"></i>
                <input type="text" name="search" value="<?php echo htmlspecialchars($search); ?>" 
                       placeholder="Поиск по статьям..." 
                       class="form-input w-full pl-12 pr-4 py-3 text-lg rounded-xl border-2 focus:border-neon-purple">
            </div>
            <select name="category" class="form-select bg-dark-bg border-2 border-dark-border rounded-xl px-5 py-3 text-white text-lg focus:border-neon-purple">
                <option value="">Все категории</option>
                <?php foreach ($categories as $cat): ?>
                    <option value="<?php echo htmlspecialchars($cat); ?>" <?php echo $category === $cat ? 'selected' : ''; ?>>
                        <?php echo htmlspecialchars($cat); ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <button type="submit" class="btn-neon px-8 py-3 text-lg">
                <i class="fas fa-filter mr-2"></i>
                Применить
            </button>
            <?php if ($search || $category): ?>
                <a href="index.php" class="px-8 py-3 bg-dark-bg border-2 border-dark-border rounded-xl hover:bg-dark-border hover:border-neon-purple transition-all text-center text-lg font-medium">
                    <i class="fas fa-times mr-2"></i>
                    Сбросить
                </a>
            <?php endif; ?>
        </form>
            </div>

    <!-- Список статей -->
    <?php if (empty($filteredArticles)): ?>
        <div class="bg-dark-surface border-2 border-dark-border rounded-2xl p-16 text-center animate-fade-in shadow-lg">
            <i class="fas fa-inbox text-7xl text-gray-600 mb-6"></i>
            <p class="text-2xl font-semibold text-gray-400 mb-8">
                <?php echo $search || $category ? 'Статьи не найдены' : 'Статьи пока не добавлены'; ?>
            </p>
            <?php if (!$search && !$category): ?>
                <a href="edit.php" class="btn-neon btn-admin inline-flex items-center space-x-3 px-8 py-4 text-lg">
                    <i class="fas fa-plus text-xl"></i>
                    <span>Создать первую статью</span>
                    </a>
            <?php endif; ?>
                </div>
            <?php else: ?>
        <div class="bg-dark-surface border-2 border-dark-border rounded-2xl overflow-hidden animate-fade-in shadow-xl">
            <!-- Десктоп таблица -->
            <div class="hidden md:block overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-dark-bg border-b-2 border-dark-border">
                            <tr>
                                <th class="px-8 py-5 text-left text-base font-bold text-gray-300">ID</th>
                                <th class="px-8 py-5 text-left text-base font-bold text-gray-300">Заголовок</th>
                                <th class="px-8 py-5 text-left text-base font-bold text-gray-300">Категория</th>
                                <th class="px-8 py-5 text-left text-base font-bold text-gray-300">Дата</th>
                                <th class="px-8 py-5 text-left text-base font-bold text-gray-300">Просмотры</th>
                                <th class="px-8 py-5 text-right text-base font-bold text-gray-300">Действия</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($filteredArticles as $article): ?>
                            <tr class="table-row border-b border-dark-border hover:bg-dark-bg/50 transition-colors">
                                    <td class="px-8 py-5 text-gray-400 font-medium"><?php echo $article['id']; ?></td>
                                    <td class="px-8 py-5">
                                    <a href="../blog-post?slug=<?php echo htmlspecialchars($article['slug']); ?>" 
                                       target="_blank" 
                                       class="text-neon-purple hover:text-neon-blue transition-colors font-bold text-lg flex items-center space-x-2">
                                        <span><?php echo htmlspecialchars($article['title']); ?></span>
                                        <i class="fas fa-external-link-alt text-sm"></i>
                                        </a>
                                    </td>
                                <td class="px-8 py-5">
                                        <span class="px-4 py-2 bg-neon-purple/20 text-neon-purple rounded-xl text-base font-semibold">
                                            <?php echo htmlspecialchars($article['category']); ?>
                                        </span>
                                    </td>
                                    <td class="px-8 py-5 text-gray-400 text-base"><?php echo htmlspecialchars($article['date']); ?></td>
                                <td class="px-8 py-5 text-gray-400">
                                    <span class="flex items-center space-x-2 text-base font-medium">
                                        <i class="fas fa-eye"></i>
                                        <span><?php echo $article['views'] ?? 0; ?></span>
                                    </span>
                                </td>
                                    <td class="px-8 py-5 text-right">
                                        <div class="flex items-center justify-end space-x-3">
                                        <a href="edit.php?id=<?php echo $article['id']; ?>" 
                                           class="px-5 py-2.5 bg-neon-purple/20 text-neon-purple rounded-xl hover:bg-neon-purple/30 hover:scale-105 transition-all text-base font-semibold flex items-center space-x-2">
                                            <i class="fas fa-edit"></i>
                                            <span class="hidden lg:inline">Редактировать</span>
                                            </a>
                                        <a href="delete.php?id=<?php echo $article['id']; ?>" 
                                           onclick="event.preventDefault(); handleDelete(<?php echo $article['id']; ?>, '<?php echo htmlspecialchars(addslashes($article['title'])); ?>');" 
                                           class="px-5 py-2.5 bg-red-600/20 text-red-400 rounded-xl hover:bg-red-600/30 hover:scale-105 transition-all text-base font-semibold flex items-center space-x-2">
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
            
            <!-- Мобильные карточки - улучшенный дизайн -->
            <div class="md:hidden divide-y-2 divide-dark-border">
                <?php foreach ($filteredArticles as $article): ?>
                    <div class="p-6 hover:bg-dark-bg/50 transition-colors border-b-2 border-dark-border last:border-b-0">
                        <div class="flex items-start justify-between mb-4">
                            <div class="flex-1">
                                <a href="../blog-post?slug=<?php echo htmlspecialchars($article['slug']); ?>" 
                                   target="_blank" 
                                   class="text-neon-purple hover:text-neon-blue transition-colors font-bold text-lg block mb-3">
                                    <?php echo htmlspecialchars($article['title']); ?>
                                </a>
                                <div class="flex flex-wrap items-center gap-3 text-base">
                                    <span class="px-3 py-1.5 bg-neon-purple/20 text-neon-purple rounded-xl font-semibold">
                                        <?php echo htmlspecialchars($article['category']); ?>
                                    </span>
                                    <span class="text-gray-400"><?php echo htmlspecialchars($article['date']); ?></span>
                                    <span class="flex items-center space-x-2 text-gray-400 font-medium">
                                        <i class="fas fa-eye"></i>
                                        <span><?php echo $article['views'] ?? 0; ?></span>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="flex space-x-3 mt-5">
                            <a href="edit.php?id=<?php echo $article['id']; ?>" 
                               class="flex-1 px-5 py-3 bg-neon-purple/20 text-neon-purple rounded-xl hover:bg-neon-purple/30 hover:scale-105 transition-all text-base font-semibold text-center">
                                <i class="fas fa-edit mr-2"></i>Редактировать
                            </a>
                            <a href="delete.php?id=<?php echo $article['id']; ?>" 
                               onclick="event.preventDefault(); handleDelete(<?php echo $article['id']; ?>, '<?php echo htmlspecialchars(addslashes($article['title'])); ?>');" 
                               class="flex-1 px-5 py-3 bg-red-600/20 text-red-400 rounded-xl hover:bg-red-600/30 hover:scale-105 transition-all text-base font-semibold text-center">
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
