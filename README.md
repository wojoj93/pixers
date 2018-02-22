PIXERS
======

Two way to run application:
======

1) Symfony server
    1. Execute the php bin/console server:start command.
    2. Browse to the http://localhost:8000 URL.
2) Using Docker (recomended) <br>
    1. Development mode (without configuration cache, with profiler):
    `docker-compose -f docker-compose.yml -f docker-compose.dev.yml up -d`
    2. Project url<br>
    `http://localhost:8077/app_dev.php/`
<br>

How to test it:
======
Test email:<br>
`Mailhog url: http://localhost:8084/`<br>
Contact form ulr:<br>
`Mailhog url: http://localhost:8077/app_dev.php/contact`<br>
Api Documentation:<br>
`http://localhost:8077/app_dev.php/api/doc`