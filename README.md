# NovaCreator Studio

Современный сайт digital-агентства с темной темой и неоновыми акцентами.

## Технологии

- **Frontend**: HTML, TailwindCSS, кастомный CSS, нативный JavaScript
- **Backend**: Чистый PHP (без фреймворков)
- **Анимации**: JavaScript + Tailwind transitions

## Структура проекта

```
novacreative/
├── novacreator-studio/    # Основная папка сайта (загружается на хостинг)
│   ├── assets/
│   │   ├── css/
│   │   │   ├── input.css      # Входной файл для Tailwind
│   │   │   └── output.css     # Скомпилированный CSS (генерируется)
│   │   ├── js/
│   │   │   └── main.js        # Основной JavaScript файл
│   │   └── img/               # Изображения
│   ├── backend/
│   │   ├── send.php           # Обработчик форм
│   │   └── requests.txt       # Файл для сохранения заявок (создается автоматически)
│   ├── includes/
│   │   ├── header.php         # Общий header
│   │   ├── footer.php         # Общий footer
│   │   ├── breadcrumbs.php    # Breadcrumbs для SEO
│   │   └── seo_meta.php       # SEO мета-теги
│   ├── telegram_bot/
│   │   ├── config.php         # Конфигурация бота (не в Git)
│   │   ├── config.example.php # Пример конфигурации
│   │   └── send_telegram.php  # Функции отправки в Telegram
│   ├── index.php              # Главная страница
│   ├── services.php           # Страница услуг
│   ├── seo.php                # Страница SEO
│   ├── ads.php                # Страница Google Ads
│   ├── portfolio.php          # Портфолио
│   ├── about.php              # О компании
│   ├── contact.php            # Контакты
│   ├── vacancies.php          # Вакансии
│   ├── 404.php                 # Страница 404
│   ├── 500.php                 # Страница 500
│   ├── tailwind.config.js     # Конфигурация Tailwind
│   ├── package.json           # Зависимости проекта
│   ├── robots.txt             # Robots.txt для SEO
│   ├── sitemap.xml            # Карта сайта
│   └── .htaccess              # Настройки Apache
├── README.md                  # Этот файл
├── QUICKSTART.md              # Быстрый старт
└── SEO_CHECKLIST.md           # SEO чеклист
```

## Установка и настройка

### 1. Установка зависимостей

```bash
npm install
```

### 2. Компиляция CSS

Перейдите в папку сайта:
```bash
cd novacreator-studio
```

Для разработки (с автоматической перекомпиляцией):
```bash
npm run build-css
```

Для продакшена (минифицированная версия):
```bash
npm run build-css-prod
```

### 3. Настройка сервера

Для локальной разработки можно использовать встроенный PHP сервер:

```bash
cd novacreator-studio
php -S localhost:8000
```

Или настройте виртуальный хост в Apache/Nginx, указав корневую папку `novacreator-studio`.

### 4. Настройка email в backend/send.php

Откройте файл `backend/send.php` и измените переменную `$emailTo` на ваш email:

```php
$emailTo = 'your-email@example.com'; // Замените на ваш email
```

**Важно**: Для работы функции `mail()` на сервере должна быть настроена почта. 
В продакшене рекомендуется использовать PHPMailer или другой почтовый сервис.

## Особенности

### Дизайн
- Темная тема с неоновыми акцентами (фиолетовый/голубой)
- Минималистичный стиль
- Крупная типографика
- Много пустого пространства
- Плавные анимации

### Адаптивность
- Полностью адаптивный дизайн
- Оптимизирован для мобильных, планшетов и десктопов
- Мобильное меню

### Анимации
- Плавное появление элементов при скролле
- Анимация счетчиков
- Hover эффекты
- Плавные переходы

### Формы
- Валидация на клиенте и сервере
- Отправка через Fetch API
- Сохранение в файл `/backend/requests.txt`
- Отправка на email (если настроено)
- JSON ответы

## Использование

1. Откройте сайт в браузере
2. Заполните форму на странице контактов
3. Заявки сохраняются в `backend/requests.txt`
4. Если настроен email, заявки также отправляются на почту

## Разработка

### Добавление новых страниц

1. Создайте новый PHP файл в корне проекта
2. Используйте `includes/header.php` и `includes/footer.php`
3. Установите переменную `$pageTitle` перед подключением header

Пример:
```php
<?php
$pageTitle = 'Новая страница';
include 'includes/header.php';
?>

<!-- Ваш контент -->

<?php include 'includes/footer.php'; ?>
```

### Кастомизация цветов

Цвета настраиваются в `tailwind.config.js`:

```javascript
colors: {
  neon: {
    purple: '#8B5CF6',
    blue: '#06B6D4',
  },
  dark: {
    bg: '#0A0A0F',
    surface: '#111118',
    border: '#1F1F2E',
  }
}
```

### Добавление анимаций

Элементы с классом `animate-on-scroll` автоматически анимируются при появлении в viewport.

## Безопасность

- Валидация всех входных данных на сервере
- Защита от XSS
- Санитизация данных перед сохранением
- Рекомендуется добавить CSRF защиту для продакшена

## Лицензия

Проект создан для NovaCreator Studio.

## Поддержка

По вопросам обращайтесь на info@novacreator-studio.com

