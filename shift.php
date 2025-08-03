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

$query = "SELECT id, nama, masuk, pulang, total_jam 
          FROM shift 
          ORDER BY nama ASC";

$result = $conn->query($query);

if ($result->num_rows > 0) {
    echo "<table border='1'>
    <tr>
        <th>ID</th>
        <th>Nama Shift</th>
        <th>Masuk</th>
        <th>Pulang</th>
        <th>Total Jam</th>
        <th>Action</th>
    </tr>";
    while($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>" . $row["id"]. "</td>
                <td>" . $row["nama"]. "</td>
                <td>" . $row["masuk"]. "</td>
                <td>" . $row["pulang"]. "</td>
                <td>" . $row["total_jam"]. "</td>
                <td><a href='update_shift.php?id=" . $row["id"]. "'>Update</a> | <a href='delete_shift.php?id=" . $row["id"]. "'>Delete</a></td>
            </tr>";
    }
    echo "</table>";
} else {
    echo "0 results";
}

$conn->close(); ?>
    </div>
</div>
<?php
require 'includes/footer.php';
?>