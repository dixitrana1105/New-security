<x-layout.default>
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
                </tr>
            </thead>
            <tbody>
                <tr class="border-b duration-300">
                    <td class="py-2 px-6">1</td>
                    <td class="py-2 px-8">
                        <img src="https://via.placeholder.com/50" alt="User Photo" class="w-12 h-12 rounded-full">
                    </td>
                    <td class="py-2 px-8">John Doe</td>
                    <td class="py-2 px-8">+1234567890</td>
                    <td class="py-2 px-8">+0987654321</td>
                    <td class="py-2 px-8">john.doe@example.com</td>
                    <td class="py-2 px-8">2022-01-15</td>
                    <td class="text-center py-2 px-8">
                        <a href="/building-admin/security-edit" title="Edit">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-5 h-5 text-blue-600">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-4.036a2.5 2.5 0 113.536 3.536L7.5 21H3v-4.5L16.732 4.732z"/>
                            </svg>
                        </a>
                    </td>
                    <td class="py-2 px-8">
                        <button class="btn-success text-white font-bold py-1 px-4 rounded shadow-md transition duration-300">
                            Active
                        </button>
                    </td>
                </tr>
                <tr class="border-b duration-300">
                    <td class="py-2 px-6">2</td>
                    <td class="py-2 px-8">
                        <img src="https://via.placeholder.com/50" alt="User Photo" class="w-12 h-12 rounded-full">
                    </td>
                    <td class="py-2 px-8">Jane Smith</td>
                    <td class="py-2 px-8">+1234567891</td>
                    <td class="py-2 px-8">+0987654322</td>
                    <td class="py-2 px-8">jane.smith@example.com</td>
                    <td class="py-2 px-8">2023-02-20</td>
                    <td class="text-center py-2 px-8">
                        <a href="/building-admin/security-edit" title="Edit">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-5 h-5 text-blue-600">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-4.036a2.5 2.5 0 113.536 3.536L7.5 21H3v-4.5L16.732 4.732z"/>
                            </svg>
                        </a>
                    </td>
                    <td class="py-2 px-8">
                        <button class="btn-danger text-white font-bold py-1 px-4 rounded shadow-md transition duration-300">
                            Inactive
                        </button>
                    </td>
                </tr>
                <tr class="border-b duration-300">
                    <td class="py-2 px-6">3</td>
                    <td class="py-2 px-8">
                        <img src="https://via.placeholder.com/50" alt="User Photo" class="w-12 h-12 rounded-full">
                    </td>
                    <td class="py-2 px-8">Alice Johnson</td>
                    <td class="py-2 px-8">+1234567892</td>
                    <td class="py-2 px-8">+0987654323</td>
                    <td class="py-2 px-8">alice.johnson@example.com</td>
                    <td class="py-2 px-8">2023-03-30</td>
                    <td class="text-center py-2 px-8">
                        <a href="/building-admin/security-edit" title="Edit">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-5 h-5 text-blue-600">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-4.036a2.5 2.5 0 113.536 3.536L7.5 21H3v-4.5L16.732 4.732z"/>
                            </svg>
                        </a>
                    </td>
                    <td class="py-2 px-8">
                        <button class="btn-success text-white font-bold py-1 px-4 rounded shadow-md transition duration-300">
                            Active
                        </button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</x-layout.default>
