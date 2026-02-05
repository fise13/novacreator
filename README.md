## NovaCreative / NovaCreator Studio

Это репозиторий маркетингового агентства с основным PHP‑проектом `novacreator-studio` — одностраничным/многостраничным сайтом студии с SEO‑оптимизацией, калькулятором услуг, блогом, страницами услуг и системой аутентификации.

### Структура репозитория

- **`novacreator-studio/`** — основной веб‑проект.
  - `index.php` — главная страница.
  - `services.php`, `seo.php`, `ads.php`, `landing-page-development.php`, `ecommerce-development.php`, `corporate-website-development.php` — страницы услуг.
  - `about.php`, `contact.php`, `faq.php`, `blog.php`, `vacancies.php` — информационные страницы.
  - `calculator.php` — калькулятор стоимости услуг (SEO, разработка, реклама) с динамическим расчетом и переключением валют (KZT/RUB/USD).
  - `portfolio.php`, `demo/` — демо/портфолио проектов.
  - `login.php`, `register.php`, `dashboard.php`, `admin/`, `adm/` — аутентификация и административные панели.
  - `includes/` — общие include‑файлы:
    - `header.php`, `footer.php` — общий layout, подключение стилей/скриптов.
    - `db.php` — подключение к БД.
    - `auth.php`, `user_service.php` — логика аутентификации/пользователей.
    - `seo_meta.php`, `enhanced_schema.php`, `internal_linking.php`, `social_sharing.php` — SEO и разметка.
    - `bot_detection.php`, `csrf.php`, `email_verification.php` — безопасность.
    - `i18n.php`, `lang/*.json` — мультиязычность (RU/EN).
    - `partials/` — переиспользуемые UI‑компоненты (hero‑блок, заголовки секций, карточки услуг и т.д.).
  - `assets/` — статические ресурсы:
    - `css/input.css`, `minimal-hover.css` — Tailwind и доп. стили.
    - `js/*.js` — анимации, бургер‑меню, скелетоны, 3D‑портфолио и т.п.
    - `img/`, `favicon*/`, `manifest.json`, `sitemap.xml`, `robots.txt` — иконки, PWA, sitemap и robots.
  - `backend/` — вспомогательные скрипты (например, отправка в Telegram).
  - `oauth/`, `includes/oauth_config*.php`, `scripts/install_oauth_from_env.php` — OAuth‑интеграции (Google, Apple).
  - `tailwind.config.js`, `package.json`, `package-lock.json` — фронтенд‑сборка.
- **`novacreative/REFACTORING_PLAN.md`** — план рефакторинга структуры страниц и компонентов.

### Назначение проекта

- **Маркетинговый сайт/лендинг студии**, ориентированный на:
  - продажу услуг SEO, разработки сайтов и контекстной рекламы;
  - демонстрацию кейсов и демо‑проектов;
  - генерацию лидов через формы, калькулятор и контактную страницу.
- **Фокус на SEO и производительности**:
  - расширенная Schema.org‑разметка;
  - sitemap, robots, локальное SEO;
  - оптимизированные изображения и Tailwind‑базовый дизайн.
- **Планируется дальнейшее развитие** в сторону:
  - портфолио с фильтрами;
  - личного кабинета клиента и отчетности;
  - более богатого блога и контент‑маркетинга (см. `novacreator-studio/IMPROVEMENTS.md`).

### Технологии и стек

- **Backend**: PHP 7+/8, без фреймворка (классическая `include`‑структура).
- **Frontend**: Tailwind CSS (через `input.css` + `tailwind.config.js`), нативный JS (`assets/js/*.js`).
- **Хранение данных**: классический PHP/MySQL (подключение через `includes/db.php`), формы + возможная отправка заявок в Telegram/почту.
- **SEO/разметка**:
  - отдельные include‑файлы для meta‑тегов, Open Graph, Schema.org;
  - breadcrumbs, RSS, sitemap, robots.
- **Аутентификация и админка**:
  - простая авторизация/регистрация (`login.php`, `register.php`);
  - административные разделы `admin/` и `adm/` для управления контентом.

### Основные фичи

- **Калькулятор стоимости** (`calculator.php`):
  - SEO / разработка / реклама как типы услуг;
  - динамический расчет цены по параметрам (тип сайта, регион, конкуренция, страницы и т.д.);
  - подсказки по нишам и похожим кейсам;
  - отображение цены в KZT, RUB и USD с переключателем валют.
- **Мультиязычность**:
  - текущие языки: RU, EN;
  - переводы хранятся в `lang/en.json` и `lang/ru.json`, логика — в `includes/i18n.php`.
- **SEO‑готовый каркас**:
  - meta‑теги, OG, Twitter, breadcrumbs, структурированная разметка;
  - карта сайта, RSS, robots.
- **Демо‑проекты**:
  - несколько демонстрационных лендингов/сайтов в `demo/` для разных ниш.

### Локальный запуск

1. **Клонировать репозиторий** в директорию веб‑сервера:
   ```bash
   git clone <repo-url> novacreative
   cd novacreative/novacreator-studio
   ```
2. **Настроить виртуальный хост** (Apache/Nginx), корень — `novacreator-studio/`.
3. **Настроить PHP и БД**:
   - создать `.env` или config (если используется) и указать параметры БД;
   - проверить `includes/db.php` на соответствие локальным настройкам.
4. **Установить фронтенд‑зависимости (опционально)**:
   ```bash
   npm install
   # при необходимости собрать стили
   npx tailwindcss -i ./assets/css/input.css -o ./assets/css/output.css --minify
   ```
5. Открыть сайт в браузере по настроенному домену/`http://localhost`.

### Продакшн‑деплой

- Разворачивается как обычный PHP‑сайт на Apache/Nginx.
- Обязательно:
  - включить сжатие (Gzip/Brotli);
  - включить HTTP/2;
  - настроить HTTPS и редиректы (см. `.htaccess`).

### Файлы для чтения в первую очередь (для разработчика)

- `novacreator-studio/index.php` — структура главной.
- `novacreator-studio/includes/header.php` / `footer.php` — общий layout, подключение скриптов.
- `novacreator-studio/includes/partials/*.php` — как устроены переиспользуемые компоненты.
- `novacreator-studio/calculator.php` — пример «фичи» с бизнес‑логикой на фронте.
- `novacreator-studio/includes/seo_meta.php`, `enhanced_schema.php` — как реализовано SEO.
- `novacreator-studio/IMPROVEMENTS.md` и `novacreative/REFACTORING_PLAN.md` — куда проект планируется развивать.

### Ориентир для рефакторинга

- Привести страницы к компонентному подходу через `includes/partials/`.
- Унифицировать отступы, типографику и карточки (см. `REFACTORING_PLAN.md`).
- Постепенно выделять бизнес‑логику в отдельные сервисы/классы вместо россыпи include‑ов.

