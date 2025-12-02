#!/bin/bash

# ===========================================
# SEO ПРОВЕРКА ДЛЯ NOVACREATOR STUDIO
# Скрипт для быстрой проверки SEO параметров
# ===========================================

echo "╔═══════════════════════════════════════════════════════════╗"
echo "║         SEO ПРОВЕРКА NOVACREATOR STUDIO                   ║"
echo "╚═══════════════════════════════════════════════════════════╝"
echo ""

# Цвета для вывода
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
BLUE='\033[0;34m'
NC='\033[0m' # No Color

# Функция для вывода успеха
success() {
    echo -e "${GREEN}✓${NC} $1"
}

# Функция для вывода ошибки
error() {
    echo -e "${RED}✗${NC} $1"
}

# Функция для вывода предупреждения
warning() {
    echo -e "${YELLOW}⚠${NC} $1"
}

# Функция для вывода информации
info() {
    echo -e "${BLUE}ℹ${NC} $1"
}

# ===========================================
# 1. ПРОВЕРКА ФАЙЛОВ
# ===========================================
echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━"
echo "1. ПРОВЕРКА НАЛИЧИЯ ФАЙЛОВ"
echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━"

# Проверяем наличие важных файлов
if [ -f "robots.txt" ]; then
    success "robots.txt найден"
else
    error "robots.txt отсутствует"
fi

if [ -f "sitemap.xml" ]; then
    success "sitemap.xml найден"
else
    warning "sitemap.xml отсутствует (но есть sitemap.php)"
fi

if [ -f "sitemap.php" ]; then
    success "sitemap.php найден (динамическая карта сайта)"
else
    error "sitemap.php отсутствует"
fi

if [ -f ".htaccess" ]; then
    success ".htaccess найден"
else
    error ".htaccess отсутствует"
fi

if [ -f "manifest.json" ]; then
    success "manifest.json найден"
else
    warning "manifest.json отсутствует"
fi

if [ -f ".well-known/security.txt" ]; then
    success "security.txt найден"
else
    warning "security.txt отсутствует"
fi

if [ -f "humans.txt" ]; then
    success "humans.txt найден"
else
    warning "humans.txt отсутствует"
fi

echo ""

# ===========================================
# 2. ПРОВЕРКА ИЗОБРАЖЕНИЙ
# ===========================================
echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━"
echo "2. ПРОВЕРКА ИЗОБРАЖЕНИЙ"
echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━"

# Изображения без alt
NO_ALT=$(grep -r "<img" . --include="*.php" 2>/dev/null | grep -v "alt=" | grep -v "node_modules" | grep -v "vendor" | wc -l | tr -d ' ')
if [ "$NO_ALT" -eq 0 ]; then
    success "Все изображения имеют alt-теги"
else
    error "Изображений без alt: $NO_ALT"
    grep -r "<img" . --include="*.php" 2>/dev/null | grep -v "alt=" | grep -v "node_modules" | grep -v "vendor" | head -3
fi

# Изображения без width/height
NO_SIZE=$(grep -r "<img" . --include="*.php" 2>/dev/null | grep -v "width=" | grep -v "node_modules" | grep -v "vendor" | wc -l | tr -d ' ')
if [ "$NO_SIZE" -eq 0 ]; then
    success "Все изображения имеют width/height"
else
    warning "Изображений без width/height: $NO_SIZE"
fi

# Изображения без loading
NO_LOADING=$(grep -r "<img" . --include="*.php" 2>/dev/null | grep -v "loading=" | grep -v "node_modules" | grep -v "vendor" | wc -l | tr -d ' ')
if [ "$NO_LOADING" -le 10 ]; then
    success "Большинство изображений имеют lazy loading"
else
    warning "Изображений без loading: $NO_LOADING"
fi

# Статистика по форматам
echo ""
info "Статистика по форматам изображений:"
JPG_COUNT=$(find ./assets/img -name "*.jpg" -o -name "*.jpeg" 2>/dev/null | wc -l | tr -d ' ')
PNG_COUNT=$(find ./assets/img -name "*.png" 2>/dev/null | wc -l | tr -d ' ')
WEBP_COUNT=$(find ./assets/img -name "*.webp" 2>/dev/null | wc -l | tr -d ' ')
SVG_COUNT=$(find ./assets/img -name "*.svg" 2>/dev/null | wc -l | tr -d ' ')

echo "  JPG/JPEG: $JPG_COUNT"
echo "  PNG: $PNG_COUNT"
echo "  WebP: $WEBP_COUNT"
echo "  SVG: $SVG_COUNT"

if [ "$WEBP_COUNT" -gt 0 ]; then
    success "WebP формат используется"
else
    warning "WebP формат не используется (рекомендуется конвертировать)"
fi

# Общий размер изображений
if [ -d "./assets/img" ]; then
    TOTAL_SIZE=$(du -sh ./assets/img 2>/dev/null | awk '{print $1}')
    info "Общий размер изображений: $TOTAL_SIZE"
fi

echo ""

# ===========================================
# 3. ПРОВЕРКА META ТЕГОВ
# ===========================================
echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━"
echo "3. ПРОВЕРКА META ТЕГОВ"
echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━"

# Проверяем наличие includes/seo_meta.php
if [ -f "includes/seo_meta.php" ]; then
    success "seo_meta.php найден"
    
    # Проверяем наличие Open Graph
    if grep -q "og:title" includes/seo_meta.php 2>/dev/null; then
        success "Open Graph теги настроены"
    else
        error "Open Graph теги отсутствуют"
    fi
    
    # Проверяем наличие Twitter Cards
    if grep -q "twitter:card" includes/seo_meta.php 2>/dev/null; then
        success "Twitter Cards настроены"
    else
        error "Twitter Cards отсутствуют"
    fi
    
    # Проверяем JSON-LD
    if grep -q "application/ld+json" includes/seo_meta.php 2>/dev/null; then
        success "JSON-LD структурированные данные настроены"
    else
        error "JSON-LD отсутствует"
    fi
    
    # Проверяем canonical
    if grep -q "rel=\"canonical\"" includes/seo_meta.php 2>/dev/null; then
        success "Canonical URLs настроены"
    else
        error "Canonical URLs отсутствуют"
    fi
    
    # Проверяем hreflang
    if grep -q "hreflang" includes/seo_meta.php 2>/dev/null; then
        success "Hreflang теги настроены"
    else
        error "Hreflang теги отсутствуют"
    fi
else
    error "includes/seo_meta.php не найден"
fi

echo ""

# ===========================================
# 4. ПРОВЕРКА СТРУКТУРЫ URL
# ===========================================
echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━"
echo "4. ПРОВЕРКА СТРУКТУРЫ URL"
echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━"

# Проверяем .htaccess на наличие правил ЧПУ
if grep -q "RewriteEngine On" .htaccess 2>/dev/null; then
    success ".htaccess настроен для ЧПУ"
else
    error "ЧПУ не настроены в .htaccess"
fi

# Проверяем HTTPS редирект
if grep -q "RewriteCond %{HTTPS} off" .htaccess 2>/dev/null; then
    success "HTTPS редирект настроен"
else
    warning "HTTPS редирект может быть не настроен"
fi

echo ""

# ===========================================
# 5. ПРОВЕРКА ПРОИЗВОДИТЕЛЬНОСТИ
# ===========================================
echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━"
echo "5. ПРОВЕРКА ПРОИЗВОДИТЕЛЬНОСТИ"
echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━"

# Проверяем наличие кеширования
if grep -q "mod_expires" .htaccess 2>/dev/null; then
    success "Кеширование браузера настроено"
else
    warning "Кеширование браузера не настроено"
fi

# Проверяем сжатие
if grep -q "mod_deflate" .htaccess 2>/dev/null; then
    success "Gzip сжатие настроено"
else
    warning "Gzip сжатие не настроено"
fi

# Проверяем минифицированные файлы
if [ -f "assets/js/main.min.js" ]; then
    success "Минифицированный JS найден"
else
    warning "Минифицированный JS отсутствует"
fi

if [ -f "assets/css/output.css" ]; then
    success "CSS файл найден"
else
    warning "CSS файл отсутствует"
fi

echo ""

# ===========================================
# 6. ПРОВЕРКА БЕЗОПАСНОСТИ
# ===========================================
echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━"
echo "6. ПРОВЕРКА БЕЗОПАСНОСТИ"
echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━"

# Проверяем Security Headers
if grep -q "X-Frame-Options" .htaccess 2>/dev/null; then
    success "Security Headers настроены"
else
    warning "Security Headers не настроены"
fi

# Проверяем HSTS
if grep -q "Strict-Transport-Security" .htaccess 2>/dev/null; then
    success "HSTS (HTTP Strict Transport Security) настроен"
else
    warning "HSTS не настроен"
fi

echo ""

# ===========================================
# 7. ПРОВЕРКА КОНТЕНТА
# ===========================================
echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━"
echo "7. ПРОВЕРКА КОНТЕНТА"
echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━"

# Подсчитываем страницы
PAGE_COUNT=$(find . -maxdepth 1 -name "*.php" ! -name "404.php" ! -name "500.php" 2>/dev/null | wc -l | tr -d ' ')
info "Количество основных страниц: $PAGE_COUNT"

# Подсчитываем статьи блога
if [ -f "data/blog.json" ]; then
    BLOG_COUNT=$(grep -o '"id"' data/blog.json 2>/dev/null | wc -l | tr -d ' ')
    info "Количество статей в блоге: $BLOG_COUNT"
    if [ "$BLOG_COUNT" -gt 0 ]; then
        success "Блог наполнен контентом"
    fi
fi

# Проверяем наличие i18n
if [ -d "lang" ]; then
    LANG_COUNT=$(ls lang/*.json 2>/dev/null | wc -l | tr -d ' ')
    info "Количество языков: $LANG_COUNT"
    if [ "$LANG_COUNT" -ge 2 ]; then
        success "Мультиязычность настроена"
    fi
fi

echo ""

# ===========================================
# 8. РЕЗЮМЕ
# ===========================================
echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━"
echo "8. РЕЗЮМЕ И РЕКОМЕНДАЦИИ"
echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━"

echo ""
info "Следующие шаги для улучшения SEO:"
echo ""
echo "1. 📝 Зарегистрируйте сайт в:"
echo "   • Google Search Console: https://search.google.com/search-console"
echo "   • Яндекс.Вебмастер: https://webmaster.yandex.ru"
echo ""
echo "2. 🗺️  Отправьте sitemap:"
echo "   • https://novacreatorstudio.com/sitemap.php"
echo ""
echo "3. 🏢 Создайте профили для локального SEO:"
echo "   • Google My Business: https://business.google.com"
echo "   • Яндекс.Справочник: https://sprav.yandex.ru"
echo ""
echo "4. 📊 Проверьте производительность:"
echo "   • PageSpeed Insights: https://pagespeed.web.dev/"
echo "   • Mobile-Friendly Test: https://search.google.com/test/mobile-friendly"
echo ""
echo "5. 🖼️  Оптимизируйте изображения:"
echo "   • Конвертируйте в WebP формат"
echo "   • Добавьте alt-теги везде"
echo "   • Используйте lazy loading"
echo ""
echo "6. 🔒 Улучшите безопасность:"
echo "   • Проверьте SSL: https://www.ssllabs.com/ssltest/"
echo "   • Проверьте заголовки: https://securityheaders.com/"
echo ""
echo "7. 📈 Настройте аналитику:"
echo "   • Google Analytics 4 (уже установлен)"
echo "   • Яндекс.Метрика (рекомендуется добавить)"
echo ""

echo "╔═══════════════════════════════════════════════════════════╗"
echo "║              ПРОВЕРКА ЗАВЕРШЕНА                           ║"
echo "╚═══════════════════════════════════════════════════════════╝"
echo ""
echo "Подробные инструкции см. в:"
echo "• SEO_OPTIMIZATION_GUIDE.md"
echo "• IMAGE_OPTIMIZATION_GUIDE.md"
echo ""

