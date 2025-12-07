<?php
/**
 * Переключатель темы (светлая/темная)
 */

// Получаем текущую тему из cookie или используем темную по умолчанию
$currentTheme = $_COOKIE['theme'] ?? 'dark';
if (!in_array($currentTheme, ['light', 'dark'])) {
    $currentTheme = 'dark';
}
?>

<script>
(function() {
    // Функция для установки темы
    function setTheme(theme) {
        document.documentElement.classList.remove('light', 'dark');
        document.documentElement.classList.add(theme);
        document.cookie = 'theme=' + theme + '; path=/; max-age=31536000; SameSite=Lax';
        localStorage.setItem('theme', theme);
    }
    
    // Получаем тему из localStorage или cookie
    const savedTheme = localStorage.getItem('theme') || '<?php echo $currentTheme; ?>';
    const prefersDark = window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches;
    
    // Определяем начальную тему
    let initialTheme = savedTheme;
    if (initialTheme === 'auto' || !initialTheme) {
        initialTheme = prefersDark ? 'dark' : 'light';
    }
    
    // Устанавливаем тему до загрузки страницы (предотвращает мигание)
    setTheme(initialTheme);
    
    // Экспортируем функцию для использования в других скриптах
    window.setTheme = setTheme;
    window.getTheme = function() {
        return document.documentElement.classList.contains('light') ? 'light' : 'dark';
    };
    
    // Слушаем изменения системной темы
    if (window.matchMedia) {
        window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', function(e) {
            const currentTheme = localStorage.getItem('theme');
            if (currentTheme === 'auto' || !currentTheme) {
                setTheme(e.matches ? 'dark' : 'light');
            }
        });
    }
})();
</script>

