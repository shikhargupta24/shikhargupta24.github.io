<?php
// wes_events_api/index.php


header("Content-Type: application/json");

header('Access-Control-Allow-Origin:*');
header('Access-Control-Allow-Headers:*');

header('Access-Control-Allow-Methods:POST,GET,OPTIONS,DELETE');
header('Access-Control-Allow-Credentials: true');
//Connection to PDO
require_once __DIR__ . '/../web-app/config.php';

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
    $stmt = $pdo->prepare("INSERT INTO events (event_name, event_date, location_p, username) VALUES (?, ?, ?, ?)");
    if ($stmt->execute([$data['event_name'], $data['event_date'], $data['location_p'], $data['username']])) {
        return $pdo->lastInsertId();
    }
    return false;
}

function updateEvent($pdo, $id, $data) {
    // Update columns using your custom format
    $stmt = $pdo->prepare("UPDATE events SET event_name = ?, event_date = ?, location_p = ?, username = ? WHERE event_id = ?");
    return $stmt->execute([
        $data['event_name'], 
        $data['event_date'], 
        $data['location_p'], 
        $data['username'], 
        $id
    ]);
}
function deleteEvent($pdo, $id) {
    $stmt = $pdo->prepare("DELETE FROM events WHERE event_id = ?");
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
            if (isset($input['event_name'], $input['event_date'], $input['location_p'], $input['username'])) {
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
                    // Check if an ID is provided and if the payload contains all required keys
                    if ($id && isset($input['event_name'], $input['event_date'], $input['location_p'], $input['username'])) {
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
