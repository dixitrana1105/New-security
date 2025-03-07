<x-layout.default>
    <style>
        /* Modal Overlay */
        .modal-overlay {
            position: fixed;
            z-index: 1000;
            /* High z-index to ensure it sits on top */
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        /* Modal Content */
        .modal-content_1 {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            width: 500px;
            /* Increase the width here */
            text-align: center;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            position: relative;
            /* Ensures close button positioning is relative to modal */
        }


        /* Close Button */
        .modal-close {
            color: #aaa;
            font-size: 28px;
            font-weight: bold;
            position: absolute;
            top: 10px;
            right: 10px;
            cursor: pointer;
        }

        .modal-close:hover,
        .modal-close:focus {
            color: black;
        }

        .form-group {
            display: flex;
            flex-direction: column;
            /* Keeps items stacked vertically */
        }

        .form-group-item {
            display: flex;
            align-items: center;
            /* Centers items vertically */
            margin-bottom: 1rem;
            /* Space between fields */
        }

        .form-group-item label {
            width: 30%;
            /* Adjust as needed for label width */
            margin-right: 1rem;
            /* Space between label and input */
            text-align: right;
            /* Aligns text to the right within the label */
            font-weight: bold;
        }

        .form-group-item input {
            width: 70%;
            /* Adjust as needed to fill the remaining space */
            padding: 0.5rem;
            /* Add padding for better usability */
            border-radius: 4px;
            /* Rounded corners for input */
            border: 1px solid #ddd;
            /* Border style for input */
        }

        .text-red {
            color: red;
        }
    </style>
    <div class="flex justify-center mb-4">
        <h1 class="text-2xl font-bold">Close Ticket</h1>
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
                            <a href="#" class="btn btn-primary" onclick="openModal_1('{{ $loop->iteration }}')">
                                View
                            </a>
                            <div id="myModal_{{ $loop->iteration }}" class="modal-overlay" style="display: none;">
                                <div class="modal-content_1">
                                    <span class="modal-close"
                                        onclick="closeModal_1('{{ $loop->iteration }}')">&times;</span>
                                    <p>{{ $ticket->description }}</p>
                                </div>
                            </div>
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
                @foreach ($get_all_ticket_from_security as $ticket)
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
                            <a href="#" class="btn btn-primary" onclick="openModal_1('{{ $loop->iteration }}')">
                                View
                            </a>
                            <div id="myModal_{{ $loop->iteration }}" class="modal-overlay" style="display: none;">
                                <div class="modal-content_1">
                                    <span class="modal-close"
                                        onclick="closeModal_1('{{ $loop->iteration }}')">&times;</span>
                                    <p>{{ $ticket->description }}</p>
                                </div>
                            </div>
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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        document.addEventListener("alpine:init", () => {
            Alpine.data("form", () => ({
                tableData: [{
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
                }, ],
            }));
        });

        function openModal_1(id) {
            document.getElementById(`myModal_${id}`).style.display = "flex";
        }

        function closeModal_1(id) {
            document.getElementById(`myModal_${id}`).style.display = "none";
        }

        window.onclick = function(event) {
            const modals = document.querySelectorAll(".modal-overlay");
            modals.forEach((modal) => {
                if (event.target == modal) {
                    modal.style.display = "none";
                }
            });
        };
    </script>

</x-layout.default>
