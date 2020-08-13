Поднятие проекта <br>
Создать папку для проекта в нее склонировать проект с github <br>
Далее нужно создать файл docker-compose.yml и внести туда следующую конфигурацию : <br>
```version: "2"
 
 services:
   mysql:
     image: mysql:5.7
     ports:
       - 127.0.0.1:3307:3306
     environment:
       # Configuration here must match the settings of laravel
       - MYSQL_DATABASE=bigland
       - MYSQL_ROOT_PASSWORD=123
       - MYSQL_USER=test_user
       - MYSQL_PASSWORD=123
     volumes:
       - ./databases/mysql:/var/lib/mysql
       - ./logs/mysql:/var/log/mysql
   laravel:
     image: evilfreelancer/dockavel:latest
     restart: unless-stopped
     ports:
       - 127.0.0.1:81:80
     environment:
       - APP_NAME=Laravel
       - APP_ENV=local
       - APP_KEY=base64:/4Blo+Nf2aSsBWP6Qf8q26WcTrkjfcFzadtD9addj64=
       - APP_DEBUG=true
       - APP_URL=127.0.0.1
       - LOG_CHANNEL=stack
       - DB_CONNECTION=mysql
       - DB_HOST=mysql
       - DB_PORT=
       - DB_DATABASE=bigland
       - DB_USERNAME=test_user
       - DB_PASSWORD=123
       - BROADCAST_DRIVER=log
       - CACHE_DRIVER=file
       - SESSION_DRIVER=file
       - SESSION_LIFETIME=120
       - QUEUE_DRIVER=database
       - REDIS_HOST=127.0.0.1
       - REDIS_PASSWORD=null
       - REDIS_PORT=6379
       - MAIL_DRIVER=smtp
       - MAIL_HOST=smtp.mailtrap.io
       - MAIL_PORT=2525
       - MAIL_USERNAME=null
       - MAIL_PASSWORD=null
       - MAIL_ENCRYPTION=null
       - PUSHER_APP_ID=
       - PUSHER_APP_KEY=
       - PUSHER_APP_SECRET=
       - PUSHER_APP_CLUSTER=mt1
       - MIX_PUSHER_APP_KEY="${PUSHER_APP_KEY}"
       - MIX_PUSHER_APP_CLUSTER="${PUSHER_APP_CLUSTER}"
       - ITEMS_PER_PAGE=20
     volumes:
       - ./laravel/app:/app/app:cached
       - ./laravel/config:/app/config:cached
       - ./laravel/database:/app/database:cached
       - ./laravel/public:/app/public:cached
       - ./laravel/resources:/app/resources:cached
       - ./laravel/routes:/app/routes:cached
       # Required modules for system
       - ./laravel/vendor:/app/vendor:cached
       - ./laravel/node_modules:/app/node_modules:cached
       # Following folders must be writable in container for apache user
       # chown apache:apache -R storage/ bootstrap/
       - ./laravel/storage:/app/storage:cached
       - ./laravel/bootstrap:/app/bootstrap:cached
   phpmyadmin:
     image: phpmyadmin/phpmyadmin:latest
     links:
       - mysql:mysql
     restart: unless-stopped
     ports:
       - 127.0.0.1:8081:80
     environment:
         PMA_HOST: mysql
         PMA_USER: test_user
         PMA_PASSWORD: 123 
```
После в папке с проектом:<br>
в консоли: <br>
docker-compose pull<br>
docker-compose up -d<br>
После нужно зайти в контейнер с laravel и ввести команду "composer install", "php artisan migrate"

Примеры использования приложения: <br>
Web: <br>
В строке браузера ввести адрес http://127.0.0.1:81/plots, далее ввести строку с номерами в соответствии с требованиями <br>
Console: <br>
Зайти в контейнер с laravel, после ввести команду (Прим. php artisan plots:info "69:27:0000022:1306, 69:27:0000022:1307") <br>
Rest: <br>
C помощью какого либо http клиента нужно отправить GET запрос (Прим. http://127.0.0.1:81/api/plots?plots=69:27:0000022:1306, 69:27:0000022:1307)
