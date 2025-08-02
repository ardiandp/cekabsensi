<?php
require 'config/database.php';

$query = "
    SELECT
        u.name,
        k.tanggal,
        s.nama AS shift,
        s.masuk AS jam_masuk_shift,
        s.pulang AS jam_pulang_shift,
        MIN(CASE WHEN a.CHECKTYPE = 'I' THEN a.CHECKTIME END) AS jam_masuk,
        MAX(CASE WHEN a.CHECKTYPE = 'O' THEN a.CHECKTIME END) AS jam_pulang,
        CASE
            WHEN TIME(MIN(CASE WHEN a.CHECKTYPE = 'I' THEN a.CHECKTIME END)) > s.masuk THEN 'Terlambat'
            ELSE 'Tepat Waktu'
        END AS status_masuk,
        CASE
            WHEN TIME(MAX(CASE WHEN a.CHECKTYPE = 'O' THEN a.CHECKTIME END)) < s.pulang THEN 'Pulang Cepat'
            ELSE 'Tepat Waktu'
        END AS status_pulang
    FROM kalenderkerja k
    JOIN userinfo u ON k.karyawan = u.userid
    JOIN shift s ON k.shift = s.id
    LEFT JOIN absensi a ON a.USERID = u.userid AND DATE(a.CHECKTIME) = k.tanggal
    GROUP BY u.name, k.tanggal, s.nama, s.masuk, s.pulang
    ORDER BY k.tanggal DESC
";

$result = $conn->query($query);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Cek Absensi</title>
    <style>
        table { border-collapse: collapse; width: 100%; }
        th, td { border: 1px solid #ccc; padding: 8px; }
    </style>
</head>
<body>
    <h2>Rekap Absensi</h2>
    <table>
        <thead>
            <tr>
                <th>Nama</th>
                <th>Tanggal</th>
                <th>Shift</th>
                <th>Jam Masuk</th>
                <th>Status Masuk</th>
                <th>Jam Pulang</th>
                <th>Status Pulang</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $result->fetch_assoc()) { ?>
                <tr>
                    <td><?= $row['name'] ?></td>
                    <td><?= $row['tanggal'] ?></td>
                    <td><?= "{$row['shift']} ({$row['jam_masuk_shift']} - {$row['jam_pulang_shift']})" ?></td>
                    <td><?= $row['jam_masuk'] ?></td>
                    <td><?= $row['status_masuk'] ?></td>
                    <td><?= $row['jam_pulang'] ?></td>
                    <td><?= $row['status_pulang'] ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</body>
</html>
