<?php
/**
 * Страница 500 - Внутренняя ошибка сервера
 */
http_response_code(500);
$pageTitle = '500 - Ошибка сервера';
include 'includes/header.php';
?>

<section class="min-h-screen flex items-center justify-center pt-20">
    <div class="container mx-auto px-4 md:px-6 lg:px-8 text-center">
        <div class="max-w-2xl mx-auto animate-on-scroll">
            <h1 class="text-8xl md:text-9xl font-bold mb-6 text-gradient">500</h1>
            <h2 class="text-3xl md:text-4xl font-bold mb-6">Ошибка сервера</h2>
            <p class="text-xl text-gray-400 mb-12">
                Произошла внутренняя ошибка сервера. Мы уже работаем над её устранением.
            </p>
            <div class="flex flex-col sm:flex-row items-center justify-center gap-6">
                <a href="index.php" class="btn-neon">
                    На главную
                </a>
                <a href="contact.php" class="btn-outline">
                    Связаться с нами
                </a>
            </div>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>

