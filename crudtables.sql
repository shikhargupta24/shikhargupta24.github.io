

CREATE TABLE  `users` (
    username VARCHAR(255) PRIMARY KEY NOT NULL, 
    password_ VARCHAR(255) NOT NULL);


CREATE TABLE `events` (
    event_id INT AUTO_INCREMENT PRIMARY KEY,   
    event_name VARCHAR(255) NOT NULL,           
    event_date DATETIME NOT NULL,             
    location_p VARCHAR(255) NOT NULL,                  
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP, 
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,  
    username VARCHAR(255) NOT NULL,  -- Add this column to reference 'users'
    FOREIGN KEY (username) REFERENCES users(username) ON DELETE CASCADE  
);


INSERT INTO  `users` (username, password_)
VALUES
 ('Rkhan', 'hashed password');
INSERT INTO  `users` (username, password_)
VALUES ('Keith', 'hashed password');
INSERT INTO  `users` (username, password_)
VALUES
 ('Sgupta', 'hashed password');



INSERT INTO `events` (`event_id`, `event_name`, `event_date`, `location_p`, `created_at`, `updated_at`, `username`) 
VALUES (NULL, 'AI Workshop', '2025-03-10 14:00:00', 'Room 101, Tech Building', '2025-03-02 10:00:00', '2025-03-02 10:00:00', NULL);

INSERT INTO `events` (event_id, event_name, event_date, location_p, created_at, updated_at) 
VALUES (3, 'Book Reading Session', '2025-03-12 16:00:00', 'Library Hall', '2025-03-01 10:00:00', '2025-03-01 10:00:00');

INSERT INTO `events` (`event_id`, `event_name`, `event_date`, `location_p`, `created_at`, `updated_at`, `username`)
 VALUES (NULL, 'Painting Exhibition', '2025-03-15 18:00:00', 'Art Gallery', '2025-03-01 10:00:00', '2025-03-01 10:00:00', NULL);