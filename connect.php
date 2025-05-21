<?php
$conn = new mysqli('127.0.0.1', 'root', '', 'auth_sanctum_api');
if ($conn->connect_error) {
    die("Error: " . $conn->connect_error);
}
echo "✅ Conectado correctamente a MySQL.";
