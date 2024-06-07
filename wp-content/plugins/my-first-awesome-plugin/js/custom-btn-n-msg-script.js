// Function to show the message once the button is clicked
const mfap_showMessage = () => {
    var messageDiv = document.getElementById('mfap-message');
    messageDiv.style.display = 'block';

    setTimeout(() => {
        messageDiv.style.display = 'none';
    }, 5000); // Hide the message after 5000 milliseconds (5 seconds)
}
