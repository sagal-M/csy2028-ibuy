<?php
try {
    $pdo = new PDO('mysql:dbname=as1;host=localhost', 'root', '', [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
} catch (PDOException $e) {
    echo 'Could not connect: ' . $e->getMessage();
    exit;
}
?>
