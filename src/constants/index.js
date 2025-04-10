import { StyleSheet } from 'react-native';

// Change this to your local IP address for development
export const API_BASE_URL = 'http://172.21.167.35:8080/wes_events_api/';

// Export styles to be used across components
export const styles = StyleSheet.create({
  container: {
    flex: 1,
    backgroundColor: '#fdf9f9'
  },
  formContainer: {
    flexGrow: 1,
    justifyContent: 'center',
    padding: 20
  },
  logoContainer: {
    alignItems: 'center',
    marginBottom: 40
  },
  header: {
    backgroundColor: '#7d1919',
    padding: 15,
    alignItems: 'center'
  },
  headerText: {
    color: '#7d1919',
    fontSize: 32,
    fontWeight: 'bold',
    fontFamily: 'Cambria',
    marginBottom: 10
  },
  subHeaderText: {
    fontSize: 20,
    color: '#666',
    fontFamily: 'Verdana'
  },
  inputContainer: {
    width: '100%'
  },
  input: {
    width: '100%',
    height: 50,
    borderWidth: 1,
    borderColor: '#ddd',
    borderRadius: 8,
    marginBottom: 15,
    paddingHorizontal: 15,
    backgroundColor: '#fff',
    fontSize: 16
  },
  button: {
    backgroundColor: '#7d1919',
    width: '100%',
    padding: 15,
    borderRadius: 8,
    alignItems: 'center',
    marginTop: 20
  },
  buttonText: {
    color: 'white',
    fontWeight: 'bold',
    fontSize: 16
  },
  linkButton: {
    marginTop: 20,
    alignItems: 'center'
  },
  linkText: {
    color: '#7d1919',
    fontSize: 16
  },
  loader: {
    marginTop: 20
  },
  // Event list styles
  listContainer: {
    padding: 10
  },
  eventItem: {
    backgroundColor: '#fff',
    padding: 15,
    borderRadius: 8,
    marginBottom: 10,
    borderLeftWidth: 5,
    borderLeftColor: '#7d1919',
    shadowColor: '#000',
    shadowOffset: {
      width: 0,
      height: 2
    },
    shadowOpacity: 0.1,
    shadowRadius: 4,
    elevation: 3
  },
  eventTitle: {
    fontSize: 18,
    fontWeight: 'bold',
    marginBottom: 5,
    color: '#333'
  },
  eventDescription: {
    fontSize: 14,
    color: '#666',
    marginBottom: 10
  },
  eventDetails: {
    fontSize: 12,
    color: '#888'
  },
  eventActions: {
    flexDirection: 'row',
    justifyContent: 'flex-end',
    marginTop: 10
  },
  actionButton: {
    padding: 8,
    borderRadius: 5,
    marginLeft: 10
  },
  actionButtonText: {
    color: 'white',
    fontWeight: 'bold'
  },
  editButton: {
    backgroundColor: '#4682B4'
  },
  deleteButton: {
    backgroundColor: '#DC3545'
  },
  emptyText: {
    textAlign: 'center',
    marginTop: 50,
    fontSize: 16,
    color: '#666'
  }
}); 