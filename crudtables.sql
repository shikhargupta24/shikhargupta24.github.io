CREATE TABLE `clubs` (
    club_id INT AUTO_INCREMENT PRIMARY KEY,  -- Unique ID for each club
    club_name VARCHAR(100) NOT NULL,         -- Name of the club
    description TEXT,                        -- Description of the club
    username VARCHAR(50),                    -- Foreign key referencing the users table
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,  -- When the club was created
    FOREIGN KEY (username) REFERENCES users(username) ON DELETE CASCADE  -- Links club to the user
);




CREATE TABLE `events` (
    event_id INT AUTO_INCREMENT PRIMARY KEY,   -- Unique ID for each event
    club_id INT,                               -- Foreign key linking to clubs
    event_name VARCHAR(255) NOT NULL,           -- Name of the event
    description TEXT,                          -- Description of the event
    event_date DATETIME NOT NULL,              -- Date and time of the event
    location VARCHAR(255),                     -- Event location
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,  -- When the event was created
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,  -- When the event was last updated
    FOREIGN KEY (club_id) REFERENCES clubs(club_id) ON DELETE CASCADE  -- Link events to a club
);

