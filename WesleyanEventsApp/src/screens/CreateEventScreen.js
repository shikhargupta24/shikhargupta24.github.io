import React, { useState, useEffect } from 'react';
import { Text, View, TouchableOpacity, TextInput, SafeAreaView, ActivityIndicator, Alert } from 'react-native';
import AsyncStorage from '@react-native-async-storage/async-storage';
import axios from 'axios';
import { styles, API_BASE_URL } from '../../App';

const CreateEventScreen = ({ navigation }) => {
  const [eventName, setEventName] = useState('');
  const [eventDate, setEventDate] = useState('');
  const [location, setLocation] = useState('');
  const [loading, setLoading] = useState(false);
  const [error, setError] = useState('');
  const [user, setUser] = useState(null);

  useEffect(() => {
    getUserInfo();
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

  const handleCreate = async () => {
    if (!eventName || !eventDate || !location) {
      setError('All fields are required');
      return;
    }

    if (!isValidDateFormat(eventDate)) {
      setError('Date format should be YYYY-MM-DD HH:MM:SS');
      return;
    }

    setLoading(true);
    setError('');

    try {
      const response = await axios.post(`${API_BASE_URL}events`, {
        event_name: eventName,
        event_date: eventDate,
        location_p: location,
        username: user.username
      });

      if (response.data.code === 0) {
        setLoading(false);
        Alert.alert('Success', 'Event created successfully');
        navigation.goBack();
      } else {
        setError('Invalid response from server');
        setLoading(false);
      }
    } catch (error) {
      setError(error.response?.data?.error || 'Failed to create event');
      setLoading(false);
    }
  };

  const isValidDateFormat = (dateString) => {
    const regex = /^\d{4}-\d{2}-\d{2}\s\d{2}:\d{2}:\d{2}$/;
    return regex.test(dateString);
  };

  return (
    <SafeAreaView style={styles.container}>
      <View style={styles.formContainer}>
        <Text style={styles.headerText}>Create New Event</Text>
        
        {error ? <Text style={styles.errorText}>{error}</Text> : null}
        
        <TextInput
          style={styles.input}
          placeholder="Event Name"
          value={eventName}
          onChangeText={setEventName}
        />
        
        <TextInput
          style={styles.input}
          placeholder="Event Date (YYYY-MM-DD HH:MM:SS)"
          value={eventDate}
          onChangeText={setEventDate}
        />
        
        <TextInput
          style={styles.input}
          placeholder="Location"
          value={location}
          onChangeText={setLocation}
        />
        
        <TouchableOpacity 
          style={styles.button}
          onPress={handleCreate}
          disabled={loading}
        >
          {loading ? (
            <ActivityIndicator color="#fff" />
          ) : (
            <Text style={styles.buttonText}>Create Event</Text>
          )}
        </TouchableOpacity>
        
        <TouchableOpacity 
          style={styles.cancelButton}
          onPress={() => navigation.goBack()}
        >
          <Text style={styles.cancelButtonText}>Cancel</Text>
        </TouchableOpacity>
      </View>
    </SafeAreaView>
  );
};

export default CreateEventScreen;