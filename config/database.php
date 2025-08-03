<?php
// Database configuration offline
$conn = mysqli_connect("localhost", "root", "", "native_tarik_fp");

if (!$conn) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}

/* 
// Database configuration Online
$conn = mysqli_connect("153.92.15.58", "u284292842_finger", "Database-2025", "u284292842_finger");

if (!$conn) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}
*/