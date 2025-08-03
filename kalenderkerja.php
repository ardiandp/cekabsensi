
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
require 'config/database.php';

$sql = "SELECT k.id as idkalender, k.tanggal, s.nama AS shift, u.name AS karyawan, u.userid
        FROM kalenderkerja k
        right JOIN shift s ON k.shift = s.nama
        right JOIN userinfo u ON k.karyawan = u.userid
        ORDER BY k.tanggal ASC";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<table border='1'>";
    echo "<tr><th>ID</th><th>Tanggal</th><th>Shift</th><th>Karyawan</th><th>Action</th></tr>";
    while($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["idkalender"] . "</td>";
        echo "<td>" . $row["tanggal"] . "</td>";
        echo "<td>" . $row["shift"] . "</td>";
        echo "<td>" . $row["karyawan"] . " ({$row["userid"]})</td>";
        echo "<td><a href='edit_kalender.php?id=" . $row["idkalender"] . "'>Edit</a> | <a href='hapus_kalender.php?id=" . $row["idkalender"] . "'>Hapus</a></td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "0 results";
}
?>

    </div>
</div>
<?php include 'includes/footer.php'; ?>