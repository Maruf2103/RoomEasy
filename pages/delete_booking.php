<?php
include "../includes/db.php";
$id = $_GET['id'] ?? null;
if(!$id) header("Location: view_bookings.php");
$stmt = $conn->prepare("DELETE FROM bookings WHERE booking_id = ?");
$stmt->bind_param("i",$id);
if($stmt->execute()){
    $stmt->close();
    header("Location: view_bookings.php?msg=deleted");
    exit;
} else {
    $stmt->close();
    header("Location: view_bookings.php?msg=error");
    exit;
}
