<x-layout.default>
    <div class="flex justify-center mb-4">
        <h1 class="text-2xl font-bold">Hold Ticket</h1>
    </div>
    <div class="table-responsive" x-data="form">
        <table class="min-w-full shadow-lg rounded-lg overflow-hidden">
            <thead>
                <tr>
                    {{-- <th class="font-bold py-2 px-6">S.No</th> --}}
                    <th class="font-bold py-2 px-6">Attechment</th>
                    <th class="font-bold py-2 px-8">Ticket Id</th>
                    <th class="font-bold py-2 px-8">Date & Time</th>
                    <th class="font-bold py-2 px-8">Subject</th>
                    <th class="font-bold py-2 px-8">From</th>
                    <th class="font-bold py-2 px-8">Person Name</th>
                    <th class="font-bold py-2 px-8">Description (View Button)</th>
                    <th class="font-bold py-2 px-8">Reply (Popup Form with Editor)</th>
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
                        <td>Building Admin</td>
                        <td>{{ $ticket->building->name ?? 'N/A' }}</td>
                        <td>
                          {{ $ticket->description }}
                        </td>
                        <td>
                            <a href="#" class="btn btn-outline-primary"
                                onclick="openModal('{{ $ticket->ticket_id }}', '{{ $ticket->reply }}')"
                                style="white-space: nowrap;">Reply</a>

                            @include('super-admin.ticket-modal.reply', [
                                'ticket_id' => $ticket->ticket_id,
                                'reply' => $ticket->reply,
                            ])
                        </td>
                    </tr>
                @endforeach

            </tbody>

            <tbody>
                @foreach ($get_all_ticket_from_school_secutity as $ticket)
                    <tr class="border-b duration-300">
                        {{-- <td>{{ $loop->iteration }}</td> <!-- Serial Number --> --}}
                        <td class="py-2 px-8">
                            <img src="{{ asset($ticket->attachment) }}" alt="image" class="object-cover mb-5" />
                        </td>
                        <td>{{ $ticket->ticket_id }}</td>
                        <td>{{ $ticket->date_time }}</td>
                        <td>{{ $ticket->subject }}</td>
                        <td>School Security</td>
                        <td>{{ $ticket->building->name ?? 'N/A' }}</td>
                        <td>
                           {{ $ticket->description }}
                        </td>
                        <td>
                            <a href="#" class="btn btn-outline-primary"
                                onclick="openModal('{{ $ticket->ticket_id }}', '{{ $ticket->reply }}')"
                                style="white-space: nowrap;">Reply</a>

                            @include('super-admin.ticket-modal.reply', [
                                'ticket_id' => $ticket->ticket_id,
                                'reply' => $ticket->reply,
                            ])
                        </td>
                    </tr>
                @endforeach

            </tbody>
        </table>
    </div>

    <script>
        document.addEventListener("alpine:init", () => {
            Alpine.data("form", () => ({
                tableData: [
                    {
                        id: 1,
                        date: '4-10-24',
                        tentorschool: 'Greenwood High',
                        name: 'Uhas',
                        subject: 'english',
                        contact_person: 'Jane Doe',
                        contact_number: '+123456789',
                        email: 'janedoe@school.com',
                        tenant_person_count: 10,
                        security_person_count: 10,
                        ticket_id: '0001',
                    },
                    // Add more objects as needed
                ],
            }));
        });
    </script>
</x-layout.default>
