<x-layout.default>
    <div class="flex justify-center mb-4">
        <h1 class="text-2xl font-bold">Security List</h1>
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
                    <th class="font-bold py-2 px-8">Photo</th>
                    <th class="font-bold py-2 px-8">Name</th>
                    <th class="font-bold py-2 px-8">Contact Number</th>
                    <th class="font-bold py-2 px-8">WhatsApp Number</th>
                    <th class="font-bold py-2 px-8">Email ID</th>
                    <th class="font-bold py-2 px-8">Working From Date</th>
                    <th class="font-bold text-center py-2 px-8">View</th>
                    <th class="font-bold py-2 px-8">Status</th>
                </tr>
            </thead>
            <tbody>  
                @foreach ($security as $key => $item)
                <tr class="border-b duration-300">
                    <td>{{ $key +1 }}</td>
                    <td>
                        <img src="{{ asset('assets/images/'.$item->photo) }}" alt="{{ $item->name }}" class="w-13 h-13">
                    </td>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->contant_number }}</td>
                    <td>{{ $item->whatsapp }}</td>
                    <td>{{ $item->email }}</td>
                    <td>{{ $item->working_date }}</td>
                    <td>
                        <a href="#" title="View" onclick="openModal({{$item->id}})" style="color: blue">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-5 h-5 text-blue-600">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.5C7.305 4.5 3.444 7.305 2 12c1.444 4.695 5.305 7.5 10 7.5s8.556-2.805 10-7.5C20.556 7.305 16.695 4.5 12 4.5zm0 10a2.5 2.5 0 110-5 2.5 2.5 0 010 5z"/>
                            </svg>
                        </a> 
                        @include('school-security.master.security-view')                      
                    </td>
                    <td>
                        @if ($item->status == 1)
                          Active
                        @else
                          Inactive  
                        @endif
                    </td>
                </tr>                     
                @endforeach            
            </tbody>
        </table>
    </div>
</x-layout.default>
