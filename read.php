<?php
session_start();
require_once "config.php";

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

// Fetch all events
$stmt = $pdo->prepare("SELECT * FROM events ORDER BY event_date ASC");
$stmt->execute();
$events = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html>
<head><title>All Events</title></head>
<body>
    <p>Logged in as: <strong><?= htmlspecialchars($_SESSION['username']) ?></strong> | 
    <a href="logout.php">Logout</a> | 
    <a href="create_event.php">Create Event</a></p>

    <h1>All Events</h1>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Event Name</th>
            <th>Event Date</th>
            <th>Location</th>
            <th>Owner</th>
            <th>Actions</th>
        </tr>
        <?php foreach ($events as $ev): ?>
        <tr>
            <td><?= $ev['event_id'] ?></td>
            <td><?= htmlspecialchars($ev['event_name']) ?></td>
            <td><?= htmlspecialchars($ev['event_date']) ?></td>
            <td><?= htmlspecialchars($ev['location_p']) ?></td>
            <td><?= htmlspecialchars($ev['username']) ?></td>
            <td>
                <?php if ($ev['username'] === $_SESSION['username']): ?>
                    <a href="update_event.php?event_id=<?= $ev['event_id'] ?>">Edit</a> 
                    | 
                    <a href="delete_event.php?event_id=<?= $ev['event_id'] ?>"
                       onclick="return confirm('Are you sure?');">Delete</a>
                <?php else: ?>
                    N/A
                <?php endif; ?>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>