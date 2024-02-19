
1. **Путь:**

    ```bash
    cd docker
    ```

2. **Docker:**

    ```bash
    docker-compose up --build -d
    ```

3. **Налаштування для БД:**

    ```bash
    POSTGRES
    HOST=tools_php-postgresql
    DATABASE=postDb
    USERNAME=postUser
    PASSWORD=postPass
    ```

4. **Migrations:**

    ```bash
    docker exec -it tools_php-php bash
   
    php artisan migrate
    ```

5. **Cron:**

    ```bash
    crontab -e
    ```

6. **Command to parse.**

    ```bash
   php artisan rss:get-parse
    ```

7. **Cron command.**

    ```bash
    * * * * * docker exec tools_php-php php /var/www/artisan rss:get-parse >> <путь_до_проекту>/cron.log 2>&1
    ```

8. **Api-запити для Postman.**

    ```bash
    HOW TO USE.txt
    ```# parseRss
