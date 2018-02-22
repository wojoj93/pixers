pixers
======

Two way to run application:

1) Symfony server
    1. Execute the php bin/console server:start command.
    2. Browse to the http://localhost:8000 URL.
2) Using Docker (recomended)
    Development mode (without configuration cache, with profiler):
    `docker-compose -f docker-compose.yml -f docker-compose.dev.yml up -d`
    Project url<br>
    `http://localhost:8077/app_dev.php/`

    Test email:
    `Mailhog url: http://localhost:8084/`
    Mailhog documentation:
    `https://github.com/mailhog/MailHog`
    Api Documentation:
    `http://localhost:8077/app_dev.php/api/doc`