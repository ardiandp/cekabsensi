<?php 
$pageTitle = "Dashboard";
$currentPage = "dashboard";
include 'includes/header.php'; 
include 'includes/sidebar.php';
?>

<div class="content">
    <div class="container-fluid">
        <h2 class="mb-4">Dashboard</h2>
<?php
require 'vendor/autoload.php';
require 'config/database.php';

use PhpOffice\PhpSpreadsheet\IOFactory;

if (isset($_FILES['file_excel']['tmp_name'])) {
    $filePath = $_FILES['file_excel']['tmp_name'];

    try {
        $spreadsheet = IOFactory::load($filePath);
        $sheet = $spreadsheet->getActiveSheet();
        $rows = $sheet->toArray();

        $baris = 0;
        foreach ($rows as $row) {
            if ($baris == 0) {
                // Lewati baris header
                $baris++;
                continue;
            }

            $userid     = (int) $row[0];
            $checktime  = date('Y-m-d H:i:s', strtotime($row[1]));
            $checktype  = $conn->real_escape_string($row[2]);
            $verifycode = (int) $row[3];
            $sensorid   = $conn->real_escape_string($row[4]);
            $memoinfo   = $conn->real_escape_string($row[5]);

            $query = "INSERT INTO absensi_fp (userid, checktime, checktype, verifycode, sensorid, memoinfo)
                      VALUES ('$userid', '$checktime', '$checktype', '$verifycode', '$sensorid', '$memoinfo')";
            $conn->query($query);
            $baris++;
        }

        echo "Import selesai. Total baris dimasukkan: " . ($baris - 1);
    } catch (Exception $e) {
        echo "Terjadi kesalahan saat mengimpor: " . $e->getMessage();
    }
} else {
    echo "File tidak ditemukan.";
}
?>

<form action="" method="POST" enctype="multipart/form-data">
    <h2>Upload tarikFBabsensi.xlsx</h2>
    <input type="file" name="file_excel" accept=".xls,.xlsx" required>
    <button type="submit">Import</button>
</form>

    </div>
</div>
<?php include 'includes/footer.php'; ?>