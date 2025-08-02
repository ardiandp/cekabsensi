<?php

function namaHariIndonesia($tanggal) {
    $namaHari = [
        'Sunday'    => 'Minggu',
        'Monday'    => 'Senin',
        'Tuesday'   => 'Selasa',
        'Wednesday' => 'Rabu',
        'Thursday'  => 'Kamis',
        'Friday'    => 'Jumat',
        'Saturday'  => 'Sabtu',
    ];

    $hariInggris = date('l', strtotime($tanggal));
    return $namaHari[$hariInggris];
}
?>