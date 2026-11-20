<?php
/**
 * Konfigurasi Database & Koneksi MySQL (FindU)
 * Kelompok 1 - Pemrograman Web
 */

$host     = "localhost";
$username = "root";
$password = "";
$database = "findu_db";

// Flag penanda apakah terkoneksi ke database riil atau menggunakan mock data
$conn = null;
$db_connected = false;

try {
    // Coba koneksi PDO MySQL (suppress error jika MySQL belum berjalan)
    $dsn = "mysql:host=$host;dbname=$database;charset=utf8mb4";
    $conn = new PDO($dsn, $username, $password, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_TIMEOUT => 2
    ]);
    $db_connected = true;
} catch (Exception $e) {
    // Jika belum install / start MySQL di XAMPP, script otomatis fallback ke Mock Data
    $db_connected = false;
    $db_error = $e->getMessage();
}
