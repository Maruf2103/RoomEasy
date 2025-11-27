<?php
include "../includes/db.php";
$msg = "";
$id = $_GET['id'] ?? null;
if(!$id) header("Location: view_bookings.php");

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $g = trim($_POST['guest_name']);
    $e = trim($_POST['email']);
    $p = trim($_POST['phone']);
    $rt = trim($_POST['room_type']);
    $ci = $_POST['check_in_date'];
    $co = $_POST['check_out_date'];
    $st = trim($_POST['status']);
    $pay = trim($_POST['payment']); 

    $stmt = $conn->prepare("UPDATE bookings SET guest_name=?,email=?,phone=?,room_type=?,check_in_date=?,check_out_date=?,status=?,payment=? WHERE booking_id=?");
    $stmt->bind_param("sssssssdi",$g,$e,$p,$rt,$ci,$co,$st,$pay,$id); 
    if($stmt->execute()) $msg = "success:Booking updated successfully";
    else $msg = "error:Update failed";
    $stmt->close();
}

$stmt = $conn->prepare("SELECT * FROM bookings WHERE booking_id = ?");
$stmt->bind_param("i",$id);
$stmt->execute();
$res = $stmt->get_result();
$booking = $res->fetch_assoc();

include "../includes/header.php";
?>

<div class="card">
  <h2>Update Booking #<?php echo $id; ?></h2>
  <?php if($msg): list($type,$text)=explode(":",$msg,2); ?>
    <div class="msg <?php echo $type==='success'?'success':'error'; ?>"><?php echo htmlspecialchars($text); ?></div>
  <?php endif; ?>
  <form method="post" onsubmit="return validateBookingForm()">
    <div class="form-row">
      <div class="form-field"><label>Guest Name</label><input id="guest_name" name="guest_name" type="text" value="<?php echo htmlspecialchars($booking['guest_name']); ?>" required></div>
      <div class="form-field"><label>Email</label><input id="email" name="email" type="email" value="<?php echo htmlspecialchars($booking['email']); ?>" required></div>
      <div class="form-field"><label>Phone</label><input name="phone" type="tel" value="<?php echo htmlspecialchars($booking['phone']); ?>" required></div>
      <div class="form-field"><label>Room Type</label>
        <select name="room_type" required>
          <option <?php if($booking['room_type']=='Standard') echo 'selected'; ?>>Standard</option>
          <option <?php if($booking['room_type']=='Deluxe') echo 'selected'; ?>>Deluxe</option>
          <option <?php if($booking['room_type']=='Suite') echo 'selected'; ?>>Suite</option>
        </select>
      </div>
      <div class="form-field"><label>Check-in Date</label><input id="check_in_date" name="check_in_date" type="date" value="<?php echo $booking['check_in_date']; ?>" required></div>
      <div class="form-field"><label>Check-out Date</label><input id="check_out_date" name="check_out_date" type="date" value="<?php echo $booking['check_out_date']; ?>" required></div>
      <div class="form-field"><label>Status</label>
        <select name="status" required>
          <option <?php if($booking['status']=='Booked') echo 'selected'; ?>>Booked</option>
          <option <?php if($booking['status']=='Cancelled') echo 'selected'; ?>>Cancelled</option>
          <option <?php if($booking['status']=='Checked-in') echo 'selected'; ?>>Checked-in</option>
          <option <?php if($booking['status']=='Checked-out') echo 'selected'; ?>>Checked-out</option>
        </select>
      </div>
      <div class="form-field"><label>Payment (RM)</label>
        <input id="payment" name="payment" type="number" step="0.01" min="0" value="<?php echo number_format($booking['payment'],2); ?>" required>
      </div>
    </div>
    <div style="margin-top:10px"><button type="submit">Update Booking</button></div>
  </form>
</div>

<?php include "../includes/footer.php"; ?>
