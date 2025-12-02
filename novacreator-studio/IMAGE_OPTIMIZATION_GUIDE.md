# Руководство по оптимизации изображений для SEO

## 📸 Почему это важно

Изображения:
- Составляют 60-80% веса страницы
- Влияют на скорость загрузки (Core Web Vitals)
- Являются фактором ранжирования
- Генерируют трафик через Google Images
- Улучшают пользовательский опыт

---

## ✅ Чек-лист оптимизации изображений

### 1. Формат изображений

**Текущее состояние:**
- ❌ Используются JPG/PNG
- ✅ Есть SVG для логотипов

**Рекомендации:**
```
WebP - основной формат (поддержка 96% браузеров)
├── Сжатие: на 25-35% лучше чем JPG
├── Прозрачность: поддерживается
└── Анимация: поддерживается

AVIF - перспективный формат
├── Сжатие: на 50% лучше чем JPG
├── Поддержка: 85% браузеров
└── Fallback: нужен для старых браузеров

SVG - для иконок и логотипов
├── Векторный формат
├── Масштабируемый
└── Малый размер
```

### 2. Alt-теги для всех изображений

**Как проверить:**
```bash
# Найти изображения без alt
grep -r "<img" . --include="*.php" | grep -v "alt="
```

**Правила написания alt-текстов:**

✅ **Хорошие примеры:**
```html
<!-- Логотип компании -->
<img src="/assets/img/logo.svg" 
     alt="NovaCreator Studio - Логотип цифрового агентства" 
     width="64" height="64">

<!-- Фото команды -->
<img src="/assets/img/team.jpg" 
     alt="Команда NovaCreator Studio: SEO специалисты и веб-разработчики" 
     width="800" height="600">

<!-- Иконка услуги -->
<img src="/assets/img/icon-seo.svg" 
     alt="Иконка SEO оптимизации - график роста позиций"
     width="48" height="48">

<!-- Кейс клиента -->
<img src="/assets/img/portfolio/client1.jpg" 
     alt="Сайт интернет-магазина электроники - главная страница" 
     width="1200" height="800">

<!-- Декоративное изображение -->
<img src="/assets/img/decoration.svg" 
     alt="" 
     role="presentation">
```

❌ **Плохие примеры:**
```html
<!-- Слишком короткий -->
<img src="image.jpg" alt="Фото">

<!-- Нерелевантный -->
<img src="team.jpg" alt="DSC_1234.jpg">

<!-- Переспам ключевыми словами -->
<img src="seo.jpg" alt="SEO оптимизация Алматы SEO продвижение Алматы SEO услуги Алматы">

<!-- Отсутствует -->
<img src="logo.svg">
```

**Структура хорошего alt-текста:**
```
[Что изображено] + [Контекст] + [Ключевое слово (если уместно)]

Примеры:
- "Команда NovaCreator Studio на встрече с клиентом по SEO проекту"
- "График роста органического трафика за 6 месяцев"
- "Интерфейс Google Analytics 4 с настройками конверсий"
```

### 3. Размеры изображений

**Рекомендуемые размеры:**
```
Hero изображения:     1920x1080 (или 1600x900)
Карточки услуг:       800x600
Логотип:              250x60 (или векторный SVG)
Иконки:               64x64 (или векторный SVG)
Open Graph:           1200x630
Миниатюры блога:      600x400
Портфолио:            1200x800
Аватары:              150x150
Фавиконки:            32x32, 16x16
```

**Адаптивные изображения:**
```html
<!-- Используйте srcset для разных экранов -->
<img src="/assets/img/hero-800.webp"
     srcset="/assets/img/hero-400.webp 400w,
             /assets/img/hero-800.webp 800w,
             /assets/img/hero-1200.webp 1200w,
             /assets/img/hero-1920.webp 1920w"
     sizes="(max-width: 768px) 100vw,
            (max-width: 1200px) 80vw,
            1200px"
     alt="Современный офис NovaCreator Studio"
     loading="lazy"
     width="1920"
     height="1080">
```

### 4. Lazy Loading

**Реализация:**
```html
<!-- Для изображений ниже первого экрана -->
<img src="/assets/img/service.webp" 
     alt="SEO оптимизация сайтов" 
     loading="lazy"
     width="800" 
     height="600">

<!-- Для изображений на первом экране НЕ используем lazy -->
<img src="/assets/img/hero.webp" 
     alt="Hero изображение" 
     loading="eager"
     fetchpriority="high"
     width="1920" 
     height="1080">
```

### 5. WebP с Fallback

**Picture элемент:**
```html
<picture>
    <!-- AVIF (самое лучшее сжатие) -->
    <source srcset="/assets/img/hero.avif" type="image/avif">
    
    <!-- WebP (хорошее сжатие) -->
    <source srcset="/assets/img/hero.webp" type="image/webp">
    
    <!-- JPG/PNG (fallback для старых браузеров) -->
    <img src="/assets/img/hero.jpg" 
         alt="Hero изображение" 
         width="1920" 
         height="1080"
         loading="lazy">
</picture>
```

### 6. Width и Height атрибуты

**Всегда указывайте размеры:**
```html
<!-- ✅ Правильно -->
<img src="image.webp" 
     alt="Описание" 
     width="800" 
     height="600">

<!-- ❌ Неправильно (CLS проблема) -->
<img src="image.webp" alt="Описание">
```

**Почему это важно:**
- Предотвращает CLS (Cumulative Layout Shift)
- Браузер резервирует место до загрузки
- Улучшает Core Web Vitals

---

## 🛠️ Инструменты для оптимизации

### 1. Конвертация в WebP (macOS/Linux)

**Установка cwebp:**
```bash
# macOS
brew install webp

# Ubuntu/Debian
sudo apt-get install webp

# Windows (через Chocolatey)
choco install webp
```

**Массовая конвертация:**
```bash
cd /Users/victor/Documents/novacreative/novacreator-studio/assets/img

# JPG → WebP
find . -name "*.jpg" -exec sh -c 'cwebp -q 80 "$1" -o "${1%.jpg}.webp"' _ {} \;

# PNG → WebP (с сохранением прозрачности)
find . -name "*.png" -exec sh -c 'cwebp -q 80 -alpha_q 100 "$1" -o "${1%.png}.webp"' _ {} \;

# Оптимизация с более агрессивным сжатием
find . -name "*.jpg" -exec sh -c 'cwebp -q 75 -m 6 -mt "$1" -o "${1%.jpg}.webp"' _ {} \;
```

**Параметры cwebp:**
```
-q 80       : Качество (0-100, рекомендуется 75-85)
-m 6        : Метод сжатия (0-6, 6 = лучшее сжатие)
-mt         : Мультипоточность (быстрее)
-alpha_q    : Качество альфа-канала для PNG
-resize     : Изменить размер
```

### 2. Squoosh (GUI инструмент)

**Онлайн версия:**
```
https://squoosh.app/
```

**CLI версия:**
```bash
npm install -g @squoosh/cli

squoosh-cli --webp '{"quality":80}' image.jpg
```

### 3. ImageMagick (универсальный)

**Установка:**
```bash
# macOS
brew install imagemagick

# Ubuntu
sudo apt-get install imagemagick
```

**Примеры использования:**
```bash
# Конвертация JPG в WebP
convert input.jpg -quality 80 output.webp

# Изменение размера
convert input.jpg -resize 800x600 output.jpg

# Оптимизация JPG
convert input.jpg -strip -interlace Plane -quality 85 output.jpg

# Массовое изменение размера
mogrify -resize 800x600 -quality 85 *.jpg
```

### 4. TinyPNG/TinyJPG (API)

**Онлайн:**
```
https://tinypng.com/
```

**API (Node.js):**
```bash
npm install tinify

# tinify.js
const tinify = require('tinify');
tinify.key = 'YOUR_API_KEY';

const source = tinify.fromFile('input.png');
source.toFile('output.png');
```

### 5. Sharp (Node.js)

**Установка:**
```bash
npm install sharp
```

**Пример скрипта:**
```javascript
// optimize-images.js
const sharp = require('sharp');
const fs = require('fs').promises;
const path = require('path');

async function optimizeImages(inputDir) {
    const files = await fs.readdir(inputDir);
    
    for (const file of files) {
        const inputPath = path.join(inputDir, file);
        const ext = path.extname(file).toLowerCase();
        
        if (['.jpg', '.jpeg', '.png'].includes(ext)) {
            const outputPath = inputPath.replace(ext, '.webp');
            
            await sharp(inputPath)
                .webp({ quality: 80 })
                .toFile(outputPath);
            
            console.log(`Converted: ${file} -> ${path.basename(outputPath)}`);
        }
    }
}

optimizeImages('./assets/img');
```

**Запуск:**
```bash
node optimize-images.js
```

---

## 📋 Скрипт для проверки изображений

**Создайте файл `check-images.sh`:**
```bash
#!/bin/bash

echo "=== Проверка изображений ==="
echo ""

# 1. Изображения без alt
echo "1. Изображения без alt-тегов:"
grep -r "<img" . --include="*.php" | grep -v "alt=" | wc -l
echo ""

# 2. Изображения без width/height
echo "2. Изображения без width/height:"
grep -r "<img" . --include="*.php" | grep -v "width=" | wc -l
echo ""

# 3. Изображения без loading
echo "3. Изображения без loading:"
grep -r "<img" . --include="*.php" | grep -v "loading=" | wc -l
echo ""

# 4. Размеры изображений
echo "4. Размеры изображений (топ 10 самых больших):"
find ./assets/img -type f \( -name "*.jpg" -o -name "*.png" -o -name "*.webp" \) -exec du -h {} \; | sort -rh | head -10
echo ""

# 5. Общий размер всех изображений
echo "5. Общий размер изображений:"
du -sh ./assets/img
echo ""

# 6. Количество изображений по типу
echo "6. Количество изображений по типу:"
echo "JPG: $(find ./assets/img -name "*.jpg" | wc -l)"
echo "PNG: $(find ./assets/img -name "*.png" | wc -l)"
echo "WebP: $(find ./assets/img -name "*.webp" | wc -l)"
echo "SVG: $(find ./assets/img -name "*.svg" | wc -l)"
echo ""

echo "=== Проверка завершена ==="
```

**Запуск:**
```bash
chmod +x check-images.sh
./check-images.sh
```

---

## 🎯 План действий

### Немедленно (сегодня):

1. **Проверить все alt-теги:**
```bash
grep -r "<img" . --include="*.php" | grep -v "alt="
```

2. **Добавить alt-теги где их нет**

3. **Добавить width/height ко всем изображениям**

### На этой неделе:

1. **Конвертировать все изображения в WebP:**
```bash
cd /Users/victor/Documents/novacreative/novacreator-studio/assets/img
find . -name "*.jpg" -exec sh -c 'cwebp -q 80 "$1" -o "${1%.jpg}.webp"' _ {} \;
```

2. **Обновить HTML использовать picture с fallback:**
```html
<picture>
    <source srcset="image.webp" type="image/webp">
    <img src="image.jpg" alt="Описание" width="800" height="600">
</picture>
```

3. **Добавить lazy loading для изображений ниже fold:**
```html
loading="lazy"
```

### В этом месяце:

1. **Оптимизировать размеры изображений** (создать несколько версий для разных экранов)

2. **Настроить автоматическую оптимизацию** (sharp + build script)

3. **Проверить Core Web Vitals** в PageSpeed Insights

4. **Добавить CDN** (Cloudflare) для быстрой доставки изображений

---

## 📊 Метрики успеха

**До оптимизации:**
- [ ] Средний размер страницы: ___ MB
- [ ] LCP (Largest Contentful Paint): ___ s
- [ ] CLS (Cumulative Layout Shift): ___
- [ ] PageSpeed Insights Score: ___

**После оптимизации (цели):**
- [ ] Средний размер страницы: < 1 MB
- [ ] LCP: < 2.5s
- [ ] CLS: < 0.1
- [ ] PageSpeed Insights Score: > 90

**Проверка:**
```
https://pagespeed.web.dev/?url=https://novacreatorstudio.com
```

---

## 🔗 Полезные ссылки

- Google Image SEO: https://developers.google.com/search/docs/appearance/google-images
- WebP Documentation: https://developers.google.com/speed/webp
- Core Web Vitals: https://web.dev/vitals/
- Lazy Loading: https://web.dev/lazy-loading-images/
- Responsive Images: https://web.dev/responsive-images/

---

**Удачи с оптимизацией изображений! 🚀**

