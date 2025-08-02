<?php
require 'vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\IOFactory;

require 'config/database.php';

if (isset($_FILES['file_excel']['tmp_name'])) {
    $file = $_FILES['file_excel']['tmp_name'];
    $spreadsheet = IOFactory::load($file);
    $sheet = $spreadsheet->getActiveSheet();
    $rows = $sheet->toArray();

    // Lewati header
    for ($i = 1; $i < count($rows); $i++) {
        $row = $rows[$i];

        $userid = (int) $conn->real_escape_string($row[0]);
        $badge_number = $conn->real_escape_string($row[1]);
        $name = $conn->real_escape_string($row[2]);
       
        $title = is_null($row[4]) ? '' : $conn->real_escape_string($row[4]);

        $sql = "INSERT INTO userinfo (userid, badgenumber, name,  title)
                VALUES ($userid, '$badge_number', '$name', '$title')";

        $conn->query($sql);
    }

    echo "Data USERINFO berhasil diimpor.";
} else {
    echo "File tidak ditemukan.";
}
?>

