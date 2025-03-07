

CREATE TABLE  `users` (
    username VARCHAR(255) PRIMARY KEY, 
    password_ VARCHAR(255) NOT NULL);
    

CREATE TABLE `events` (
    event_id INT AUTO_INCREMENT PRIMARY KEY,   -- Unique ID for each event                              -- Foreign key linking to clubs
    event_name VARCHAR(255) NOT NULL,           -- Name of the event
    event_date DATETIME NOT NULL,              -- Date and time of the event
    location_p VARCHAR(255),                     -- Event location
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,  -- When the event was created
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,  -- When the event was last updated
    FOREIGN KEY (username) REFERENCES users(username) ON DELETE CASCADE  -- Link events to a club
);


INSERT INTO  `users` (username, password_)
VALUES
 ('Rkhan', "hashed password")
 ('Keith', 'hashed password')
 ('Sgupta', 'hashed password');




INSERT INTO `events` (event_id, club_id, event_name, event_date, location_p, created_at, updated_at)
VALUES
(1, 1, 'AI Workshop', '2025-03-10 14:00:00', 'Room 101, Tech Building', '2025-03-02 10:00:00', '2025-03-02 10:00:00'),
(2, 2, 'Painting Exhibition', '2025-03-15 18:00:00', 'Art Gallery', '2025-03-01 10:00:00', '2025-03-01 10:00:00'),
(3, 3, 'Book Reading Session', '2025-03-12 16:00:00', 'Library Hall', '2025-03-01 10:00:00', '2025-03-01 10:00:00');


