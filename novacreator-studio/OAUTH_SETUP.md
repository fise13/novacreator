# Настройка OAuth авторизации (Google и Apple)

## Обзор

Система поддерживает авторизацию через Google и Apple OAuth. Пользователи могут регистрироваться и входить на сайт используя свои аккаунты Google или Apple.

## Улучшения безопасности

### Шифрование паролей

Система использует улучшенное шифрование паролей:
- **Argon2id** - лучший алгоритм хеширования (если доступен в PHP 7.2+)
- **bcrypt** - fallback для старых версий PHP
- Автоматическое обновление старых хешей на более безопасные

### Параметры Argon2id:
- Memory cost: 64 MB
- Time cost: 4 итерации
- Threads: 3 потока

### Параметры bcrypt:
- Cost: 12 (увеличен для лучшей безопасности)

## Настройка Google OAuth

### 1. Создайте проект в Google Cloud Console

1. Перейдите на [Google Cloud Console](https://console.cloud.google.com/)
2. Создайте новый проект или выберите существующий
3. Включите Google+ API

### 2. Создайте OAuth 2.0 Client ID

1. Перейдите в "APIs & Services" > "Credentials"
2. Нажмите "Create Credentials" > "OAuth client ID"
3. Выберите "Web application"
4. Добавьте Authorized redirect URIs:
   ```
   https://yourdomain.com/oauth/google/callback.php
   ```
5. Сохраните Client ID и Client Secret

### 3. Настройте конфигурацию

Создайте файл `includes/oauth_config.local.php`:

```php
<?php
function getGoogleOAuthConfigLocal(): array
{
    return [
        'client_id' => 'YOUR_GOOGLE_CLIENT_ID.apps.googleusercontent.com',
        'client_secret' => 'YOUR_GOOGLE_CLIENT_SECRET',
        'redirect_uri' => getOAuthBaseUrl() . '/oauth/google/callback.php',
        'auth_url' => 'https://accounts.google.com/o/oauth2/v2/auth',
        'token_url' => 'https://oauth2.googleapis.com/token',
        'userinfo_url' => 'https://www.googleapis.com/oauth2/v2/userinfo',
    ];
}
```

Или используйте переменные окружения:
```bash
export GOOGLE_CLIENT_ID="your_client_id"
export GOOGLE_CLIENT_SECRET="your_client_secret"
```

## Настройка Apple OAuth

### 1. Создайте App ID в Apple Developer

1. Перейдите на [Apple Developer Portal](https://developer.apple.com/)
2. Создайте новый App ID
3. Включите "Sign in with Apple"

### 2. Создайте Service ID

1. В разделе "Identifiers" создайте новый Service ID
2. Включите "Sign in with Apple"
3. Добавьте домен и redirect URI:
   ```
   https://yourdomain.com/oauth/apple/callback.php
   ```

### 3. Создайте Key для Sign in with Apple

1. В разделе "Keys" создайте новый ключ
2. Включите "Sign in with Apple"
3. Скачайте приватный ключ (.p8 файл)
4. Сохраните Key ID и Team ID

### 4. Настройте конфигурацию

Создайте файл `includes/oauth_config.local.php` (или добавьте к существующему):

```php
<?php
function getAppleOAuthConfigLocal(): array
{
    return [
        'client_id' => 'YOUR_APPLE_SERVICE_ID',
        'team_id' => 'YOUR_APPLE_TEAM_ID',
        'key_id' => 'YOUR_APPLE_KEY_ID',
        'private_key_path' => __DIR__ . '/../data/apple_private_key.p8',
        'redirect_uri' => getOAuthBaseUrl() . '/oauth/apple/callback.php',
        'auth_url' => 'https://appleid.apple.com/auth/authorize',
        'token_url' => 'https://appleid.apple.com/auth/token',
    ];
}
```

**ВАЖНО:** Сохраните приватный ключ (.p8) в безопасном месте, например:
```
data/apple_private_key.p8
```

Убедитесь, что файл недоступен через веб-сервер (добавьте в .htaccess или настройте веб-сервер).

Или используйте переменные окружения:
```bash
export APPLE_CLIENT_ID="your_service_id"
export APPLE_TEAM_ID="your_team_id"
export APPLE_KEY_ID="your_key_id"
export APPLE_PRIVATE_KEY_PATH="/path/to/private_key.p8"
```

## Структура базы данных

Система автоматически добавляет следующие поля в таблицу `users`:
- `oauth_provider` - провайдер OAuth ('google' или 'apple')
- `oauth_id` - уникальный ID пользователя от провайдера
- `avatar_url` - URL аватара пользователя (для Google)

## Безопасность

### CSRF защита
- Используется state параметр для защиты от CSRF атак
- State генерируется случайным образом и проверяется при callback

### Хранение данных
- OAuth токены не сохраняются в базе данных
- Сохраняются только OAuth ID и провайдер
- Пароли для OAuth пользователей не требуются

### Обновление хешей
- Система автоматически обновляет старые хеши паролей на более безопасные
- При входе проверяется, нуждается ли хеш в обновлении

## Тестирование

1. Убедитесь, что OAuth настроен:
   - Проверьте, что кнопки OAuth отображаются на страницах входа/регистрации
   - Если кнопки не видны, проверьте конфигурацию

2. Протестируйте авторизацию:
   - Нажмите на кнопку "Продолжить с Google" или "Продолжить с Apple"
   - Пройдите процесс авторизации
   - Убедитесь, что вы перенаправлены на dashboard

## Устранение неполадок

### Кнопки OAuth не отображаются
- Проверьте, что конфигурация заполнена правильно
- Убедитесь, что функция `isOAuthEnabled()` возвращает `true`

### Ошибка "OAuth не настроен"
- Проверьте, что все необходимые credentials заполнены
- Для Google: `client_id` и `client_secret`
- Для Apple: `client_id`, `team_id`, `key_id` и путь к приватному ключу

### Ошибка при callback
- Проверьте, что redirect URI совпадает с настройками в провайдере
- Убедитесь, что домен правильно настроен
- Проверьте логи сервера для деталей ошибки

## Дополнительные ресурсы

- [Google OAuth 2.0 Documentation](https://developers.google.com/identity/protocols/oauth2)
- [Apple Sign in Documentation](https://developer.apple.com/sign-in-with-apple/)

