<?php
    // $DB_DSN = 'mysql:dbname=gsbsupma_db;host=127.0.0.1';
    // $DB_USER = 'root';
    // $DB_PASSWORD = '';
    // $DB_NAME = 'gsbsupma_db';
    // $DB_HOST = '127.0.0.1';

    $DB_DSN = 'mysql:dbname=gsbsupma_db;host=localhost:3306';
    $DB_USER = 'gsbsupma_user';
    $DB_PASSWORD = 'NiggainParis96';
    $DB_NAME = 'gsbsupma_db';
    $DB_HOST = 'localhost:3306';

    $host = $_SERVER['HTTP_HOST'];
    $protocol = $_SERVER['PROTOCOL'] = isset($_SERVER['HTTPS']) && !empty($_SERVER['HTTPS']) ? 'https' : 'http';
    $url = "$protocol://$host/noa_app";


    