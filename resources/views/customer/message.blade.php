@extends('layouts.customer.common')

@section('meta')
    <title>Dashboard - {{ config('app.name') }}</title>
@endsection

@section('css')

@endsection

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/pusher-js@7.0.3/dist/web/pusher.min.js"></script>
    <script src="{{ asset('app-assets/site_assets/js/reb/echo.js') }}"></script>
@endsection

@section('content')
    <div class="col-lg-9 main-dashboard">
        <div class="page-title">
            <h1>All Your Bookings Support</h1>
        </div>
        <div id="chat-container">
            <div id="messages"></div>

            <textarea id="message" placeholder="Type your message"></textarea>
            <input type="file" id="image">
            <button onclick=sendMessage()>Send</button>
        </div>

        {{-- <script>
            let userId = {{ auth()->id() }};
            let receiverId = {{ $receiver_id }};

            // Initialize Laravel Echo with Reverb
            window.Echo = new Echo({
                broadcaster: 'reverb',
            });

            // Listen for new messages
            window.Echo.channel('chat.' + receiverId)
                .listen('message.sent', (event) => {
                    let message = event.message;
                    displayMessage(message);
                });

            function displayMessage(message) {
                let messageContainer = document.createElement('div');
                messageContainer.classList.add('message');

                messageContainer.innerHTML = `
                <strong>${message.sender.name}:</strong>
                <p>${message.message}</p>
                ${message.image ? `<img src="/storage/${message.image}" alt="image">` : ''}
            `;

                document.getElementById('messages').appendChild(messageContainer);
            }

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
                    // Set CSRF token in Axios
                    axios.defaults.headers.common['X-CSRF-TOKEN'] = document.querySelector('meta[name="csrf-token"]')
                        .getAttribute('content');

                    await axios.post('/customer/support/send-message', formData, {
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                                'content')
                        }
                    });

                    console.log('Message sent successfully');
                } catch (error) {
                    console.error('Error sending message:', error);
                }

                document.getElementById('message').value = '';
                document.getElementById('image').value = '';
            }
        </script> --}}



    </div>
@endsection
