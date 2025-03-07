

CREATE TABLE 'users' (
    username VARCHAR(255) PRIMARY KEY, 
    password_ VARCHAR(255) NOT NULL);


CREATE TABLE `clubs` (
    club_id INT AUTO_INCREMENT PRIMARY KEY,  -- Unique ID for each club
    club_name VARCHAR(100) NOT NULL,         -- Name of the club
    club_description TEXT,                        -- Description of the club
    username VARCHAR(50),                    -- Foreign key referencing the users table
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,  -- When the club was created
    FOREIGN KEY (username) REFERENCES users(username) ON DELETE CASCADE  -- Links club to the user
);




CREATE TABLE `events` (
    event_id INT AUTO_INCREMENT PRIMARY KEY,   -- Unique ID for each event
    club_id INT,                               -- Foreign key linking to clubs
    event_name VARCHAR(255) NOT NULL,           -- Name of the event
    event_description TEXT,                          -- Description of the event
    event_date DATETIME NOT NULL,              -- Date and time of the event
    location_place VARCHAR(255),                     -- Event location
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,  -- When the event was created
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,  -- When the event was last updated
    FOREIGN KEY (club_id) REFERENCES clubs(club_id) ON DELETE CASCADE  -- Link events to a club
);


INSERT INTO `events` (club_id, event_name, description, event_date, location)
VALUES (1, 'Coding Bootcamp', 'A workshop on coding for beginners.', '2025-04-15 09:00:00', 'Room 101, Main Building');

SELECT e.event_name, e.description, e.event_date, e.location
FROM `events` e
JOIN `clubs` c ON e.club_id = c.club_id
WHERE c.username = 'club_admin';  -- Assuming 'club_admin' is the username

SELECT event_name, description, event_date, location FROM `events`;


UPDATE `events`
SET event_name = 'Advanced Coding Bootcamp', event_date = '2025-04-17 10:00:00', location = 'Room 102, Main Building'
WHERE event_id = 1;  -- Update the event with event_id = 1


DELETE FROM `events` WHERE event_id = 1;  -- Delete the event with event_id = 1


--FLOW EXAMPLE 

INSERT INTO `users` (username, password)
VALUES ('club_admin', 'hashed_password_here');  -- Replace with a securely hashed password

INSERT INTO `clubs` (club_name, description, username)
VALUES ('Tech Club', 'A club for tech enthusiasts', 'club_admin');

INSERT INTO `events` (club_id, event_name, description, event_date, location)
VALUES (1, 'AI Workshop', 'Workshop on Artificial Intelligence basics', '2025-05-10 14:00:00', 'Room 203, Science Building');

SELECT e.event_name, e.description, e.event_date, e.location
FROM `events` e
JOIN `clubs` c ON e.club_id = c.club_id
WHERE c.username = 'club_admin';  -- View events by the club of 'club_admin'

UPDATE `events`
SET event_name = 'AI and Robotics Workshop', event_date = '2025-05-12 14:00:00'
WHERE event_id = 1;

DELETE FROM `events` WHERE event_id = 1;  -- Delete the event with event_id = 1

