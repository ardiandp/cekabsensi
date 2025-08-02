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
require 'config/functions.php';

$userid = isset($_GET['userid']) ? $_GET['userid'] : '';
$start  = isset($_GET['start_date']) ? $_GET['start_date'] : '';
$end    = isset($_GET['end_date']) ? $_GET['end_date'] : '';

$where = [];
if ($userid != '') $where[] = "u.userid = '$userid'";
if ($start != '' && $end != '') $where[] = "DATE(a.checktime) BETWEEN '$start' AND '$end'";

$whereSql = count($where) > 0 ? 'WHERE ' . implode(' AND ', $where) : '';

$sql = "
    SELECT 
        u.userid, 
        u.name, 
        DATE(a.checktime) AS tanggal,
        MIN(TIME(a.checktime)) AS jam_masuk,
        MAX(TIME(a.checktime)) AS jam_keluar,
        a.verifycode,
        a.sensorid
    FROM absensi_fp a
    LEFT JOIN userinfo u ON u.userid = a.userid
    $whereSql
    GROUP BY u.userid, DATE(a.checktime)
    ORDER BY tanggal, u.userid
";

$result = $conn->query($sql);

// Ambil daftar user untuk dropdown
$userinfo = $conn->query("SELECT userid, name FROM userinfo ORDER BY name ASC");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Filter Absensi</title>
    <style>
        table, th, td { border: 1px solid black; border-collapse: collapse; padding: 5px; }
    </style>
</head>
<body>
<h2>Filter Data Absensi</h2>

<form method="get">
    <label>User:</label>
    <select name="userid">
        <option value="">-- Semua --</option>
        <?php while ($u = $userinfo->fetch_assoc()) : ?>
            <option value="<?= $u['userid'] ?>" <?= ($userid == $u['userid'] ? 'selected' : '') ?>>
                <?= $u['name'] ?>
            </option>
        <?php endwhile; ?>
    </select>

    <label>Tanggal Awal:</label>
    <input type="date" name="start_date" value="<?= $start ?>">

    <label>Tanggal Akhir:</label>
    <input type="date" name="end_date" value="<?= $end ?>">

    <button type="submit">Tampilkan</button>
</form>

<hr>

<table>
    <tr>
        <th>No</th>
          <th>Hari</th>
        <th>Tanggal</th>
        <th>name</th>
        <th>UserID</th>
        <th>Masuk</th>
        <th>Keluar</th>
        <th>VerifyCode</th>
        <th>SensorID</th>
    </tr>
    <?php
    $no = 1;
    if ($result && $result->num_rows > 0):
        while ($row = $result->fetch_assoc()):
             $hari = namaHariIndonesia($row['tanggal']);
    ?>




    <tr>
        <td><?= $no++ ?></td>
         <td><?= $hari ?></td>
        <td><?= $row['tanggal'] ?></td>
        <td><?= $row['name'] ?? 'N/A' ?></td>
        <td><?= $row['userid'] ?></td>
        <td><?= $row['jam_masuk'] ?></td>
        <td><?= $row['jam_keluar'] ?></td>
        <td><?= $row['verifycode'] ?></td>
        <td><?= $row['sensorid'] ?></td>
    </tr>
    <?php endwhile; else: ?>
    <tr><td colspan="8">Tidak ada data</td></tr>
    <?php endif; ?>
</table>
</body>
</html>



<?php include 'includes/footer.php'; ?>
