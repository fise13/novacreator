# Скрипты для управления OAuth конфигурацией

## Экспорт OAuth конфигурации

Экспортирует OAuth конфигурацию (Google, Apple) из базы данных в JSON файл.

```bash
php scripts/export_oauth_config.php > oauth_config_backup.json
```

Или используйте автоматический скрипт:

```bash
chmod +x scripts/backup_oauth.sh
./scripts/backup_oauth.sh
```

Скрипт создаст файл с датой и временем в `data/backups/`.

## Импорт OAuth конфигурации

Импортирует OAuth конфигурацию из JSON файла в базу данных.

```bash
php scripts/import_oauth_config.php oauth_config_backup.json
```

## Когда использовать

### Перед обновлением через Git:

```bash
# 1. Экспортируйте OAuth конфигурацию
php scripts/export_oauth_config.php > data/backups/oauth_config_backup.json

# 2. Обновите код
git pull origin main

# 3. Если OAuth не работает, восстановите конфигурацию
php scripts/import_oauth_config.php data/backups/oauth_config_backup.json
```

### При переносе на новый сервер:

```bash
# На старом сервере: экспортируйте
php scripts/export_oauth_config.php > oauth_config_backup.json

# На новом сервере: импортируйте
php scripts/import_oauth_config.php oauth_config_backup.json
```

## Формат файла резервной копии

```json
{
    "exported_at": "2025-12-06T09:31:46+00:00",
    "version": "1.0",
    "configs": [
        {
            "provider": "google",
            "client_id": "...",
            "client_secret": "...",
            "auth_url": "...",
            "token_url": "...",
            "userinfo_url": "..."
        }
    ]
}
```

## Безопасность

⚠️ **ВАЖНО:** Файлы резервных копий содержат секретные ключи OAuth!

- ❌ **НЕ коммитьте** файлы `oauth_config*.json` в Git
- ✅ Файлы автоматически добавлены в `.gitignore`
- ✅ Храните бэкапы в безопасном месте
- ✅ Удаляйте старые бэкапы после успешного восстановления

