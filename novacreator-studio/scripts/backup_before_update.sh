#!/bin/bash
# Автоматический бэкап перед обновлением через Git
# Использование: ./scripts/backup_before_update.sh

SCRIPT_DIR="$(cd "$(dirname "${BASH_SOURCE[0]}")" && pwd)"
PROJECT_DIR="$(dirname "$SCRIPT_DIR")"
DATA_DIR="$PROJECT_DIR/data"
BACKUP_DIR="$DATA_DIR/backups"
TIMESTAMP=$(date +%Y%m%d_%H%M%S)

echo "🔄 Создание резервных копий перед обновлением..."
echo ""

# Создаем директорию для бэкапов
mkdir -p "$BACKUP_DIR"

# Бэкап базы данных
if [ -f "$DATA_DIR/app.db" ]; then
    BACKUP_DB="$BACKUP_DIR/app.db.backup.$TIMESTAMP"
    cp "$DATA_DIR/app.db" "$BACKUP_DB"
    if [ $? -eq 0 ]; then
        echo "✅ База данных сохранена: $(basename "$BACKUP_DB")"
        
        # Создаем ссылку на последний бэкап
        ln -sf "$(basename "$BACKUP_DB")" "$BACKUP_DIR/app.db.latest"
    else
        echo "❌ Ошибка при создании бэкапа базы данных"
        exit 1
    fi
else
    echo "⚠️  База данных не найдена: $DATA_DIR/app.db"
fi

# Бэкап OAuth конфигурации
if [ -f "$DATA_DIR/app.db" ]; then
    BACKUP_OAUTH="$BACKUP_DIR/oauth_config_backup.$TIMESTAMP.json"
    php "$SCRIPT_DIR/export_oauth_config.php" > "$BACKUP_OAUTH" 2>/dev/null
    if [ $? -eq 0 ] && [ -s "$BACKUP_OAUTH" ]; then
        echo "✅ OAuth конфигурация сохранена: $(basename "$BACKUP_OAUTH")"
        
        # Создаем ссылку на последний бэкап
        ln -sf "$(basename "$BACKUP_OAUTH")" "$BACKUP_DIR/oauth_config.latest.json"
    else
        echo "⚠️  Не удалось создать бэкап OAuth конфигурации"
    fi
fi

echo ""
echo "✅ Резервное копирование завершено!"
echo "📁 Бэкапы сохранены в: $BACKUP_DIR"
echo ""
echo "Теперь можно безопасно выполнить: git pull"

