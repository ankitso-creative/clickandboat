import Echo from 'laravel-echo';
import Pusher from 'pusher-js';

window.Pusher = Pusher;

window.Echo = new Echo({
    broadcaster: 'reverb',
    key: 'YOUR_REVERB_APP_KEY',
    wsHost: '127.0.0.1',
    wsPort: 6001,
    forceTLS: false,
});

let receiverId = 10; // Change dynamically

async function sendMessage() {
    let message = document.getElementById('message').value;
    let image = document.getElementById('image').files[0];

    let formData = new FormData();
    formData.append('receiver_id', receiverId);
    formData.append('message', message);
    if (image) {
        formData.append('image', image);
    }

    try {
        await axios.post('/customer/support/send-message', formData, {
            headers: { 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content') },
            withCredentials: true,
        });
    } catch (error) {
        console.error('Error:', error.response?.data);
    }

    document.getElementById('message').value = '';
    document.getElementById('image').value = '';
}

window.Echo.channel('chat.' + receiverId)
    .listen('MessageSent', (data) => {
        let messages = document.getElementById('messages');
        let newMessage = document.createElement('div');
        newMessage.innerHTML = `<p>${data.message.sender_id}: ${data.message.message} 
            ${data.message.image ? `<img src="${data.message.image}" width="100">` : ''}</p>`;
        messages.appendChild(newMessage);
    });
