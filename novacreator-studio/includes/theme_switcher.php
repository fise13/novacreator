<?php
/**
 * Переключатель темы (светлая/темная)
 */

// Получаем текущую тему из cookie или используем светлую по умолчанию
$currentTheme = $_COOKIE['theme'] ?? 'light';
if (!in_array($currentTheme, ['light', 'dark'])) {
    $currentTheme = 'light';
}
?>

<script>
(function() {
    // Функция для определения времени суток и соответствующей темы
    function getTimeBasedTheme() {
        const hour = new Date().getHours();
        // С 6:00 до 20:00 - светлая тема, остальное время - темная
        return (hour >= 6 && hour < 20) ? 'light' : 'dark';
    }
    
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
    let initialTheme = savedTheme || 'light';
    
    // Если тема 'auto', используем автоматическое переключение по времени
    if (initialTheme === 'auto') {
        initialTheme = getTimeBasedTheme();
    } else if (!initialTheme || initialTheme === '') {
        // Если тема не установлена, используем автоматическое переключение
        initialTheme = getTimeBasedTheme();
        localStorage.setItem('theme', 'auto');
    }
    
    // Устанавливаем тему до загрузки страницы (предотвращает мигание)
    setTheme(initialTheme);
    
    // Функция для автоматического переключения темы по времени
    function checkAndUpdateTimeBasedTheme() {
        const currentTheme = localStorage.getItem('theme');
        if (currentTheme === 'auto') {
            const timeBasedTheme = getTimeBasedTheme();
            const currentAppliedTheme = document.documentElement.classList.contains('light') ? 'light' : 'dark';
            if (timeBasedTheme !== currentAppliedTheme) {
                setTheme(timeBasedTheme);
                // Обновляем иконки темы если они есть
                if (window.updateThemeIcons) {
                    window.updateThemeIcons();
                }
            }
        }
    }
    
    // Проверяем тему каждую минуту
    setInterval(checkAndUpdateTimeBasedTheme, 60000);
    
    // Проверяем при загрузке страницы
    checkAndUpdateTimeBasedTheme();
    
    // Экспортируем функцию для использования в других скриптах
    window.setTheme = function(theme) {
        if (theme === 'auto') {
            localStorage.setItem('theme', 'auto');
            const timeBasedTheme = getTimeBasedTheme();
            setTheme(timeBasedTheme);
        } else {
            setTheme(theme);
        }
    };
    
    window.getTheme = function() {
        return document.documentElement.classList.contains('light') ? 'light' : 'dark';
    };
    
    window.getTimeBasedTheme = getTimeBasedTheme;
    
    // Слушаем изменения системной темы
    if (window.matchMedia) {
        window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', function(e) {
            const currentTheme = localStorage.getItem('theme');
            if (currentTheme === 'auto' || !currentTheme) {
                const timeBasedTheme = getTimeBasedTheme();
                setTheme(timeBasedTheme);
            }
        });
    }
})();
</script>

