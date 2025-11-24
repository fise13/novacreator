# Исправления для отправки заявок в Telegram

## ⚠️ ВАЖНО: Проверьте наличие файла config.php на сервере!

Если вы видите ошибку "Конфигурация Telegram не загружена", это означает, что файл `config.php` не найден или не может быть загружен.

### Проверка на сервере:

1. **Убедитесь, что файл существует:**
   ```bash
   ls -la /var/www/vhosts/novacreatorstudio.com/novacreator-studio/telegram_bot/config.php
   ```

2. **Если файл не существует, создайте его:**
   ```bash
   # Скопируйте с примера
   cp /var/www/vhosts/novacreatorstudio.com/novacreator-studio/telegram_bot/config.example.php \
      /var/www/vhosts/novacreatorstudio.com/novacreator-studio/telegram_bot/config.php
   
   # Или загрузите файл с локального компьютера
   ```

3. **Проверьте права доступа:**
   ```bash
   chmod 644 /var/www/vhosts/novacreatorstudio.com/novacreator-studio/telegram_bot/config.php
   ```

4. **Проверьте содержимое файла:**
   ```bash
   cat /var/www/vhosts/novacreatorstudio.com/novacreator-studio/telegram_bot/config.php
   ```
   
   Файл должен содержать:
   ```php
   define('TELEGRAM_BOT_TOKEN', 'ваш_токен');
   define('TELEGRAM_CHAT_ID', 'ваш_chat_id');
   define('TELEGRAM_ENABLED', true);
   ```

### После исправления:

После того как файл будет загружен на сервер, отправьте тестовую заявку и проверьте логи. В логах должно появиться сообщение:
```
✅ Файл config.php загружен из директории send_telegram.php: /путь/к/файлу
```

## Что было исправлено:

1. **Улучшена загрузка функций Telegram** в `backend/send.php`:
   - Добавлена функция `findTelegramFile()` для поиска файлов по множеству возможных путей
   - Проверяется несколько вариантов путей (относительные, абсолютные, через DOCUMENT_ROOT и т.д.)
   - Добавлена проверка всех необходимых функций (`formatContactMessage`, `formatVacancyMessage`, `sendTelegramMessage`)
   - Улучшена обработка ошибок при загрузке файлов
   - Добавлен fallback для `formatVacancyMessage` если функция недоступна
   - Детальное логирование всех проверенных путей для диагностики

2. **Улучшено логирование ошибок**:
   - Детальное логирование в `backend/telegram_errors.log`
   - Логирование всех проверок конфигурации
   - Информация о путях к файлам и их существовании

3. **Исправлена обработка ошибок** в `telegram_bot/send_telegram.php`:
   - Добавлена обработка ошибок PHP (Error)
   - Улучшена обработка ошибок Telegram API

## Как проверить работу:

### 1. Проверьте конфигурацию:
```bash
php telegram_bot/test_send.php
```

### 2. Проверьте логи ошибок:
```bash
cat backend/telegram_errors.log
```

### 3. Отправьте тестовую заявку:
- Откройте страницу контактов
- Заполните форму "Отправить заявку"
- Проверьте группу в Telegram

## Возможные проблемы:

1. **Бот не добавлен в группу**:
   - Убедитесь, что бот добавлен в группу как участник
   - Проверьте Chat ID группы (должен начинаться с минуса: `-100...`)

2. **Неправильный Chat ID**:
   - Для групп Chat ID должен быть отрицательным числом
   - Используйте `telegram_bot/get_chat_id.php` для получения правильного ID

3. **Бот не может отправлять сообщения**:
   - Убедитесь, что бот имеет права на отправку сообщений в группу
   - Проверьте настройки группы (некоторые группы ограничивают отправку сообщений)

4. **Проверьте логи**:
   - Все ошибки логируются в `backend/telegram_errors.log`
   - Проверьте файл на наличие ошибок

## Файлы, которые были изменены:

- `backend/send.php` - улучшена загрузка и обработка Telegram функций
- `telegram_bot/send_telegram.php` - улучшена обработка ошибок

## Следующие шаги:

1. Протестируйте отправку заявки через форму на сайте
2. Проверьте логи в `backend/telegram_errors.log`
3. Если есть ошибки, проверьте конфигурацию в `telegram_bot/config.php`

