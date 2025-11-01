# Тестовое задание компании secunda 
[автор работы](https://github.com/ExFuseMe)


## Развёртка проекта
1Создать файл окружения .env в корне проекта на основе .env.example, прописать параметры в .env
   ```commandline
   cp .env.example .env
   ```
2. Собрать build и запустить
    ```commandline
    docker-compose up -d --build
    ```
3. Установить зависимости composer
    ```commandline
    docker-compose exec php-fpm composer install
    ```
4. Сгенерировать ключ приложения
    ```commandline
    docker-compose exec php-fpm php artisan key:generate
    ```
5. Необходимо установить права на папки и перезапустить контейнеры:
    ```commandline
    sudo chmod -R 777 docker/logs
    ```

