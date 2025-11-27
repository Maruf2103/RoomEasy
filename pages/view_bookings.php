<?php
include "../includes/db.php";

$filter_room = $_GET['room_type'] ?? '';
$filter_status = $_GET['status'] ?? '';

$sql = "SELECT * FROM bookings";
$conds = [];
$params = [];
$types = "";

if($filter_room){
  $conds[] = "room_type = ?";
  $params[] = $filter_room;
  $types .= "s";
}


if($filter_status){
  $conds[] = "status = ?";
  $params[] = $filter_status;
  $types .= "s";
}

if($conds) $sql .= " WHERE " . implode(" AND ", $conds);

$stmt = $conn->prepare($sql);
if($params){
  $stmt->bind_param($types, ...$params);
}
$stmt->execute();
$res = $stmt->get_result();

include "../includes/header.php";
?>

<div class="card">
  <h2>All Bookings</h2>

  <form method="get" style="margin-bottom:12px;display:flex;gap:8px;flex-wrap:wrap">
    <select name="room_type">
      <option value="">--Room Type--</option>
      <option value="Standard" <?php if($filter_room=="Standard") echo "selected";?>>Standard</option>
      <option value="Deluxe" <?php if($filter_room=="Deluxe") echo "selected";?>>Deluxe</option>
      <option value="Suite" <?php if($filter_room=="Suite") echo "selected";?>>Suite</option>
    </select>

    <select name="status">
      <option value="">--Status--</option>
      <option <?php if($filter_status=="Booked") echo "selected";?>>Booked</option>
      <option <?php if($filter_status=="Cancelled") echo "selected";?>>Cancelled</option>
      <option <?php if($filter_status=="Checked-in") echo "selected";?>>Checked-in</option>
      <option <?php if($filter_status=="Checked-out") echo "selected";?>>Checked-out</option>
    </select>

    <button type="submit">Filter</button>
    <a href="/roomeasy/pages/view_bookings.php"><button type="button" class="secondary">Reset</button></a>
  </form>

  <table class="table">
    <thead>
      <tr>
        <th>ID</th>
        <th>Guest</th>
        <th>Email</th>
        <th>Phone</th>
        <th>Room</th>
        <th>Check-in</th>
        <th>Check-out</th>
        <th>Status</th>
        <th>Payment (RM)</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
      <?php while($row = $res->fetch_assoc()): ?>
        <tr>
          <td><?php echo $row['booking_id']; ?></td>
          <td><?php echo htmlspecialchars($row['guest_name']); ?></td>
          <td><?php echo htmlspecialchars($row['email']); ?></td>
          <td><?php echo htmlspecialchars($row['phone']); ?></td>
          <td><?php echo $row['room_type']; ?></td>
          <td><?php echo $row['check_in_date']; ?></td>
          <td><?php echo $row['check_out_date']; ?></td>
          <td><?php echo $row['status']; ?></td>
          <td><?php echo number_format($row['payment'], 2); ?></td>
          <td class="actions">
            <a href="/roomeasy/pages/update_booking.php?id=<?php echo $row['booking_id']; ?>"><button>Edit</button></a>
            <a href="/roomeasy/pages/delete_booking.php?id=<?php echo $row['booking_id']; ?>" onclick="return confirmDelete();">
              <button class="secondary">Delete</button>
            </a>
          </td>
        </tr>
      <?php endwhile; $stmt->close(); ?>
    </tbody>
  </table>
</div>

<?php include "../includes/footer.php"; ?>
