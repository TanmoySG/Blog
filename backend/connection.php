<?php

$pdo = new PDO("mysql: host=localhost; dbname=blog_backend;", 'root', '' );
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

?>