<?php
session_start();
require_once "config.php";

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

// Get the event_id from query parameter
$eventId = $_GET['event_id'] ?? null;
if (!$eventId) {
    header("Location: read.php");
    exit;
}

// Fetch event from DB
$stmt = $pdo->prepare("SELECT * FROM events WHERE event_id = :id");
$stmt->execute(['id' => $eventId]);
$event = $stmt->fetch();

if (!$event) {
    // No event found
    header("Location: read.php");
    exit;
}

// Make sure only the creator can edit
if ($event['username'] !== $_SESSION['username']) {
    // If the logged-in user is not the event owner, redirect or show error
    header("Location: read.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $eventName = trim($_POST['event_name'] ?? '');
    $eventDate = trim($_POST['event_date'] ?? '');
    $locationP = trim($_POST['location_p'] ?? '');

    // Basic validation
    if ($eventName === '' || $eventDate === '' || $locationP === '') {
        $error = "All fields are required.";
    } elseif (!preg_match('/^\d{4}-\d{2}-\d{2}\s\d{2}:\d{2}:\d{2}$/', $eventDate)) {
        $error = "Event date must be in YYYY-MM-DD HH:MM:SS format.";
    } else {
        // Update DB
        $stmt = $pdo->prepare("
            UPDATE events
            SET event_name = :ename,
                event_date = :edate,
                location_p = :eloc
            WHERE event_id = :id
        ");
        $stmt->execute([
            'ename' => $eventName,
            'edate' => $eventDate,
            'eloc'  => $locationP,
            'id'    => $eventId
        ]);
        header("Location: read.php");
        exit;
    }
}
?>
<!DOCTYPE html>
<html>
<head><title>Update Event</title></head>
<body>
<p>Logged in as <strong><?= htmlspecialchars($_SESSION['username']) ?></strong> | 
   <a href="logout.php">Logout</a></p>

<h1>Update Event</h1>
<?php if (!empty($error)): ?>
    <p style="color:red;"><?= htmlspecialchars($error) ?></p>
<?php endif; ?>

<form method="post">
    <label>Event Name:</label><br>
    <input type="text" name="event_name" required 
           value="<?= htmlspecialchars($event['event_name']) ?>"><br><br>

    <label>Event Date (YYYY-MM-DD HH:MM:SS):</label><br>
    <input type="text" name="event_date" required
           value="<?= htmlspecialchars($event['event_date']) ?>"><br><br>

    <label>Location:</label><br>
    <input type="text" name="location_p" required
           value="<?= htmlspecialchars($event['location_p']) ?>"><br><br>

    <button type="submit">Update</button>
</form>
</body>
</html>