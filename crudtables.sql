
CREATE DATABASE if0_38470935_wes_app;

CREATE TABLE  `users` (
    username VARCHAR(255) PRIMARY KEY NOT NULL, 
    password VARCHAR(255) NOT NULL);


INSERT INTO  `users` (username, password)
VALUES
 ('Rkhan', 'Chocolate240'),

 ('Keith', 'Penutbuttercar'),

 ('Sgupta', 'Caramellane10');
 

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


INSERT INTO `events` (`event_id`, `event_name`, `event_date`, `location_p`, `created_at`, `updated_at`, `username`) VALUES
(1, 'AI Workshop', '2025-03-10 14:00:00', 'Room 101, Tech Building', '2025-03-02 18:00:00', '2025-03-02 18:00:00', ' SGupta'),
(3, 'Book Reading Session', '2025-03-12 16:00:00', 'Library Hall', '2025-03-01 18:00:00', '2025-03-01 18:00:00', ' Rkhan'),
(2, 'Painting Exhibition', '2025-03-15 18:00:00', 'Art Gallery', '2025-03-01 18:00:00', '2025-03-01 18:00:00', 'Keith');
