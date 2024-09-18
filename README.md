## Подготовка к запуску проекта
1. Для работы с GoogleSheets испозовалась библиотека google/apiclient:^2.0 <br> Для ее работы необходимо создать сервисный аккаунт и получить код доступа API.<br> Подробнее можно ознакомиться здесь https://codd-wd.ru/instrukciya-po-polucheniyu-klyucha-servisnogo-akkaunta-google-dlya-raboty-s-sheets-api/
2. После создания аккаунта необходимо скаченный json помести в папку проекта app/Services/Google/assets/ и прописать путь к этому файлу в .env<br> Пример GOOGLE_APPLICATION_CREDENTIALS='./app/Services/Google/assets/example.json'
3. Открываем доступ к таблице для email адреса сервисного аккаунта:<img src=https://codd-wd.ru/wp-content/uploads/2018/04/primery-google-sheets-tablicy-api-php-1.png>
4. Копируем id нашей таблицы и добавляем в .env <br><img src=https://codd-wd.ru/wp-content/uploads/2018/04/primery-google-sheets-tablicy-api-php-5.png> Пример GOOGLE_LIST_ID='your-spreadsheetId'
5. Настраиваем аккаунт для отправки писем и добавляем данные в файл .env

## Запуск проекта

1. Поднимаем контейнеры: <b>docker compose run web -d</b>
2. Открываем второй терминал и запускаем consumer: <b>&nbsp;docker&nbsp;compose run artisan queue:work</b>
3. Открываем третий терминал и запускаем основной скрипт: <b>docker&nbsp;compose&nbsp;exec&nbsp;php-fpm&nbsp;bash<br> php artisan schedule:work</b><br>Скрипт срабатывает каждые 5 минут, по желанию можно изменить в файле <b>routes/console.php</b> (не рекомендуется ставить меньше 5 минут)

