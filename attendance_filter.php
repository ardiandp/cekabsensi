<?php 
$pageTitle = "Dashboard";
$currentPage = "dashboard";
include 'includes/header.php'; 
include 'includes/sidebar.php';
require 'config/database.php';

// Fungsi untuk nama hari
function namaHariIndonesia($tanggal) {
    $hariInggris = date('l', strtotime($tanggal));
    $namaHari = [
        'Sunday' => 'Minggu',
        'Monday' => 'Senin',
        'Tuesday' => 'Selasa',
        'Wednesday' => 'Rabu',
        'Thursday' => 'Kamis',
        'Friday' => 'Jumat',
        'Saturday' => 'Sabtu',
    ];
    return $namaHari[$hariInggris];
}

// Simpan data terpilih
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['selected'])) {
    $selected = $_POST['selected']; // format: userid|tanggal

    foreach ($selected as $value) {
        list($userid, $tanggal) = explode('|', $value);

        $sqlData = "
            SELECT 
                u.name,
                a.userid,
                DATE(a.checktime) as tanggal,
                MIN(TIME(a.checktime)) as jam_masuk,
                MAX(TIME(a.checktime)) as jam_keluar
            FROM absensi_fp a
            LEFT JOIN userinfo u ON u.userid = a.userid
            WHERE a.userid = '$userid' AND DATE(a.checktime) = '$tanggal'
            GROUP BY a.userid, DATE(a.checktime)
        ";
        $res = $conn->query($sqlData);
        if ($res && $res->num_rows > 0) {
            $row = $res->fetch_assoc();
            $name = $conn->real_escape_string($row['name']);
            $jamMasuk = $row['jam_masuk'];
            $jamKeluar = $row['jam_keluar'];

            $insert = "
                INSERT INTO absensi_live (tanggal, name, userid, jam_masuk, jam_keluar)
                VALUES ('$tanggal', '$name', '$userid', '$jamMasuk', '$jamKeluar')
                ON DUPLICATE KEY UPDATE
                    name = VALUES(name),
                    jam_masuk = VALUES(jam_masuk),
                    jam_keluar = VALUES(jam_keluar)
            ";
            $conn->query($insert);
        }
    }

    echo "<div style='color: green;'>Data berhasil disimpan atau diperbarui ke absensi_live!</div>";
}

// Filter & ambil data
$userid = $_GET['userid'] ?? '';
$start  = $_GET['start_date'] ?? '';
$end    = $_GET['end_date'] ?? '';

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
    ORDER BY tanggal DESC, u.userid
    LIMIT 300
";
$result = $conn->query($sql);

// Dropdown user
$userinfo = $conn->query("SELECT userid, name FROM userinfo ORDER BY name ASC");
?>

<div class="content">
    <div class="container-fluid">
        <h2>Filter Data Absensi</h2>

        <form method="get" style="margin-bottom: 20px;">
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

        <form method="post">
            <table class="table table-striped table-bordered">
                <tr>
                    <th>No</th>
                    <th>Hari</th>
                    <th>Tanggal</th>
                    <th>Nama</th>
                    <th>UserID</th>
                    <th>Masuk</th>
                    <th>Keluar</th>
                    <th>VerifyCode</th>
                    <th>SensorID</th>
                    <th><input type="checkbox" id="checkAll"> Pilih</th>
                </tr>
                <?php
                $no = 1;
                if ($result && $result->num_rows > 0):
                    while ($row = $result->fetch_assoc()):
                        $hari = namaHariIndonesia($row['tanggal']);
                        $key = $row['userid'] . '|' . $row['tanggal'];
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
                    <td><input type="checkbox" name="selected[]" value="<?= $key ?>"></td>
                </tr>
                <?php endwhile; else: ?>
                <tr><td colspan="10">Tidak ada data</td></tr>
                <?php endif; ?>
            </table>

            <br>
            <button type="submit">Simpan Data Terpilih</button>
        </form>
    </div>
</div>

<!-- Check All JS -->
<script>
    document.getElementById("checkAll").addEventListener("click", function () {
        const checkboxes = document.querySelectorAll('input[name="selected[]"]');
        for (const checkbox of checkboxes) {
            checkbox.checked = this.checked;
        }
    });
</script>

<?php include 'includes/footer.php'; ?>
