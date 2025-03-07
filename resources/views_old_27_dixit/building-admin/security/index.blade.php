<x-layout.default>
    <div class="flex justify-center mb-4">
        <h1 class="text-2xl font-bold">Security List</h1>
    </div>

    <div class="flex justify-start items-center mb-4 space-x-2">
        <form method="GET" action="{{ route('building-admin.security-index') }}">
            <label for="statusFilter" class="whitespace-nowrap"><strong>Filter by Status:</strong></label>
            <select id="statusFilter" name="statusFilter" class="form-input w-32" onchange="this.form.submit()">
                <option value="all" {{ request('statusFilter') == 'all' ? 'selected' : '' }}>All</option>
                <option value="active" {{ request('statusFilter') == 'active' ? 'selected' : '' }}>Active</option>
                <option value="inactive" {{ request('statusFilter') == 'inactive' ? 'selected' : '' }}>Inactive</option>
            </select>
        </form>
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
                </tr>
            </thead>
            <tbody>
                @foreach($security_data as $key => $security)
                    <tr>
                        <td class="py-2 px-6">{{ $key + 1 }}</td>
                        <td class="py-2 px-8">
                            <img src="{{ asset($security->photo) }}" alt="image" class="w-24 h-24 object-cover mb-5" />
                        </td>
                        <td class="py-2 px-8">{{ $security->name }}</td>
                        <td class="py-2 px-8">{{ $security->contact }}</td>
                        <td class="py-2 px-8">{{ $security->whatsup }}</td>
                        <td class="py-2 px-8">{{ $security->email }}</td>
                        <td class="py-2 px-8">{{ $security->workingFromDate }}</td>
                        <td class="text-center py-2 px-8">
                            <a href="{{ route('building-admin.security-edit', ['id' => $security->id]) }}" title="Edit">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-5 h-5 text-blue-600">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-4.036a2.5 2.5 0 113.536 3.536L7.5 21H3v-4.5L16.732 4.732z"/>
                                </svg>
                            </a>
                        </td>
                        <td class="py-2 px-8">
                            <form action="{{ route('building-admin.security-status', $security->id) }}" method="post">
                                @csrf
                                @method('PATCH')
                                <input type="hidden" name="status" value="{{ $security->status == 1 ? 0 : 1 }}">
                                <button type="submit" class="btn {{ $security->status ? 'btn-success' : 'btn-danger' }}">
                                    {{ $security->status ? 'Active' : 'Inactive' }}
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-layout.default>
