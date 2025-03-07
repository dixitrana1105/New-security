<x-layout.default>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <div class="flex justify-center mb-4">
        <h1 class="text-2xl font-bold">Security List</h1>
    </div>
    <div class="flex justify-start items-center mb-4 space-x-2">
        <label for="statusFilter" class="whitespace-nowrap"><strong>Filter by Status:</strong></label>
        <select id="statusFilter" class="form-input w-32" @change="filterStatus($event)">
            <option value="all">All</option>
            <option value="active">Active</option>
            <option value="inactive">Inactive</option>
        </select>
    </div>
    <br>
    <div class="table-responsive">
        <table class="min-w-full shadow-lg rounded-lg overflow-hidden">
            <thead>
                <tr>
                    <th class="font-bold py-2 px-6">S.No</th>
                    <th class="font-bold py-2 px-8">Photo</th>
                    <th class="font-bold py-2 px-8">Name</th>
                    <th class="font-bold py-2 px-8">Contact Number</th>
                    <th class="font-bold py-2 px-8">WhatsApp Number</th>
                    <th class="font-bold py-2 px-8">Email ID</th>
                    <th class="font-bold py-2 px-8">Working From Date</th>
                    <th class="font-bold text-center py-2 px-8">Action</th>
                    <th class="font-bold py-2 px-8">Status</th>
                    <th class="font-bold py-2 px-8">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($security_data as $key => $security)
                    <tr>
                        <td class="py-2 px-6">{{ $key + 1 }}</td>
                        <td class="py-2 px-8">
                            <img src="{{ asset($security->photo) }}" alt="image"
                                class="w-24 h-24 object-cover mb-5" />
                        </td>
                        <td class="py-2 px-8">{{ $security->name }}</td>
                        <td class="py-2 px-8">{{ $security->contact }}</td>
                        <td class="py-2 px-8">{{ $security->whatsup }}</td>
                        <td class="py-2 px-8">{{ $security->email }}</td>
                        <td class="py-2 px-8">{{ $security->workingFromDate }}</td>
                        <td class="text-center py-2 px-8">
                            <a href="{{ route('building-tenant.security-show', ['id' => $security->id]) }}"
                                title="show">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24"
                                    height="24">
                                    <g fill="none" stroke="black" stroke-width="2">
                                        <circle cx="12" cy="12" r="3" fill="black" />
                                        <path d="M1 12c3.5-5 9-8 11-8s7.5 3 11 8c-3.5 5-9 8-11 8S4.5 17 1 12z" />
                                    </g>
                                </svg>
                            </a>
                        </td>
                        <td>
                            <input type="hidden" name="status" value="{{ $security->status == 1 ? 0 : 1 }}">
                            <button type="submit" class="btn {{ $security->status ? 'btn-success' : 'btn-danger' }}">
                                {{ $security->status ? 'Active' : 'Inactive' }}
                            </button>
                        </td>
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
                    receiver_user_type: 'security',
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
