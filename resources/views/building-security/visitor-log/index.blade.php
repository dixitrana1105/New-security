<x-layout.default>
    <div class="flex justify-center mb-4">
        <h1 class="text-2xl font-bold">Visitor Log List</h1>
    </div>
    <form method="GET" action="{{ route('building-security.visitor-log') }}" class="flex justify-start items-center mb-4 space-x-4">
    <!-- Tenant Filter -->
    <div class="flex items-center space-x-2">
                <label for="tenant_flat_office_no"><strong>Tenant</strong></label>
                <select id="tenant_flat_office_no" name="tenant_flat_office_no" class="form-input">
        <option value="">All Flat/No</option>
        @foreach ($tenants->pluck('tenant_flat_office_no')->unique() as $tenant_flat_office_no)
            <option value="{{ $tenant_flat_office_no }}" 
                {{ request('tenant_flat_office_no') == $tenant_flat_office_no ? 'selected' : '' }}>
                {{ $tenant_flat_office_no ?? 'Tenant Id' }}
            </option>
        @endforeach
    </select>
    </div>

    <!-- Date From Filter -->
    <div class="flex items-center space-x-2">
        <label for="dateFrom" class="whitespace-nowrap"><strong>Date From:</strong></label>
        <input type="date" id="dateFrom" name="dateFrom" class="form-input" value="{{ request('dateFrom') }}">
    </div>

    <!-- Date To Filter -->
    <div class="flex items-center space-x-2">
        <label for="dateTo" class="whitespace-nowrap"><strong>Date To:</strong></label>
        <input type="date" id="dateTo" name="dateTo" class="form-input" value="{{ request('dateTo') }}">
    </div>

    <!-- Status Filter -->
    <div class="flex items-center space-x-2">
        <label for="statusFilter" class="whitespace-nowrap"><strong>Status:</strong></label>
        <select id="statusFilter" name="status" class="form-input w-32">
            <option value="all" {{ request('status') == 'all' ? 'selected' : '' }}>All</option>
            <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Active</option>
            <option value="inactive" {{ request('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
        </select>
    </div>
    <div class="flex items-center">
        <button type="submit" class="btn btn-primary rounded">Filter</button>
    </div>
</form>


    <br>

    <div class="table-responsive">
        <table class="min-w-full shadow-lg rounded-lg overflow-hidden">
            <thead>
                <tr>
                    <th class="font-bold py-2 px-6">S.No</th>
                    <th class="font-bold py-2 px-8">Visitor ID</th>
                    <th class="font-bold py-2 px-8">Date</th>
                    <th class="font-bold py-2 px-8">Photo</th>
                    <th class="font-bold py-2 px-8">Full Name</th>
                    <th class="font-bold py-2 px-8">Flate / Office No</th>
                    <th class="font-bold py-2 px-8">In Time</th>
                    <th class="font-bold py-2 px-8">ID Proof</th>
                    <th class="font-bold py-2 px-8">Visiter Purpose</th>
                    <!-- <th class="font-bold py-2 px-8">Previous Log</th> -->
                    <th class="font-bold py-2 px-8">Status</th>
                </tr>
            </thead>
            <tbody>
            @foreach($security_data as $key => $security)

<tr>
            <td class="py-2 px-6">{{ $key + 1 }}</td>
            <td class="py-2 px-8">{{ $security->visitor_id }}</td>
            <td class="py-2 px-8">{{ $security->date }}</td>
            <td class="py-2 px-8">
                            <img src="{{ asset($security->photo) }}" alt="image" class="w-32 h-32 object-cover mb-5" />
                        </td>
        <td class="py-2 px-8">{{ $security->full_name }}</td>
            <td class="py-2 px-8">{{ $security->tenant_flat_office_no }}</td>
            <td class="py-2 px-8">{{ $security->in_time }}</td>
            <td class="py-2 px-8">
                            <img src="{{ asset($security->id_proof) }}" alt="image" class="w-32 h-32 object-cover mb-5" />
                        </td>
            <td class="py-2 px-8">{{ $security->visiter_purpose }}</td>
            <!-- <td>
            <div class="container mt-5">
                            <div x-data="modal">
                                <button type="button" class="btn btn-primary" @click="toggle"
                                    style="width: 100px; float:right; margin-bottom: 8px;">Previous Log </button>
                                <div class="fixed inset-0 bg-[black]/60 z-[999]  hidden" :class="open && '!block'">
                                    <div class="flex items-start justify-center min-h-screen px-4"
                                        @click.self="open = false">
                                        <div x-show="open" x-transition x-transition.duration.300
                                            class="panel border-0 p-0 rounded-lg overflow-hidden w-full max-w-5xl my-8">
                                            <div
                                                class="flex bg-[#fbfbfb] dark:bg-[#121c2c] items-center justify-between px-5 py-3">
                                                <h5 class="font-bold text-lg">Previous Log List</h5>
                                                <button type="button" class="text-white-dark hover:text-dark"
                                                    @click="toggle"><svg style="max-height: 40px;" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x">
                                                        <line x1="18" y1="6" x2="6" y2="18"></line>
                                                        <line x1="6" y1="6" x2="18" y2="18"></line>
                                                      </svg>
                                                      </button>
                                            </div>
                                            <div class="p-5">
                                                @include('building-security.visitor-log.previous-log')
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
        </td> -->
        <td>

                                <input type="hidden" name="status" value="{{ $security->status == 1 ? 0 : 1 }}">
                                <button type="submit" class="btn {{ $security->status ? 'btn-success' : 'btn-danger' }}">
                                    {{ $security->status ? 'Active' : 'Inactive' }}
                                </button>

                        </td>

</tr>
@endforeach
            </tbody>
        </table>
    </div>

</x-layout.default>
