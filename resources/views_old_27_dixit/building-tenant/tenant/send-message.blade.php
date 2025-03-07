<x-layout.default>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <div class="container mt-4">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h5>Messaging</h5>
                <div>
                    <p>{{ $data['receiver_details']->contact_person ?? $data['receiver_details']->name }}</p>
                </div>
            </div>
            <div class="card-body chat-box" id="chat-box">
                <!-- Messages will be loaded here dynamically -->
            </div>
            <div class="card-footer">
                <div class="input-group">
                    <input type="text" id="message" class="form-control" placeholder="Type a message..." required>
                    <button class="btn btn-primary" id="sendMessage">Send</button>
                </div>
            </div>
        </div>
    </div>

    <style>
        .chat-box {
            height: 400px;
            overflow-y: auto;
            border: 1px solid #ddd;
            padding: 15px;
            background-color: #f9f9f9;
        }

        .message {
            padding: 10px 15px;
            margin: 5px 0;
            border-radius: 15px;
            max-width: 75%;
            display: inline-block;
        }

        .sender {
            background-color: #007bff;
            color: white;
            text-align: right;
            float: right;
            clear: both;
        }

        .receiver {
            background-color: #e5e5e5;
            text-align: left;
            float: left;
            clear: both;
        }
    </style>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        $(document).ready(function() {
            let messageInput = $("#message"); // Corrected ID
            let sendButton = $("#sendMessage");
            let chatBox = $("#chat-box");

            let recieverId = "{{ $reciever_id }}";
            let senderId = "{{ $sender_id }}";
            let receiver_type = "{{ $receiver_type }}";
            let sender_type = "{{ $sender_type }}";

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            // Handle Enter key press
            messageInput.keydown(function(event) {
                if (event.key === "Enter" && !event.shiftKey) {
                    event.preventDefault();
                    sendButton.click();
                }
            });

            // Load messages on page load
            loadMessages();

            function loadMessages() {
                $.ajax({
                    url: "{{ route('messages.fetch') }}",
                    type: "GET",
                    data: {
                        reciever_id: recieverId,
                        sender_id: senderId,
                        receiver_type: receiver_type,
                        sender_type: sender_type
                    },
                    success: function(response) {
                        chatBox.html(""); // Clear chat box
                        response.messages.forEach(msg => {
                            let alignment = msg.sender_id == senderId ? "sender" : "receiver";

                            let timestamp = new Date(msg.created_at).toLocaleString("en-US", {
                                hour: "2-digit",
                                minute: "2-digit",
                                hour12: true,
                                day: "2-digit",
                                month: "short",
                                year: "numeric"
                            });

                            chatBox.append(
                                `<div class="message ${alignment}">
                                    <p>${msg.message}</p>
                                    <span class="timestamp">${timestamp}</span>
                                </div>`
                            );
                        });

                        chatBox.scrollTop(chatBox[0].scrollHeight); // Auto-scroll to latest message
                    },
                    error: function(xhr, status, error) {
                        console.error('Error fetching messages:', error);
                    }
                });
            }

            // Send message on button click
            sendButton.click(function() {
                let message = messageInput.val().trim();
                if (message === "") return;

                $.ajax({
                    url: "{{ route('messages.send') }}",
                    type: "POST",
                    data: {
                        receiver_id: recieverId,
                        sender_id: senderId,
                        receiver_type: receiver_type,
                        sender_type: sender_type,
                        message: message
                    },
                    success: function(response) {
                        messageInput.val(""); // Clear input field
                        loadMessages(); // Refresh chat
                    },
                    error: function(xhr, status, error) {
                        console.error('Error sending message:', error);
                    }
                });
            });

            // Poll for new messages every 5 seconds
            setInterval(loadMessages, 5000);
        });
    </script>
</x-layout.default>
