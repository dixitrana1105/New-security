<x-layout.default>
    <div class="flex justify-center mb-4">
        <h1 class="text-2xl font-bold">Sub User List</h1>
    </div>
    <form method="GET" class="container mt-3">
    <div class="flex gap-2">
    <div class="flex justify-start items-center mb-4 space-x-2">
        <label for="statusFilter" class="whitespace-nowrap"><strong>User:</strong></label>
        <select id="statusFilter" name="subtenant" class="form-input w-52" @change="filterStatus($event)">
            <option value="">Select Sub User</option>
                @isset($sub_tenant_filter)
                @foreach ($sub_tenant_filter as $subtenantList)
                    <option value="{{ $subtenantList->id }}"
                        >{{ $subtenantList->contact_person }}
                    </option>
                @endforeach
                @endisset
        </select>
    </div>
    <div class="form-group-item">
        <button type="submit" class="btn btn-primary">Filter</button>
    </div>
    </div>
</form>
      <div class="table-responsive">
        <table class="min-w-full shadow-lg rounded-lg overflow-hidden">
            <thead>
                <tr>
                    <th class="font-bold py-2 px-6">S.No</th>
                    <th class="font-bold py-2 px-8">User ID</th>
                    <th class="font-bold py-2 px-8">Flat/Office Number</th>
                    <th class="font-bold py-2 px-8">Sub User ID</th>
                    <th class="font-bold py-2 px-8">Sub User Name</th>
                    <th class="font-bold py-2 px-8">Sub User Contact Number</th>
                    <th class="font-bold py-2 px-8">Sub User WhatsApp Number</th>
                    <th class="font-bold py-2 px-8">Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($sub_tenant as $key => $item)
                <tr class="border-b duration-300">
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $item->tenant_id }}</td>
                    <td>{{ $item->flat_office_no }}</td>
                    <td>{{ $item->sub_tenant_id }}</td>
                    <td>{{ $item->contact_person }}</td>
                    <td>{{ $item->contact_number }}</td>
                    <td>{{ $item->whatsapp_no }}</td>
                    <td>
                        <form action="{{ route('building-tenant.sub-tenant-status', $item->id) }}" method="post">
                            @csrf
                            @method('PATCH')
                            <input type="hidden" name="status" value="{{ $item->status == 1 ? 0 : 1 }}">
                            <button type="submit" class="btn {{ $item->status ? 'btn-success' : 'btn-danger' }}">
                                {{ $item->status ? 'Active' : 'Inactive' }}
                            </button>
                        </form>
                    </td>
                    @endforeach
                </tr>
            </tbody>
        </table>
    </div>
</x-layout.default>
