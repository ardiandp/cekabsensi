<?php
require 'vendor/autoload.php';
require 'config/database.php';
use PhpOffice\PhpSpreadsheet\IOFactory;


if (isset($_FILES['file_excel']['tmp_name'])) {
    $file = $_FILES['file_excel']['tmp_name'];
    $spreadsheet = IOFactory::load($file);
    $sheet = $spreadsheet->getActiveSheet();
    $rows = $sheet->toArray();

    for ($i = 1; $i < count($rows); $i++) {
        $row = $rows[$i];

        $userid = $conn->real_escape_string($row[0]);
        $checktime = date('Y-m-d H:i:s', strtotime($row[1]));
        $checktype = $conn->real_escape_string($row[2]);
        $verifycode = $conn->real_escape_string($row[3]);
        $sensorid = $conn->real_escape_string($row[4]);
       

        $sql = "INSERT INTO absensi (userid, checktime, checktype, verifycode, sensorid)
                VALUES ('$userid', '$checktime', '$checktype', '$verifycode', '$sensorid')";

        $conn->query($sql);
    }

    echo "Data ABSENSI berhasil diimpor.";
} else {
    echo "File tidak ditemukan.";
}
?>
