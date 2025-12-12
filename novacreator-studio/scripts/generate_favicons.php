<?php
/**
 * Скрипт для генерации PNG-иконок из favicon.ico
 * Создает все необходимые размеры для Google Search и PWA
 */

$sourceFile = __DIR__ . '/../favicon.ico';
$outputDir = __DIR__ . '/../assets/img/';

// Проверяем существование исходного файла
if (!file_exists($sourceFile)) {
    die("Ошибка: файл favicon.ico не найден в корне проекта\n");
}

// Создаем директорию, если её нет
if (!is_dir($outputDir)) {
    mkdir($outputDir, 0755, true);
}

// Размеры для генерации
$sizes = [
    32 => 'icon-32.png',
    48 => 'icon-48.png',
    180 => 'icon-180.png',
    192 => 'icon-192.png',
    512 => 'icon-512.png',
];

echo "Генерация иконок из favicon.ico...\n\n";

// Проверяем наличие GD или Imagick
$useImagick = extension_loaded('imagick');
$useGD = extension_loaded('gd');

if (!$useImagick && !$useGD) {
    die("Ошибка: требуется расширение PHP GD или Imagick для работы с изображениями\n");
}

if ($useImagick) {
    echo "Используется Imagick\n\n";
    
    try {
        $image = new Imagick($sourceFile);
        
        foreach ($sizes as $size => $filename) {
            $outputPath = $outputDir . $filename;
            
            // Создаем копию и изменяем размер
            $resized = clone $image;
            $resized->resizeImage($size, $size, Imagick::FILTER_LANCZOS, 1, true);
            $resized->setImageFormat('png');
            $resized->setImageCompressionQuality(90);
            
            // Сохраняем
            if ($resized->writeImage($outputPath)) {
                echo "✓ Создан: {$filename} ({$size}x{$size})\n";
            } else {
                echo "✗ Ошибка при создании: {$filename}\n";
            }
            
            $resized->destroy();
        }
        
        $image->destroy();
        
    } catch (Exception $e) {
        die("Ошибка Imagick: " . $e->getMessage() . "\n");
    }
    
} elseif ($useGD) {
    echo "Используется GD\n\n";
    
    // Определяем тип изображения
    $imageInfo = getimagesize($sourceFile);
    if (!$imageInfo) {
        die("Ошибка: не удалось определить тип изображения\n");
    }
    
    // Загружаем изображение
    switch ($imageInfo[2]) {
        case IMAGETYPE_PNG:
            $source = imagecreatefrompng($sourceFile);
            break;
        case IMAGETYPE_JPEG:
            $source = imagecreatefromjpeg($sourceFile);
            break;
        case IMAGETYPE_GIF:
            $source = imagecreatefromgif($sourceFile);
            break;
        case IMAGETYPE_ICO:
            // ICO файлы могут быть сложными, попробуем как PNG
            $source = @imagecreatefrompng($sourceFile);
            if (!$source) {
                die("Ошибка: не удалось загрузить ICO файл. Попробуйте использовать Imagick.\n");
            }
            break;
        default:
            die("Ошибка: неподдерживаемый тип изображения\n");
    }
    
    if (!$source) {
        die("Ошибка: не удалось загрузить изображение\n");
    }
    
    // Получаем размеры исходного изображения
    $sourceWidth = imagesx($source);
    $sourceHeight = imagesy($source);
    
    foreach ($sizes as $size => $filename) {
        $outputPath = $outputDir . $filename;
        
        // Создаем новое изображение нужного размера
        $resized = imagecreatetruecolor($size, $size);
        
        // Включаем прозрачность
        imagealphablending($resized, false);
        imagesavealpha($resized, true);
        $transparent = imagecolorallocatealpha($resized, 0, 0, 0, 127);
        imagefill($resized, 0, 0, $transparent);
        
        // Изменяем размер с сохранением пропорций
        imagecopyresampled(
            $resized, $source,
            0, 0, 0, 0,
            $size, $size,
            $sourceWidth, $sourceHeight
        );
        
        // Сохраняем как PNG
        if (imagepng($resized, $outputPath, 9)) {
            echo "✓ Создан: {$filename} ({$size}x{$size})\n";
        } else {
            echo "✗ Ошибка при создании: {$filename}\n";
        }
        
        imagedestroy($resized);
    }
    
    imagedestroy($source);
}

echo "\n✓ Генерация завершена!\n";
echo "Проверьте файлы в директории: {$outputDir}\n";
echo "\nТеперь favicon должен корректно отображаться в Google Search.\n";

