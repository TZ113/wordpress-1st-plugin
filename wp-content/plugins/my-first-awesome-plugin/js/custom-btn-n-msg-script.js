const mpaf_showMessage = () => {
    var messageDiv = document.getElementById('mpaf-message');
    messageDiv.style.display = 'block';

    setTimeout(() => {
        messageDiv.style.display = 'none';
    }, 5000); // Hide the message after 5000 milliseconds (5 seconds)
}
