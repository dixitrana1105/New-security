<x-layout.default>
    <div class="flex justify-center mb-4">
        <h1 class="text-2xl font-bold">Sub User List</h1>
    </div>

    <div class="flex justify-start items-center mb-4 space-x-2">
        <label for="statusFilter" class="whitespace-nowrap"><strong>User:</strong></label>
        <select id="statusFilter" class="form-input w-32" @change="filterStatus($event)">
            <option value="all">All</option>
            @foreach($tenant_data as $tenant)
                <option value="{{ $tenant->sub_tenant_id }}">{{ $tenant->sub_tenant_id }}</option>
            @endforeach
        </select>
    </div>

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
            <tbody id="tenantTableBody">
               @foreach($tenant_data as $key => $security)
                    <tr class="tenant-row" data-tenant-id="{{ $security->sub_tenant_id }}">
                        <td class="py-2 px-6">{{ $key + 1 }}</td>
                        <td class="py-2 px-8">{{ $security->tenant_id }}</td>
                        <td class="py-2 px-8">{{ $security->flat_office_no }}</td>
                        <td class="py-2 px-8">{{ $security->sub_tenant_id }}</td>
                        <td class="py-2 px-8">{{ $security->contact_person }}</td>
                        <td class="py-2 px-8">{{ $security->contact_number }}</td>
                        <td class="py-2 px-8">{{ $security->whatsapp_no }}</td>
                        <td>
                            <button type="button" class="btn {{ $security->status ? 'btn-success' : 'btn-danger' }}">
                                {{ $security->status ? 'Active' : 'Inactive' }}
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <script>
        function filterStatus(event) {
            const selectedTenantId = event.target.value;
            const rows = document.querySelectorAll('.tenant-row');

            rows.forEach(row => {
                const tenantId = row.getAttribute('data-tenant-id');

                if (selectedTenantId === 'all' || tenantId === selectedTenantId) {
                    row.style.display = ''; // Show the row
                } else {
                    row.style.display = 'none'; // Hide the row
                }
            });
        }
    </script>
</x-layout.default>
