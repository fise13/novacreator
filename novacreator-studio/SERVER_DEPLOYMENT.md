# Инструкция по развертыванию на сервере

## Хранение OAuth конфигурации в базе данных

OAuth ключи теперь хранятся в базе данных в таблице `oauth_config`. Это гарантирует их наличие на сервере при первом запуске.

### Автоматическая настройка

При первом подключении к базе данных система автоматически:
1. Создаёт таблицу `oauth_config`, если её нет
2. Вставляет дефолтные значения для Google OAuth (если их нет)
3. Создаёт запись для Apple OAuth (пустую, для будущего использования)

### Приоритет загрузки конфигурации

Система загружает OAuth конфигурацию в следующем порядке:
1. **Переменные окружения** (наивысший приоритет)
2. **База данных** (гарантированно есть на сервере)
3. Файлы конфигурации (устаревший метод, не используется)

### Настройка через переменные окружения (опционально)

Если хотите использовать переменные окружения вместо БД:

#### Для Apache (.htaccess)
```apache
SetEnv GOOGLE_CLIENT_ID "YOUR_CLIENT_ID_HERE"
SetEnv GOOGLE_CLIENT_SECRET "YOUR_CLIENT_SECRET_HERE"
```

#### Для Nginx
```nginx
fastcgi_param GOOGLE_CLIENT_ID "YOUR_CLIENT_ID_HERE";
fastcgi_param GOOGLE_CLIENT_SECRET "YOUR_CLIENT_SECRET_HERE";
```

#### Для PHP-FPM
```ini
env[GOOGLE_CLIENT_ID] = YOUR_CLIENT_ID_HERE
env[GOOGLE_CLIENT_SECRET] = YOUR_CLIENT_SECRET_HERE
```

**ВАЖНО:** После развертывания на сервере установите переменные окружения с реальными значениями, или обновите БД через функцию `saveOAuthConfigToDb()`.

### Обновление конфигурации в БД

Вы можете обновить OAuth конфигурацию программно:

```php
require_once __DIR__ . '/includes/oauth_config.php';

// Обновить Google OAuth
saveOAuthConfigToDb('google', [
    'client_id' => 'your_new_client_id',
    'client_secret' => 'your_new_client_secret',
    'auth_url' => 'https://accounts.google.com/o/oauth2/v2/auth',
    'token_url' => 'https://oauth2.googleapis.com/token',
    'userinfo_url' => 'https://www.googleapis.com/oauth2/v2/userinfo',
]);
```

### Структура таблицы oauth_config

```sql
CREATE TABLE oauth_config (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    provider TEXT NOT NULL UNIQUE,  -- 'google' или 'apple'
    client_id TEXT,
    client_secret TEXT,
    team_id TEXT,                   -- для Apple
    key_id TEXT,                    -- для Apple
    private_key_path TEXT,          -- для Apple
    redirect_uri TEXT,
    auth_url TEXT,
    token_url TEXT,
    userinfo_url TEXT,
    created_at TEXT NOT NULL,
    updated_at TEXT NOT NULL
);
```

### Проверка работы

После развертывания проверьте:
1. База данных создана: `data/app.db`
2. Таблица `oauth_config` существует и содержит записи
3. Кнопки OAuth отображаются на страницах входа/регистрации
4. Авторизация через Google работает корректно
5. Пользователи могут регистрироваться и входить через OAuth

### Преимущества хранения в БД

✅ Гарантированное наличие на сервере (автоматическая миграция)  
✅ Легко обновлять через код  
✅ Не нужно беспокоиться о файлах конфигурации  
✅ Можно добавить админ-панель для управления  
✅ Безопаснее, чем файлы в git

