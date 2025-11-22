<?php
/**
 * Сохранение статьи
 */
require_once 'config.php';
checkAuth();

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: index.php');
    exit;
}

$articles = loadArticles();
$id = (int)$_POST['id'];
$isEdit = isset($_POST['is_edit']) && $_POST['is_edit'] === '1';

// Получаем данные из формы
$title = trim($_POST['title'] ?? '');
$category = trim($_POST['category'] ?? 'SEO');
$date = trim($_POST['date'] ?? date('Y-m-d'));
$excerpt = trim($_POST['excerpt'] ?? '');
$content = trim($_POST['content'] ?? '');
$image = trim($_POST['image'] ?? '');
$author = trim($_POST['author'] ?? 'NovaCreator Studio');

// Валидация
if (empty($title) || empty($excerpt) || empty($content)) {
    header('Location: edit.php?id=' . $id . '&error=Заполните все обязательные поля');
    exit;
}

// Генерируем slug из заголовка
$slug = generateSlug($title);

if ($isEdit) {
    // Редактирование существующей статьи
    $found = false;
    foreach ($articles as &$article) {
        if ($article['id'] === $id) {
            $article['title'] = $title;
            $article['slug'] = $slug;
            $article['category'] = $category;
            $article['date'] = $date;
            $article['excerpt'] = $excerpt;
            $article['content'] = $content;
            $article['image'] = $image;
            $article['author'] = $author;
            // Сохраняем views
            if (!isset($article['views'])) {
                $article['views'] = 0;
            }
            $found = true;
            break;
        }
    }
    
    if (!$found) {
        header('Location: index.php?error=Статья не найдена');
        exit;
    }
    
    $message = 'saved';
} else {
    // Создание новой статьи
    $newArticle = [
        'id' => $id,
        'title' => $title,
        'slug' => $slug,
        'category' => $category,
        'date' => $date,
        'excerpt' => $excerpt,
        'content' => $content,
        'image' => $image,
        'author' => $author,
        'views' => 0
    ];
    
    $articles[] = $newArticle;
    $message = 'created';
}

// Сохраняем статьи
saveArticles($articles);

// Перенаправляем на список статей
header('Location: index.php?message=' . $message);
exit;
?>

