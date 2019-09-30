<?php

try {
    $db = new PDO('mysql:host=localhost;dbname=album_management', 'root', '123456');
} catch (PDOException $exception) {
    die($exception->getMessage());
}
