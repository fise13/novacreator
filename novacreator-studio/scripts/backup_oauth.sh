#!/bin/bash
# Скрипт для резервного копирования OAuth конфигурации

SCRIPT_DIR="$(cd "$(dirname "${BASH_SOURCE[0]}")" && pwd)"
PROJECT_DIR="$(dirname "$SCRIPT_DIR")"
BACKUP_DIR="$PROJECT_DIR/data/backups"
BACKUP_FILE="$BACKUP_DIR/oauth_config_$(date +%Y%m%d_%H%M%S).json"

# Создаем директорию для бэкапов, если её нет
mkdir -p "$BACKUP_DIR"

# Экспортируем OAuth конфигурацию
php "$SCRIPT_DIR/export_oauth_config.php" > "$BACKUP_FILE"

if [ $? -eq 0 ]; then
    echo "✓ OAuth конфигурация сохранена в: $BACKUP_FILE"
    
    # Сохраняем последний бэкап как latest
    ln -sf "$(basename "$BACKUP_FILE")" "$BACKUP_DIR/oauth_config_latest.json"
    echo "✓ Создана ссылка на последний бэкап: oauth_config_latest.json"
else
    echo "✗ Ошибка при создании резервной копии"
    exit 1
fi

