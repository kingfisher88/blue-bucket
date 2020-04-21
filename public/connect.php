<?php
    $driver = getenv('DB_DRIVER');
    $host = getenv('DB_HOST');
    $dbname = getenv('DB_NAME');
    $dsn = "$driver:host=$host;dbname=$dbname";
    $username = getenv('DB_USER');
    $password = getenv('DB_PASSWORD');
