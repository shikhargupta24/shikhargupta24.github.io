import React, { useState } from 'react';
import { NavigationContainer } from '@react-navigation/native';
import { createStackNavigator } from '@react-navigation/stack';
import { StyleSheet, StatusBar } from 'react-native';
import AppLoading from 'expo-app-loading';
import * as Font from 'expo-font';

// Import screens from the src/screens folder
import LoginScreen from './src/screens/LoginScreen';
import RegisterScreen from './src/screens/RegisterScreen';
import HomeScreen from './src/screens/HomeScreen';
import CreateEventScreen from './src/screens/CreateEventScreen';
import EditEventScreen from './src/screens/EditEventScreen';

// Centralized API configuration. Adjust the endpoint as needed.
export const API_BASE_URL = 'http://192.168.1.100/wes_events_api/api.php/';

const Stack = createStackNavigator();

// Async function to load custom fonts
const fetchFonts = () => {
  return Font.loadAsync({
    'Cambria': require('./assets/fonts/Cambria.ttf'),
    'Verdana': require('./assets/fonts/Verdana.ttf'),
  });
};

const App = () => {
  // Manage font loading state
  const [fontsLoaded, setFontsLoaded] = useState(false);

  // While fonts are loading, display the AppLoading component
  if (!fontsLoaded) {
    return (
      <AppLoading 
        startAsync={fetchFonts}
        onFinish={() => setFontsLoaded(true)}
        onError={(error) => console.warn(error)}
      />
    );
  }

  return (
    <>
      {/* Configuring the StatusBar for iOS and Android */}
      <StatusBar barStyle="light-content" backgroundColor="#7d1919" />
      <NavigationContainer>
        <Stack.Navigator initialRouteName="Login" screenOptions={{ headerShown: false }}>
          <Stack.Screen name="Login" component={LoginScreen} />
          <Stack.Screen name="Register" component={RegisterScreen} />
          <Stack.Screen name="Home" component={HomeScreen} />
          <Stack.Screen name="CreateEvent" component={CreateEventScreen} />
          <Stack.Screen name="EditEvent" component={EditEventScreen} />
        </Stack.Navigator>
      </NavigationContainer>
    </>
  );
};

// Centralized styles to be used across components
export const styles = StyleSheet.create({
  container: {
    flex: 1,
    backgroundColor: '#fdf9f9',
  },
  header: {
    backgroundColor: '#7d1919',
    padding: 15,
    alignItems: 'center',
  },
  headerText: {
    color: 'white',
    fontSize: 24,
    fontWeight: 'bold',
    fontFamily: 'Cambria',
  },
  subHeaderText: {
    fontSize: 20,
    marginBottom: 20,
    fontFamily: 'Verdana',
  },
  headerButtons: {
    flexDirection: 'row',
    marginTop: 10,
    justifyContent: 'space-around',
    width: '100%',
  },
  headerButton: {
    padding: 10,
    borderRadius: 5,
    width: '45%',
    alignItems: 'center',
  },
  createButton: {
    backgroundColor: '#e0a6a6',
  },
  logoutButton: {
    backgroundColor: '#885f5f',
  },
  formContainer: {
    padding: 20,
    alignItems: 'center',
  },
  input: {
    width: '100%',
    height: 50,
    borderWidth: 1,
    borderColor: '#ccc',
    borderRadius: 5,
    marginBottom: 15,
    paddingHorizontal: 10,
    backgroundColor: '#fff',
  },
  button: {
    backgroundColor: '#7d1919',
    width: '100%',
    padding: 15,
    borderRadius: 5,
    alignItems: 'center',
    marginTop: 10,
  },
  buttonText: {
    color: 'white',
    fontWeight: 'bold',
    fontSize: 16,
  },
  cancelButton: {
    backgroundColor: '#cfbcbc',
    width: '100%',
    padding: 15,
    borderRadius: 5,
    alignItems: 'center',
    marginTop: 10,
  },
  cancelButtonText: {
    color: '#333',
    fontWeight: 'bold',
    fontSize: 16,
  },
  linkText: {
    color: '#7d1919',
    marginTop: 20,
    fontSize: 16,
  },
  errorText: {
    color: 'red',
    marginBottom: 15,
  },
  listContainer: {
    padding: 10,
  },
  eventItem: {
    backgroundColor: '#fff',
    padding: 15,
    borderRadius: 5,
    marginBottom: 10,
    borderLeftWidth: 5,
    borderLeftColor: '#7d1919',
  },
  eventTitle: {
    fontSize: 18,
    fontWeight: 'bold',
    marginBottom: 5,
  },
  eventActions: {
    flexDirection: 'row',
    justifyContent: 'flex-end',
    marginTop: 10,
  },
  actionButton: {
    padding: 8,
    borderRadius: 5,
    marginLeft: 10,
  },
  actionButtonText: {
    color: 'white',
    fontWeight: 'bold',
  },
  editButton: {
    backgroundColor: '#4682B4',
  },
  deleteButton: {
    backgroundColor: '#DC3545',
  },
  emptyText: {
    textAlign: 'center',
    marginTop: 50,
    fontSize: 16,
    color: '#666',
  },
  loader: {
    marginTop: 50,
  },
});

export default App;
