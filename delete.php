<?php
session_start();
require_once "config.php";

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

$eventId = $_GET['event_id'] ?? null;
if (!$eventId) {
    header("Location: read.php");
    exit;
}

// Fetch the event to check ownership
$stmt = $pdo->prepare("SELECT username FROM events WHERE event_id = :id");
$stmt->execute(['id' => $eventId]);
$event = $stmt->fetch();

if (!$event) {
    // No event found
    header("Location: read.php");
    exit;
}

// Ensure only the creator can delete
if ($event['username'] !== $_SESSION['username']) {
    header("Location: read.php");
    exit;
}

// If we get here, the logged-in user owns this event. Delete it:
$stmt = $pdo->prepare("DELETE FROM events WHERE event_id = :id");
$stmt->execute(['id' => $eventId]);

header("Location: read.php");
exit;