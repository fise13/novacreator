# Компоненты частичных представлений (Partials)

Эта директория содержит переиспользуемые компоненты для страниц сайта.

## Доступные компоненты

### 1. hero-section.php
Hero-секция с заголовком, подзаголовком и CTA кнопками.

**Параметры:**
- `$heroTitle` (обязательный) - Заголовок H1
- `$heroSubtitle` (опционально) - Подзаголовок
- `$heroCtaButtons` (опционально) - Массив CTA кнопок
- `$heroWithParallax` (опционально, по умолчанию true) - Использовать parallax эффект
- `$heroScrollIndicator` (опционально, по умолчанию false) - Показывать индикатор прокрутки

**Пример использования:**
```php
$heroTitle = 'Заголовок';
$heroSubtitle = 'Подзаголовок';
$heroCtaButtons = [
    [
        'text' => 'Кнопка',
        'url' => '/link',
        'class' => 'my-class',
        'style' => 'color: red;'
    ]
];
include __DIR__ . '/includes/partials/hero-section.php';
```

### 2. section-header.php
Заголовок секции с опциональным подзаголовком.

**Параметры:**
- `$sectionTitle` (обязательный) - Заголовок H2
- `$sectionSubtitle` (опционально) - Подзаголовок
- `$sectionAlign` (опционально, по умолчанию 'left') - Выравнивание: 'left' или 'center'

**Пример использования:**
```php
$sectionTitle = 'Заголовок секции';
$sectionSubtitle = 'Описание';
include __DIR__ . '/includes/partials/section-header.php';
```

### 3. cta-section.php
CTA секция с заголовком, подзаголовком и кнопкой.

**Параметры:**
- `$ctaTitle` (обязательный) - Заголовок
- `$ctaSubtitle` (опционально) - Подзаголовок
- `$ctaButtonText` (обязательный) - Текст кнопки
- `$ctaButtonUrl` (обязательный) - URL кнопки
- `$ctaBgColor` (опционально, по умолчанию 'bg-lighter') - Цвет фона: 'bg' или 'bg-lighter'

**Пример использования:**
```php
$ctaTitle = 'Готовы начать?';
$ctaSubtitle = 'Свяжитесь с нами';
$ctaButtonText = 'Связаться';
$ctaButtonUrl = '/contact';
include __DIR__ . '/includes/partials/cta-section.php';
```

### 4. service-card.php
Карточка услуги с иконкой, заголовком, описанием и ссылкой.

**Параметры:**
- `$cardTitle` (обязательный) - Заголовок карточки
- `$cardDescription` (обязательный) - Описание
- `$cardIcon` (опционально) - SVG иконка
- `$cardLinkUrl` (опционально) - URL ссылки "Подробнее"
- `$cardLinkText` (опционально) - Текст ссылки (по умолчанию "Подробнее" или "Learn more")

**Пример использования:**
```php
$cardTitle = 'SEO оптимизация';
$cardDescription = 'Описание услуги';
$cardIcon = '<svg>...</svg>';
$cardLinkUrl = '/seo';
include __DIR__ . '/includes/partials/service-card.php';
```

### 5. content-section.php
Универсальная контентная секция.

**Параметры:**
- `$sectionBgColor` (опционально, по умолчанию 'bg') - Цвет фона: 'bg' или 'bg-lighter'
- `$sectionContent` (обязательный) - HTML контент секции

**Пример использования:**
```php
$sectionBgColor = 'bg-lighter';
$sectionContent = '<p>Контент секции</p>';
include __DIR__ . '/includes/partials/content-section.php';
```

## Единые стили

Все компоненты используют единые CSS переменные для цветов:
- `var(--color-bg)` - Основной фон
- `var(--color-bg-lighter)` - Светлый фон
- `var(--color-text)` - Основной текст
- `var(--color-text-secondary)` - Вторичный текст
- `var(--color-border)` - Цвет границы

Единые отступы между секциями:
- `py-16 md:py-20 lg:py-32` - Стандартные вертикальные отступы

