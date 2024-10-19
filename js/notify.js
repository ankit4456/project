const notificationContent = document.getElementById('notification-content');
const notificationWrapper = document.getElementById('notification-wrapper');

// Function to clone notifications for infinite loop
function cloneNotifications() {
    const clone = notificationContent.cloneNode(true);
    notificationContent.appendChild(clone);
}

// Call the cloneNotifications function once to set up the infinite scroll loop
cloneNotifications();