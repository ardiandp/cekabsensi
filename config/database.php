<?php
// Database configuration
$conn = mysqli_connect("localhost", "root", "", "native_tarik_fp");

if (!$conn) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}
