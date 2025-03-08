<?php
session_start();
require_once "config.php";

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $eventName = trim($_POST['event_name'] ?? '');
    $eventDate = trim($_POST['event_date'] ?? '');
    $locationP = trim($_POST['location_p'] ?? '');
    
    if ($eventName === '' || $eventDate === '' || $locationP === '') {
        $error = "All fields are required.";
    } elseif (!preg_match('/^\d{4}-\d{2}-\d{2}\s\d{2}:\d{2}:\d{2}$/', $eventDate)) {
        $error = "Event date must be in YYYY-MM-DD HH:MM:SS format.";
    } else {
        // Insert into DB
        $stmt = $pdo->prepare("
            INSERT INTO events (event_name, event_date, location_p, username)
            VALUES (:ename, :edate, :eloc, :uname)
        ");
        $stmt->execute([
            'ename' => $eventName,
            'edate' => $eventDate,
            'eloc'  => $locationP,
            'uname' => $_SESSION['username']
        ]);
        header("Location: read.php");
        exit;
    }
}
?>

<!DOCTYPE html>
<html>
<head><title>Create Event</title></head>
<body>
<?php if (isset($_SESSION['username'])): ?>
  <p>Logged in as <?= htmlspecialchars($_SESSION['username']) ?> | 
    <a href="logout.php">Logout</a>
  </p>
<?php endif; ?>

<h1>Create Event</h1>
<?php if (!empty($error)): ?>
  <p style="color:red;"><?= htmlspecialchars($error) ?></p>
<?php endif; ?>

<form method="post" onsubmit="return validateEventDate();">
    <label>Event Name:</label><br>
    <input type="text" name="event_name" required /><br><br>

    <label>Event Date (YYYY-MM-DD HH:MM:SS):</label><br>
    <input type="text" name="event_date" 
           required 
           pattern="\d{4}-\d{2}-\d{2}\s\d{2}:\d{2}:\d{2}"
           title="Use the format YYYY-MM-DD HH:MM:SS" /><br><br>

    <label>Location:</label><br>
    <input type="text" name="location_p" required /><br><br>

    <button type="submit">Create</button>
</form>

<script>
function validateEventDate() {
  const eventDateValue = document.querySelector('[name="event_date"]').value;
  const regex = /^\d{4}-\d{2}-\d{2}\s\d{2}:\d{2}:\d{2}$/;

  if (!regex.test(eventDateValue)) {
    alert("Please use the format YYYY-MM-DD HH:MM:SS");
    return false; 
  }
  return true;
}
</script>
</body>
</html>
