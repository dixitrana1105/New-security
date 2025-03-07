<x-layout.default>
    <div class="flex justify-center mb-4">
        <h1 class="text-2xl font-bold">My Ticket List</h1>
    </div>
    <br>
    <div class="table-responsive">
        <table class="min-w-full shadow-lg rounded-lg overflow-hidden">
            <thead>
                <tr>
                    <th class="font-bold py-2 px-6">S.No</th>
                    <th class="font-bold py-2 px-8">Attachment </th>
                    <th class="font-bold py-2 px-8">Ticket ID</th>
                    <th class="font-bold py-2 px-8">Date & Time</th>
                    <th class="font-bold py-2 px-8">Subject</th>
                    <th class="font-bold py-2 px-8">To</th>
                    <th class="font-bold py-2 px-8">Description</th>
                    <th class="font-bold py-2 px-8">Reply (Popup Form with Editor)</th>
                </tr>
            </thead>
            <tbody>
                @foreach($ticket_data as $key => $ticket)
                    <tr class="border-b duration-300">

                        <td class="py-2 px-6">{{ $key + 1 }}</td>
                        <td class="py-2 px-8">
                            <img src="{{ asset($ticket->attachment) }}" alt="image" class="object-cover mb-5" />
                        </td>
                        <td class="py-2 px-8">{{ $ticket->ticket_id ?? 'N/A' }}</td>
                        <td class="py-2 px-8">{{ $ticket->date_time ?? 'N/A' }}</td>
                        <td class="py-2 px-8">{{ $ticket->subject ?? 'N/A' }}</td>
                        <td class="py-2 px-8">{{ $ticket->role ?? 'N/A' }}</td>
                        <td class="py-2 px-8" >{{ $ticket->description ?? 'No description provided' }}</td>
                        <td>
                            <a href="#" class="btn btn-outline-primary"
                               onclick="openModal('{{ $ticket->ticket_id }}', '{{ $ticket->reply }}')"
                               style="white-space: nowrap;">Reply</a>

                            @include('super-admin.ticket-modal.reply', ['ticket_id' => $ticket->ticket_id, 'reply' => $ticket->reply])
                        </td>


                    </tr>
                @endforeach
            </tbody>

        </table>
    </div>
</x-layout.default>
