<?php
if (!defined('USER')) {
define('USER', 'admin');
}
if (!defined('PASSWORD')) {
define('PASSWORD', '9683');
}
if (!defined('HOST')) {
define('HOST', 'localhost');
}
if (!defined('DATABASE')) {
define('DATABASE', 'test');
}
try {
    $connection = new PDO("mysql:host=".HOST.";dbname=".DATABASE, USER, PASSWORD);
} catch (PDOException $e) {
    exit("Error: " . $e->getMessage());
}
