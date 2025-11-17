<?php
include "../includes/db.php";
$msg = "";
if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $g = trim($_POST['guest_name']);
    $e = trim($_POST['email']);
    $p = trim($_POST['phone']);
    $rt = trim($_POST['room_type']);
    $ci = $_POST['check_in_date'];
    $co = $_POST['check_out_date'];
    $st = trim($_POST['status']);
    $stmt = $conn->prepare("INSERT INTO bookings (guest_name,email,phone,room_type,check_in_date,check_out_date,status) VALUES (?,?,?,?,?,?,?)");
    $stmt->bind_param("sssssss",$g,$e,$p,$rt,$ci,$co,$st);
    if($stmt->execute()) $msg = "success:Booking added successfully";
    else $msg = "error:Unable to add booking";
    $stmt->close();
}
include "../includes/header.php";
?>
<div class="card">
  <h2>Create Booking</h2>
  <?php if($msg): list($type,$text)=explode(":",$msg,2); ?>
    <div class="msg <?php echo $type==='success'?'success':'error'; ?>"><?php echo htmlspecialchars($text); ?></div>
  <?php endif; ?>
  <form method="post" onsubmit="return validateBookingForm()">
    <div class="form-row">
      <div class="form-field"><label>Guest Name</label><input id="guest_name" name="guest_name" type="text" required></div>
      <div class="form-field"><label>Email</label><input id="email" name="email" type="email" required></div>
      <div class="form-field"><label>Phone</label><input name="phone" type="tel" required></div>
      <div class="form-field"><label>Room Type</label>
        <select name="room_type" required>
          <option value="Standard">Standard</option>
          <option value="Deluxe">Deluxe</option>
          <option value="Suite">Suite</option>
        </select>
      </div>
      <div class="form-field"><label>Check-in Date</label><input id="check_in_date" name="check_in_date" type="date" required></div>
      <div class="form-field"><label>Check-out Date</label><input id="check_out_date" name="check_out_date" type="date" required></div>
      <div class="form-field"><label>Status</label>
        <select name="status" required>
          <option>Booked</option>
          <option>Cancelled</option>
          <option>Checked-in</option>
          <option>Checked-out</option>
        </select>
      </div>
    </div>
    <div style="margin-top:10px"><button type="submit">Save Booking</button></div>
  </form>
</div>
<?php include "../includes/footer.php"; ?>
