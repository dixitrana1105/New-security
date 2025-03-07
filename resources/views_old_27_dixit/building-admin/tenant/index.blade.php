<x-layout.default>
    <div class="flex justify-center mb-4">
        <h1 class="text-2xl font-bold">Tenant List</h1>
    </div>
    <form method="GET" class="container mt-3">
        <div class="flex gap-2">
        <div class="flex justify-start items-center mb-4 space-x-2">
            <label for="statusFilter" class="whitespace-nowrap"><strong>Filter by Status:</strong></label>
            <select id="statusFilter" name="status" class="form-input w-32" @change="filterStatus($event)">
                <option value="">All</option>
                <option value="1" {{ request()->input('status') == '1' ? 'selected' : '' }}>Active
                </option>
                <option value="0" {{ request()->input('status') == '0' ? 'selected' : '' }}>Inactive
                </option>
            </select>
        </div>
        <div class="form-group-item">
            <button type="submit" class="btn btn-primary">Filter</button>
        </div>
        </div>
    </form>
<br>
    <div class="table-responsive">
        <table class="min-w-full shadow-lg rounded-lg overflow-hidden">
            <thead>
                <tr>
                    <th class="font-bold py-2 px-6">S.No</th>
                    <th class="font-bold py-2 px-8">Register Date</th>
                    <th class="font-bold py-2 px-8">Building Name</th>
                    <th class="font-bold py-2 px-8">User ID</th>
                    <th class="font-bold py-2 px-8">Flat/Office Number</th>
                    <th class="font-bold py-2 px-8">Contact Person</th>
                    <th class="font-bold py-2 px-8">Contact Number</th>
                    <th class="font-bold py-2 px-8">WhatsApp Number</th>
                    <th class="font-bold py-2 px-8">Emergency Contact Number</th>
                    <th class="font-bold py-2 px-8">Email ID</th>
                    <th class="font-bold py-2 px-8">No. of Sub User</th>
                    <th class="font-bold text-center py-2 px-8">Action</th>
                    <th class="font-bold py-2 px-8">Status</th>
                </tr>
            </thead>
            <tbody>
                <tr class="border-b duration-300">
                    @foreach($tenant as $key => $item)
                    <tr class="border-b duration-300">
                        <td>{{$key + 1}}</td>
                        <td>{{$item->date}}</td>
                        <td>{{$item->Building_Master->name}}</td>
                        <td>{{$item->tenant_id}}</td>
                        <td>{{$item->flat_office_no}}</td>
                        <td>{{$item->contact_person}}</td>
                        <td>{{$item->contact_number}}</td>
                        <td>{{$item->whatsapp_no}}</td>
                        <td>{{$item->emergency_contact_no}}</td>
                        <td>{{$item->email}}</td>
                        <td>{{$item->no_sub_user}}</td>
                        <td>
                        <a href="{{route('building-admin.tenant-edit', $item->id)}}" title="Edit">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-5 h-5 text-blue-600">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-4.036a2.5 2.5 0 113.536 3.536L7.5 21H3v-4.5L16.732 4.732z"/>
                        </svg>
                        </a>
                        </td>
                        <td>
                            <form action="{{ route('building-admin.tenant-status', $item->id) }}" method="post">
                                @csrf
                                @method('PATCH')
                                <input type="hidden" name="status" value="{{ $item->status == 1 ? 0 : 1 }}">
                                <button type="submit" class="btn {{ $item->status ? 'btn-success' : 'btn-danger' }}">
                                    {{ $item->status ? 'Active' : 'Inactive' }}
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tr>
            </tbody>
        </table>
    </div>
</x-layout.default>
