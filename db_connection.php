<?php
try {
    $pdo = new PDO('mysql:host=localhost;dbname=test1', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    $error_message = 'Không thể kết nối CSDL';
    $reason = $e->getMessage();
}
