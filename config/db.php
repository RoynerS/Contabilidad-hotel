<?php
// config/db.php

define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'hotelm');

// Crear conexión
$connection = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

// Verificar conexión
if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}

// Establecer charset
mysqli_set_charset($connection, "utf8");
