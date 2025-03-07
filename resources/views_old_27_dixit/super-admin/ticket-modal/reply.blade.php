<!-- Modal HTML -->
<style>
    .modal-section {
        max-height: 400px;
        /* Adjust the height as needed */
        overflow-y: auto;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
    }

    .scrollable-table-container {
        /* max-height: 300px;
    overflow-y: auto;
    overflow-x: hidden;
    margin-top: 10px; */
    }

    .styled-table {
        width: 100%;
        border-collapse: collapse;
    }

    .styled-table th,
    .styled-table td {
        text-align: left;
        padding: 8px;
        border: 1px solid #ddd;
    }

    .styled-table th {
        background-color: #f4f4f4;
        font-weight: bold;
    }

    /* Modal Overlay */
    .modal-overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        display: flex;
        justify-content: center;
        align-items: center;
        background-color: rgba(0, 0, 0, 0.5);
        z-index: 1000;
    }

    /* Modal Content */
    .modal-content {
    background-color: #fff;
    padding: 24px;
    border-radius: 8px;
    width: 90%; /* Increase width percentage */
    max-width: 800px; /* Increase max width */
    max-height: 90vh; /* Set maximum height to 90% of the viewport */
    overflow-y: auto; /* Enable scrolling for overflow content */
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    position: relative;
}


    /* Close Button */
    .modal-close {
        color: #333;
        font-size: 24px;
        font-weight: bold;
        position: absolute;
        top: 12px;
        right: 12px;
        cursor: pointer;
    }

    .modal-close:hover,
    .modal-close:focus {
        color: #000;
    }

    /* Ticket ID Display */
    .ticket-id {
        margin-bottom: 16px;
        font-size: 18px;
        font-weight: 600;
        color: #333;
    }

    /* Form Styling */
    .form-group {
        margin-bottom: 16px;
        text-align: left;
    }

    .form-label {
        display: block;
        margin-bottom: 8px;
        font-size: 14px;
        font-weight: 500;
        color: #555;
    }

    .form-input {
        width: 100%;
        padding: 8px 12px;
        font-size: 14px;
        border: 1px solid #ccc;
        border-radius: 4px;
    }

    /* Form Actions */
    .form-actions {
        text-align: center;
    }

    .btn-primary {
        padding: 10px 16px;
        font-size: 14px;
        font-weight: 600;
        color: #fff;
        background-color: #007bff;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }

    .btn-primary:hover {
        background-color: #0056b3;
    }





    .styled-table {
    width: 100%;
    border-collapse: collapse;
}

.styled-table th, .styled-table td {
    border: 1px solid #ddd;
    padding: 8px;
}

.styled-table tr:nth-child(even) {
    background-color: #f9f9f9;
}

.styled-table tr:hover {
    background-color: #f1f1f1;
}

.inner-table {
    margin: 0 auto;
    border-collapse: collapse;
    width: 100%;
}

.followup-row td {
    text-align: left;
}

</style>
<meta name="csrf-token" content="{{ csrf_token() }}">
{{-- {{ dd($ticket->ticket_id); }} --}}
<div id="myModal" class="modal-overlay" style="display: none;">
    <div class="modal-content">
        <span class="modal-close" onclick="closeModal()">&times;</span>

        <!-- Form Section -->
        <div class="modal-section">
            <h2 class="modal-title">Add Follow-Up</h2>
            <div id="ticket-id-display" class="ticket-id"></div>

            <form id="modalForm" enctype="multipart/form-data" class="modal-form">
                <div class="form-group">
                    <label for="description" class="form-label">Description</label>
                    <textarea id="description" name="description" class="form-input" rows="4"></textarea>
                </div>

                <div class="form-group">
                    <label for="image" class="form-label">Upload Image</label>
                    <input type="file" id="image" name="image" class="form-input" accept="image/*">
                </div>

                <div class="form-actions">
                    <button type="button" class="btn-primary" onclick="submitFormData()">Submit</button>
                </div>
            </form>
            <br>
            <div>
                <table id="ticketsTable" class="styled-table">
                    <thead>
                        <tr>
                            <th>Ticket ID</th>
                            <th>Date & Time</th>
                            <th>Description</th>
                            <th>FollowUp by</th>
                            <th>Image</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($ticket_data as $ticket)
                            @if ($ticket->followUps->isNotEmpty())
                                @foreach ($ticket->followUps as $followUp)
                                    <tr data-ticket-id="{{ $ticket->ticket_id }}">
                                        <td>{{ $ticket->ticket_id }}</td>
                                        <td>{{ $followUp->created_at ?? 'N/A' }}</td>
                                        <td>{{ $followUp->description ?? 'N/A' }}</td>
                                        <td>
                                            @php
                                                $roles = [
                                                    0 => 'Superadmin',
                                                    2 => 'Building Security',
                                                    3 => 'Building Tenant',
                                                    4 => 'School Admin',
                                                    5 => 'School Security'
                                                ];
                                                $role = $roles[$followUp->follow_up_by] ?? 'Building Admin';
                                            @endphp
                                            {{-- {{ $followUp->follow_up_by ?? 'N/A' }} ({{ $role }}) --}}
                                            ({{ $role }})
                                        </td>
                                        <td>
                                            @if ($followUp->image)
                                                <img src="{{ asset($followUp->image) }}" alt="image"
                                                    class="object-cover" style="width: 50px; height: 50px;" />
                                            @else
                                                N/A
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr data-ticket-id="{{ $ticket->ticket_id }}">
                                    <td>{{ $ticket->ticket_id }}</td>
                                    <td colspan="4" class="text-center">No Follow-ups Available</td>
                                </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>
            </div>


        </div>
    </div>
</div>






<script>
    function openModal(ticketId) {
        // Display the Ticket ID in the modal
        document.getElementById("ticket-id-display").innerText = `Ticket ID: ${ticketId}`;
        document.getElementById("myModal").style.display = "flex";
        document.getElementById("modalForm").dataset.ticketId = ticketId;

        // Filter table data by ticket_id
        const rows = document.querySelectorAll("#ticketsTable tbody tr");
        rows.forEach(row => {
            const rowTicketId = row.dataset.ticketId; // Assuming each row has a `data-ticket-id` attribute
            if (rowTicketId === ticketId) {
                row.style.display = ""; // Show the matching row
            } else {
                row.style.display = "none"; // Hide non-matching rows
            }
        });
    }


    function submitFormData() {
        const ticketId = document.getElementById("modalForm").dataset.ticketId;
        const formData = new FormData(document.getElementById('modalForm'));
        formData.append('ticket_id', ticketId);


        // Handle the live link input
        const liveLink = window.location.href;
        formData.append('live_link', liveLink);
        // Check if a file was selected
        const fileInput = document.getElementById('image');


        // You can optionally handle the file type validation here


        fetch('/save-description-image', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Data saved successfully.');
                    closeModal();
                } else {
                    alert('Failed to save data: ' + data.message);
                }
            })
            .catch(error => console.error('Error:', error));
    }

    function closeModal() {
        document.getElementById("myModal").style.display = "none";
        document.getElementById('modalForm').reset();

        // Reset the table rows to show all data
        const rows = document.querySelectorAll("#ticketsTable tbody tr");
        rows.forEach(row => {
            row.style.display = ""; // Show all rows
        });
    }
</script>
