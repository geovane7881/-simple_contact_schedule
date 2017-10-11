<?php
try {
    $pdo = new PDO("mysql:dbname=agenda_telefonica;host=localhost", "root", "123");
} catch(PDOException $e) {
    echo "Error: ".$e->getMessage();
    exit;
}
?>
