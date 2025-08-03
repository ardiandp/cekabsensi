<?php
require 'config/database.php';

if (isset($_GET['userid'])) {
    $userid = (int)$_GET['userid'];
    
    $sql = "DELETE FROM userinfo WHERE userid = $userid";
    
    if ($conn->query($sql) === TRUE) {
        echo "User berhasil dihapus.";
        header("Location: tampiluser.php");
    } else {
        echo "Error menghapus user: " . $conn->error;
    }
} else {
    echo "User ID tidak ditemukan.";
}
?>

