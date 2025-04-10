import React from 'react';
import { AppRegistry } from 'react-native';
import AppNavigator from './src/navigation';

// Main App component
const App = () => {
  return <AppNavigator />;
};

// Register the main component
AppRegistry.registerComponent('main', () => App);

export default App;