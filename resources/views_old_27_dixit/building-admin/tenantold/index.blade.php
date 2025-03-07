<x-layout.default>
    <div class="flex justify-center mb-4">
        <h1 class="text-2xl font-bold">Tenant List</h1>
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
                    <th class="font-bold py-2 px-8">Register Date</th>
                    <th class="font-bold py-2 px-8">Tenant ID</th>
                    <th class="font-bold py-2 px-8">Flat/Office Number</th>
                    <th class="font-bold py-2 px-8">Contact Number</th>
                    <th class="font-bold py-2 px-8">Contact Person</th>
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
                    <td>1</td>
                    <td>15-05-2045</td>
                    <td>TN85478</td>
                    <td>85489</td>
                    <td>1234567896</td>
                    <td>Joan</td>
                    <td>8574856963</td>
                    <td>5484878774</td>
                    <td>example@gmail.com</td>
                    <td>2</td>
                    <td>
                        <a href="/building-admin/tenant-edit" title="Edit">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-5 h-5 text-blue-600">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-4.036a2.5 2.5 0 113.536 3.536L7.5 21H3v-4.5L16.732 4.732z"/>
                            </svg>
                        </a>
                    </td>
                    <td>
                        <button class="btn-success text-white font-bold py-1 px-4 rounded shadow-md transition duration-300">
                            Active
                        </button>
                    </td>
                </tr>
                <tr class="border-b duration-300">
                    <td>2</td>
                    <td>20-07-2045</td>
                    <td>TN85479</td>
                    <td>85490</td>
                    <td>1234567897</td>
                    <td>Mike</td>
                    <td>8574856964</td>
                    <td>5484878775</td>
                    <td>example2@gmail.com</td>
                    <td>1</td>
                    <td>
                        <a href="/building-admin/tenant-edit" title="Edit">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-5 h-5 text-blue-600">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-4.036a2.5 2.5 0 113.536 3.536L7.5 21H3v-4.5L16.732 4.732z"/>
                            </svg>
                        </a>
                    </td>
                    <td>
                        <button class="btn-danger text-white font-bold py-1 px-4 rounded shadow-md transition duration-300">
                            Inactive
                        </button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</x-layout.default>
