<?php 
$pageTitle = "Dashboard";
$currentPage = "dashboard";
include 'includes/header.php'; 
include 'includes/sidebar.php';
?>
    <title>Data absensi_fp</title>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
    <script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
</head>
<body>
 <div class="content">
    <div class="container-fluid"><h2> absensi_fp 
        <h2 class="mb-4"><a href="import_absensi_fp.php"> Import Data Absensi</a> || <a href="attendance_filter.php"> Filter Data Absensi</a> | <a href="absensilive.php"> Absensi Live</a></h2>
    <table id="absensi_fp" class="display" style="width:100%">
        <thead>
            <tr>
                <th>UserID</th>
                <th>Badge Number</th>
                <th>Name</th>
                <th>Masuk</th>
                <th>Keluar</th>
                <th>Verify Code</th>
                <th>Sensor ID</th>
                <th>Memo Info</th>
            </tr>
        </thead>
        <tbody>
            <?php
            require 'config/database.php';

            $sql = "SELECT a.userid, u.badgenumber, u.name, 
                           MIN(CASE WHEN a.checktype = 'I' THEN a.checktime END) AS masuk,
                           MAX(CASE WHEN a.checktype = 'O' THEN a.checktime END) AS keluar,
                           a.verifycode, a.sensorid, a.memoinfo
                    FROM absensi_fp a
                    JOIN userinfo u ON a.userid = u.userid
                    GROUP BY a.userid, DATE(a.checktime)
                    ORDER BY masuk DESC
                    LIMIT 200";

            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<tr>
                    <td>" . $row["userid"] . "</td>
                    <td>" . $row["badgenumber"] . "</td>
                    <td>" . $row["name"] . "</td>
                    <td>" . $row["masuk"] . "</td>
                    <td>" . $row["keluar"] . "</td>
                    <td>" . $row["verifycode"] . "</td>
                    <td>" . $row["sensorid"] . "</td>
                    <td>" . $row["memoinfo"] . "</td>
                    </tr>";
                }
            } else {
                echo "0 results";
            }
            ?>
        </tbody>
    </table>

    <script>
    $(document).ready(function() {
        $('#absensi_fp').DataTable({
            "order": [[ 3, "desc" ]],
            "pageLength": 25
        });
    } );
    </script>
</body>
</html>


<?php require 'includes/footer.php'; ?>

