<x-layout.default>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <div class="flex justify-center mb-4">
        <h1 class="text-2xl font-bold">Tenant List</h1>
    </div>
    <!-- <div class="flex justify-start items-center mb-4 space-x-2">
        <label for="statusFilter" class="whitespace-nowrap"><strong>Filter by Status:</strong></label>
        <select id="statusFilter" class="form-input w-32" @change="filterStatus($event)">
            <option value="all">All</option>
            <option value="active">Active</option>
            <option value="inactive">Inactive</option>
        </select>
    </div> -->
    <br>
    <div class="table-responsive">
        <table class="min-w-full shadow-lg rounded-lg overflow-hidden">
            <thead>
                <tr>
                    <th class="font-bold py-2 px-6">S.No</th>
                    <th class="font-bold py-2 px-8">Register Date</th>
                    <th class="font-bold py-2 px-8">Tenant ID</th>
                    <th class="font-bold py-2 px-8">Flat/Office Number</th>
                    <th class="font-bold py-2 px-8">Contact Number</th>
                    <th class="font-bold py-2 px-8">Contact Person</th>
                    <th class="font-bold py-2 px-8">WhatsApp Number</th>
                    <th class="font-bold py-2 px-8">Emergency Contact Number</th>
                    <th class="font-bold py-2 px-8">Email ID</th>
                    <th class="font-bold py-2 px-8">No. of Sub User</th>
                    <th class="font-bold py-2 px-8">Action</th>
                    <!-- <th class="font-bold py-2 px-8">Status</th> -->
                </tr>
            </thead>
            <tbody>
                @foreach ($tenant_data as $key => $security)
                    <tr>
                        <td class="py-2 px-6">{{ $key + 1 }}</td>
                        <td class="py-2 px-8">{{ $security->date }}</td>
                        <td class="py-2 px-8">{{ $security->tenant_id }}</td>
                        <td class="py-2 px-8">{{ $security->flat_office_no }}</td>
                        <td class="py-2 px-8">{{ $security->contact_number }}</td>
                        <td class="py-2 px-8">{{ $security->contact_person }}</td>
                        <td class="py-2 px-8">{{ $security->whatsapp_no }}</td>
                        <td class="py-2 px-8">{{ $security->emergency_contact_no }}</td>
                        <td class="py-2 px-8">{{ $security->email }}</td>
                        <td class="py-2 px-8">{{ $security->no_sub_user }}</td>
                        <td class="py-2 px-8">
                            <button
                                class="btn-primary text-white font-bold py-1 px-4 rounded shadow-md transition duration-300"
                                onclick="newMessage('{{ $security->id }}')">
                                Message
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    @php
        $sender_id = Auth::guard('buildingtenant')->check()
            ? Auth::guard('buildingtenant')->user()->id
            : (Auth::guard('buildingSecutityadmin')->check()
                ? Auth::guard('buildingSecutityadmin')->user()->id
                : null);
    @endphp

    <script>
        let senderId = "{{ $sender_id }}";

        function newMessage(id) {
            $.ajax({
                url: "{{ route('tenant-send-message') }}",
                type: 'POST',
                data: {
                    reciever_id: id,
                    sender_id: senderId,
                    _token: $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    if (response.status === 200 && response.data.redirect) {
                        window.location.href = response.data.redirect + '?reciever_id=' + response.data
                            .reciever_id + '&sender_id=' + response.data.sender_id +
                            '&receiver_type=' + response.data.reciever_type + '&sender_type=' + response.data
                            .sender_type;
                    } else {
                        alert('Failed to send message. Please try again.');
                    }
                },
                error: function(xhr, status, error) {
                    alert('An error occurred: ' + error);
                }
            });
        }
    </script>

</x-layout.default>
