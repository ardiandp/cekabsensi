
<?php 
$pageTitle = "Dashboard";
$currentPage = "dashboard";
include 'includes/header.php'; 
include 'includes/sidebar.php';
?>

<div class="content">
    <div class="container-fluid">
      

<?php
require 'config/database.php';

$sql = "
    SELECT 
        id, 
        tanggal, 
        name, 
        userid, 
        jam_masuk, 
        jam_keluar 
    FROM absensi_live
";

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Data Absensi Live</title>
    <style>
        table { border-collapse: collapse; width: 100%; }
        th, td { border: 1px solid #ccc; padding: 8px; }
    </style>
</head>
<body>
    <h2>Data Absensi Live</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Tanggal</th>
                <th>Name</th>
                <th>UserID</th>
                <th>Jam Masuk</th>
                <th>Jam Keluar</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $result->fetch_assoc()) { ?>
                <tr>
                    <td><?= $row['id'] ?></td>
                    <td><?= $row['tanggal'] ?></td>
                    <td><?= $row['name'] ?></td>
                    <td><?= $row['userid'] ?></td>
                    <td><?= $row['jam_masuk'] ?></td>
                    <td><?= $row['jam_keluar'] ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</body>
</html>

    </div>
</div>
<?php include 'includes/footer.php'; ?>