import './bootstrap';
import Alpine from 'alpinejs';
import Echo from 'laravel-echo';
import Pusher from 'pusher-js';

window.Alpine = Alpine;

Alpine.start();

    // Initialize Laravel Echo with Pusher
    window.Echo = new Echo({
        broadcaster: 'pusher',
        key: '877e685d19e9e7119443',
        cluster: 'ap2',
        encrypted: true,
        authEndpoint: '/broadcasting/auth' // Ensure this is set up
    });

    // Subscribe to the private channel
    // Subscribe to the issues channel
    window.Echo.channel('issues')
        .listen('App\\Events\\IssueSubmitted', (data) => {
            console.log('Received data from Pusher:', data); // Log the incoming data with more context
        // Update the dashboard with the new issue data
        const issueElement = document.createElement('div');
        issueElement.innerHTML = `<strong>New Issue:</strong> ${data.issue.description} (Priority: ${data.issue.priority})`;
        document.getElementById('issues-list').appendChild(issueElement);
        // Code to update the dashboard with the new issue data
    });
