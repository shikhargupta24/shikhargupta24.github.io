<?php
// wes_events_api/index.php

header("Content-Type: application/json");

//Connection to PDO
require_once '../web-app/config.php';

// CRUD Funtionality
$method = $_SERVER['REQUEST_METHOD'];
// URL Output: /wes_events_api/index.php/events/1
$request = trim($_SERVER['REQUEST_URI'], '/');
$script = basename(__FILE__);
$requestParts = explode('/', $request);


if (($key = array_search('wes_events_api', $requestParts)) !== false) {
    $requestParts = array_slice($requestParts, $key + 1);
}

$resource = isset($requestParts[0]) ? $requestParts[0] : '';
$id = isset($requestParts[1]) ? $requestParts[1] : null;

// Functions of CRUD
function getAllEvents($pdo) {
    $stmt = $pdo->query("SELECT * FROM events");
    return $stmt->fetchAll();
}

function getEventById($pdo, $id) {
    $stmt = $pdo->prepare("SELECT * FROM events WHERE id = ?");
    $stmt->execute([$id]);
    return $stmt->fetch();
}

function createEvent($pdo, $data) {
    $stmt = $pdo->prepare("INSERT INTO events (title, description, date) VALUES (?, ?, ?)");
    if ($stmt->execute([$data['title'], $data['description'], $data['date']])) {
        return $pdo->lastInsertId();
    }
    return false;
}

function updateEvent($pdo, $id, $data) {
    $stmt = $pdo->prepare("UPDATE events SET title = ?, description = ?, date = ? WHERE id = ?");
    return $stmt->execute([$data['title'], $data['description'], $data['date'], $id]);
}

function deleteEvent($pdo, $id) {
    $stmt = $pdo->prepare("DELETE FROM events WHERE id = ?");
    return $stmt->execute([$id]);
}

// Get input data if provided (for POST, PUT, PATCH)
$input = json_decode(file_get_contents('php://input'), true);

// Routing based on resource
if ($resource == 'events') {
    switch ($method) {
        case 'GET':
            if ($id) {
                $event = getEventById($pdo, $id);
                if ($event) {
                    echo json_encode($event);
                } else {
                    http_response_code(404);
                    echo json_encode(['error' => 'Event not found']);
                }
            } else {
                echo json_encode(getAllEvents($pdo));
            }
            break;

        case 'POST':
            if (isset($input['title'], $input['description'], $input['date'])) {
                $eventId = createEvent($pdo, $input);
                if ($eventId) {
                    http_response_code(201);
                    echo json_encode(['message' => 'Event created', 'id' => $eventId]);
                } else {
                    http_response_code(500);
                    echo json_encode(['error' => 'Failed to create event']);
                }
            } else {
                http_response_code(400);
                echo json_encode(['error' => 'Invalid input']);
            }
            break;

        case 'PUT':
        case 'PATCH':
            if ($id && isset($input['title'], $input['description'], $input['date'])) {
                if (updateEvent($pdo, $id, $input)) {
                    echo json_encode(['message' => 'Event updated']);
                } else {
                    http_response_code(404);
                    echo json_encode(['error' => 'Event not found or not updated']);
                }
            } else {
                http_response_code(400);
                echo json_encode(['error' => 'Invalid input or missing event ID']);
            }
            break;

        case 'DELETE':
            if ($id) {
                if (deleteEvent($pdo, $id)) {
                    echo json_encode(['message' => 'Event deleted']);
                } else {
                    http_response_code(404);
                    echo json_encode(['error' => 'Event not found']);
                }
            } else {
                http_response_code(400);
                echo json_encode(['error' => 'Event ID required']);
            }
            break;

        default:
            http_response_code(405);
            echo json_encode(['error' => 'Method not allowed']);
            break;
    }
} else {
    http_response_code(404);
    echo json_encode(['error' => 'Resource not found']);
}
?>