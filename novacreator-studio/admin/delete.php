<?php
/**
 * Удаление статьи
 */
require_once 'config.php';
checkAuth();

if (!isset($_GET['id'])) {
    header('Location: index.php');
    exit;
}

$id = (int)$_GET['id'];
$articles = loadArticles();

// Удаляем статью
$articles = array_filter($articles, function($article) use ($id) {
    return $article['id'] !== $id;
});

// Переиндексируем массив
$articles = array_values($articles);

// Сохраняем
saveArticles($articles);

// Перенаправляем на список статей
header('Location: index.php?message=deleted');
exit;
?>

