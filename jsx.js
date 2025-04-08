import React, { useState, useEffect } from 'react';

const EventList = () => {
  const [events, setEvents] = useState([]);
  const [error, setError] = useState(null);

  // Replace with localhost if not using a emulator or actual phone
  const API_URL = 'http://192.168.1.100:8080/wes_events_api/api.php/events';

  useEffect(() => {
    fetch(API_URL)
      .then((response) => {
        if (!response.ok) {
          throw new Error('Network response was not ok ' + response.status);
        }
        return response.json();
      })
      .then((data) => setEvents(data))
      .catch((err) => setError(err.message));
  }, []);

  if (error) return <div>Error: {error}</div>;
  if (!events.length) return <div>No events found.</div>;

  return (
    <div>
      <h1>Event List</h1>
      <ul>
        {events.map((event) => (
          <li key={event.event_id}>
            <h2>{event.event_name}</h2>
            <p>{event.event_date}</p>
            <p>{event.location_p}</p>
            <p>{event.username}</p>
          </li>
        ))}
      </ul>
    </div>
  );
};

export default EventList;