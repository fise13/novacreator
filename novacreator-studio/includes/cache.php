<?php
/**
 * Простая система кэширования для статических данных
 * Используется для кэширования статей блога и других данных
 */

/**
 * Получает данные из кэша
 * @param string $key Ключ кэша
 * @param int $ttl Время жизни кэша в секундах
 * @return mixed|false Данные из кэша или false если кэш устарел/не существует
 */
function getCache($key, $ttl = 3600) {
    $cacheDir = __DIR__ . '/../cache/';
    
    // Создаем директорию кэша если её нет
    if (!is_dir($cacheDir)) {
        @mkdir($cacheDir, 0755, true);
    }
    
    $cacheFile = $cacheDir . md5($key) . '.cache';
    
    // Проверяем существование файла
    if (!file_exists($cacheFile)) {
        return false;
    }
    
    // Проверяем время жизни кэша
    if (time() - filemtime($cacheFile) > $ttl) {
        @unlink($cacheFile);
        return false;
    }
    
    // Читаем данные из кэша
    $data = @file_get_contents($cacheFile);
    if ($data === false) {
        return false;
    }
    
    return unserialize($data);
}

/**
 * Сохраняет данные в кэш
 * @param string $key Ключ кэша
 * @param mixed $data Данные для кэширования
 * @return bool Результат сохранения
 */
function setCache($key, $data) {
    $cacheDir = __DIR__ . '/../cache/';
    
    // Создаем директорию кэша если её нет
    if (!is_dir($cacheDir)) {
        @mkdir($cacheDir, 0755, true);
    }
    
    $cacheFile = $cacheDir . md5($key) . '.cache';
    
    return @file_put_contents($cacheFile, serialize($data), LOCK_EX) !== false;
}

/**
 * Очищает кэш по ключу или весь кэш
 * @param string|null $key Ключ кэша или null для очистки всего кэша
 * @return bool Результат очистки
 */
function clearCache($key = null) {
    $cacheDir = __DIR__ . '/../cache/';
    
    if ($key === null) {
        // Очищаем весь кэш
        if (is_dir($cacheDir)) {
            $files = glob($cacheDir . '*.cache');
            foreach ($files as $file) {
                @unlink($file);
            }
            return true;
        }
        return false;
    } else {
        // Очищаем конкретный кэш
        $cacheFile = $cacheDir . md5($key) . '.cache';
        if (file_exists($cacheFile)) {
            return @unlink($cacheFile);
        }
        return true;
    }
}

/**
 * Очищает устаревший кэш
 * @param int $ttl Время жизни кэша в секундах
 * @return int Количество удаленных файлов
 */
function cleanExpiredCache($ttl = 3600) {
    $cacheDir = __DIR__ . '/../cache/';
    $deleted = 0;
    
    if (is_dir($cacheDir)) {
        $files = glob($cacheDir . '*.cache');
        foreach ($files as $file) {
            if (time() - filemtime($file) > $ttl) {
                if (@unlink($file)) {
                    $deleted++;
                }
            }
        }
    }
    
    return $deleted;
}

