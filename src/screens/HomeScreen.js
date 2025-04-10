import React, { useState, useEffect } from 'react';
import { Text, View, TouchableOpacity, FlatList, SafeAreaView, Alert, ActivityIndicator } from 'react-native';
import AsyncStorage from '@react-native-async-storage/async-storage';
import axios from 'axios';
import { styles, API_BASE_URL } from '../constants';

const HomeScreen = ({ navigation }) => {
  const [events, setEvents] = useState([]);
  const [loading, setLoading] = useState(true);
  const [error, setError] = useState('');
  const [user, setUser] = useState(null);

  useEffect(() => {
    getUserInfo();
    fetchEvents();
  }, []);

  const getUserInfo = async () => {
    try {
      const userInfo = await AsyncStorage.getItem('userInfo');
      if (userInfo) {
        setUser(JSON.parse(userInfo));
      } else {
        navigation.replace('Login');
      }
    } catch (error) {
      console.log('Error getting user info:', error);
      navigation.replace('Login');
    }
  };

  const fetchEvents = async () => {
    setLoading(true);
    try {
      const response = await axios.get(`${API_BASE_URL}events`);
      if (response.data.code === 0) {
        setEvents(response.data.data);
      } else {
        // Use hardcoded events if API fails
        setEvents([
          {
            id: 1,
            title: "Wesleyan Spring Festival",
            description: "Annual spring festival with music, food, and games",
            date: "2024-04-15",
            location: "University Green",
            time: "12:00 PM"
          },
          {
            id: 2,
            title: "Career Fair",
            description: "Meet with potential employers and explore career opportunities",
            date: "2024-04-20",
            location: "Freeman Athletic Center",
            time: "10:00 AM"
          },
          {
            id: 3,
            title: "Alumni Networking Event",
            description: "Connect with Wesleyan alumni and build your professional network",
            date: "2024-04-25",
            location: "Usdan University Center",
            time: "6:00 PM"
          }
        ]);
      }
    } catch (error) {
      // Use hardcoded events if API fails
      setEvents([
        {
          id: 1,
          title: "Wesleyan Spring Festival",
          description: "Annual spring festival with music, food, and games",
          date: "2024-04-15",
          location: "University Green",
          time: "12:00 PM"
        },
        {
          id: 2,
          title: "Career Fair",
          description: "Meet with potential employers and explore career opportunities",
          date: "2024-04-20",
          location: "Freeman Athletic Center",
          time: "10:00 AM"
        },
        {
          id: 3,
          title: "Alumni Networking Event",
          description: "Connect with Wesleyan alumni and build your professional network",
          date: "2024-04-25",
          location: "Usdan University Center",
          time: "6:00 PM"
        }
      ]);
    } finally {
      setLoading(false);
    }
  };

  const handleLogout = async () => {
    try {
      await AsyncStorage.removeItem('userInfo');
      navigation.replace('Login');
    } catch (error) {
      console.log('Error logging out:', error);
    }
  };

  const formatDate = (dateString) => {
    const date = new Date(dateString);
    return date.toLocaleString();
  };

  const confirmDelete = (event) => {
    Alert.alert(
      'Confirm Delete',
      `Are you sure you want to delete "${event.event_name}"?`,
      [
        { text: 'Cancel', style: 'cancel' },
        { 
          text: 'Delete', 
          style: 'destructive',
          onPress: () => deleteEvent(event.event_id)
        }
      ]
    );
  };

  const deleteEvent = async (eventId) => {
    try {
      const response = await axios.delete(`${API_BASE_URL}event/${eventId}`, {
        data: { username: user.username }
      });
      
      if (response.data.code === 0) {
        // Remove the deleted event from the state
        setEvents(events.filter(event => event.event_id !== eventId));
        Alert.alert('Success', 'Event deleted successfully');
      } else {
        Alert.alert('Error', 'Failed to delete event');
      }
    } catch (error) {
      Alert.alert(
        'Error',
        error.response?.data?.error || 'Failed to delete event'
      );
    }
  };

  const EventItem = ({ item }) => {
    const isOwner = user && user.username === item.username;
    
    return (
      <View style={styles.eventItem}>
        <Text style={styles.eventTitle}>{item.event_name}</Text>
        <Text>Date: {formatDate(item.event_date)}</Text>
        <Text>Location: {item.location_p}</Text>
        <Text>Posted by: {item.username}</Text>
        
        {isOwner && (
          <View style={styles.eventActions}>
            <TouchableOpacity
              style={[styles.actionButton, styles.editButton]}
              onPress={() => navigation.navigate('EditEvent', { event: item })}
            >
              <Text style={styles.actionButtonText}>Edit</Text>
            </TouchableOpacity>
            
            <TouchableOpacity
              style={[styles.actionButton, styles.deleteButton]}
              onPress={() => confirmDelete(item)}
            >
              <Text style={styles.actionButtonText}>Delete</Text>
            </TouchableOpacity>
          </View>
        )}
      </View>
    );
  };

  return (
    <SafeAreaView style={styles.container}>
      <View style={styles.header}>
        <Text style={styles.headerText}>Wesleyan Events</Text>
        <View style={styles.headerButtons}>
          <TouchableOpacity
            style={[styles.headerButton, styles.createButton]}
            onPress={() => navigation.navigate('CreateEvent')}
          >
            <Text style={styles.buttonText}>Create Event</Text>
          </TouchableOpacity>
          
          <TouchableOpacity
            style={[styles.headerButton, styles.logoutButton]}
            onPress={handleLogout}
          >
            <Text style={styles.buttonText}>Logout</Text>
          </TouchableOpacity>
        </View>
      </View>
      
      {loading ? (
        <ActivityIndicator size="large" color="#7d1919" style={styles.loader} />
      ) : error ? (
        <Text style={styles.errorText}>{error}</Text>
      ) : (
        <FlatList
          data={events}
          keyExtractor={(item) => item.event_id.toString()}
          renderItem={({ item }) => <EventItem item={item} />}
          refreshing={loading}
          onRefresh={fetchEvents}
          contentContainerStyle={styles.listContainer}
          ListEmptyComponent={
            <Text style={styles.emptyText}>No events found</Text>
          }
        />
      )}
    </SafeAreaView>
  );
};

export default HomeScreen;