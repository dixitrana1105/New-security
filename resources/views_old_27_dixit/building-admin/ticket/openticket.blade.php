<x-layout.default>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <div class="flex justify-center mb-4">
        <h1 class="text-2xl font-bold">Open Ticket</h1>
    </div>
    <div class="table-responsive" x-data="form">
        <table class="min-w-full shadow-lg rounded-lg overflow-hidden">
            <thead>
                <tr>
                    {{-- <th class="font-bold py-2 px-6">S.No</th> --}}
                    <th class="font-bold py-2 px-8">Attachment</th>
                    <th class="font-bold py-2 px-8">Ticket Id</th>
                    <th class="font-bold py-2 px-8">Date & Time</th>
                    <th class="font-bold py-2 px-8">Subject</th>
                    <th class="font-bold py-2 px-8">From </th>
                    <th class="font-bold py-2 px-8">Person Name</th>
                    <th class="font-bold py-2 px-8">Description</th>
                    <th class="font-bold py-2 px-8">Reply</th>
                    <th class="font-bold py-2 px-8">Status (Hold/Close)</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($get_all_ticket_new as $ticket)
                    <tr class="border-b duration-300">
                        {{-- <td>{{ $loop->iteration }}</td> <!-- Serial Number --> --}}
                        <td class="py-2 px-8">
                            <img src="{{ asset($ticket->attachment) }}" alt="image" class="object-cover mb-5" />
                        </td>
                        <td>{{ $ticket->ticket_id }}</td>
                        <td>{{ $ticket->date_time }}</td>
                        <td>{{ $ticket->subject }}</td>
                        <td>Building Admin Tenant</td>
                        <td>{{ $ticket->building->name ?? 'N/A' }}</td>
                        <td>
                            {{ $ticket->description }}
                        </td>
                        <td>
                            <button class="btn btn-outline-primary"
                                onclick="openModal('{{ $ticket->ticket_id }}', '{{ $ticket->reply }}')"
                                style="white-space: nowrap;">Reply</button>

                            @include('super-admin.ticket-modal.reply', [
                                'ticket_id' => $ticket->ticket_id,
                                'reply' => $ticket->reply,
                            ])
                        </td>
                        <td>
                            <select class="status-dropdown" data-ticket-id="{{ $ticket->ticket_id }}">
                                <option value="">Select Status</option>
                                <option value="1" {{ $ticket->status_of_button == 1 ? 'selected' : '' }}>Hold</option>
                                <option value="2" {{ $ticket->status_of_button == 2 ? 'selected' : '' }}>Close</option>
                            </select>
                        </td>
                    </tr>
                @endforeach
            </tbody>

            <tbody>
                @foreach ($get_all_ticket_new_from_security as $ticket)
                    <tr class="border-b duration-300">
                        {{-- <td>{{ $loop->iteration }}</td> <!-- Serial Number --> --}}
                        <td class="py-2 px-8">
                            <img src="{{ asset($ticket->attachment) }}" alt="image" class="object-cover mb-5" />
                        </td>
                        <td>{{ $ticket->ticket_id }}</td>
                        <td>{{ $ticket->date_time }}</td>
                        <td>{{ $ticket->subject }}</td>
                        <td>Building Admin Tenant</td>
                        <td>{{ $ticket->building->name ?? 'N/A' }}</td>
                        <td>
                            {{ $ticket->description }}
                        </td>
                        <td>
                            <button class="btn btn-outline-primary"
                                onclick="openModal('{{ $ticket->ticket_id }}', '{{ $ticket->reply }}')"
                                style="white-space: nowrap;">Reply</button>

                            @include('super-admin.ticket-modal.reply', [
                                'ticket_id' => $ticket->ticket_id,
                                'reply' => $ticket->reply,
                            ])
                        </td>
                        <td>
                            <select class="status-dropdown" data-ticket-id="{{ $ticket->ticket_id }}">
                                <option value="">Select Status</option>
                                <option value="1" {{ $ticket->status_of_button == 1 ? 'selected' : '' }}>Hold</option>
                                <option value="2" {{ $ticket->status_of_button == 2 ? 'selected' : '' }}>Close</option>
                            </select>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Include jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        $(document).ready(function() {
            $('.status-dropdown').on('change', function() {
                let ticketId = $(this).data('ticket-id'); // Get the ticket ID from data attribute
                let statusValue = $(this).val(); // Get the selected status value

                if (statusValue === "") return; // Do nothing if no value is selected

                // Call your AJAX function to update the status
                updateTicketStatus(ticketId, statusValue);
            });

            function updateTicketStatus(ticketId, statusValue) {
                $.ajax({
                    url: '/update-ticket-status', // Replace with your route URL
                    method: 'POST',
                    data: {
                        ticket_id: ticketId,
                        status_of_button: statusValue,
                        _token: '{{ csrf_token() }}' // Include CSRF token
                    },
                    success: function(response) {
                        if (response.success) {
                            alert('Status updated successfully!');
                            location.reload();
                        } else {
                            alert('Failed to update status. Please try again.');
                        }
                    },
                    error: function(xhr, status, error) {
                        alert('An error occurred: ' + error);
                    }
                });
            }
        });
    </script>
</x-layout.default>
