<?php 
$pageTitle = "Dashboard";
$currentPage = "dashboard";
include 'includes/header.php'; 
include 'includes/sidebar.php';

require 'config/database.php';
$sql = "SELECT userid, badgenumber, name, gender, title FROM userinfo";
$result = $conn->query($sql); ?>

<div class="content">
    <div class="container-fluid">
        <h2 class="mb-4">Dashboard</h2> 
        <div class="table-responsive">
            <table id="example" class="table table-hover" style="width:100%">
                <thead>
                    <tr>
                        <th>UserID</th>
                        <th>Badge Number</th>
                        <th>Name</th>
                        <th>Gender</th>
                        <th>Title</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                            echo "<tr>
                            <td>" . $row["userid"] . "</td>
                            <td>" . $row["badgenumber"] . "</td>
                            <td>" . $row["name"] . "</td>
                            <td>" . $row["gender"] . "</td>
                            <td>" . $row["title"] . "</td>
                            <td><a href='delete_user.php?userid=" . $row["userid"] . "' onclick='return confirm(\"Hapus data user ini?\")'>Hapus</a></td>
                            
                            </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='5'>No data available</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.0.1/css/buttons.dataTables.min.css">

<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.0.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.print.min.js"></script>

<script>
$(document).ready(function() {
    $('#example').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'pageLength',
            'copyHtml5',
            'excelHtml5',
            'csvHtml5',
            'pdfHtml5',
            'print'
        ]
    } );
} );
</script>

<?php require 'includes/footer.php'; ?>

