<x-layout.default>
    <div class="flex justify-center mb-4">
        <h1 class="text-2xl font-bold">Visitor Log List</h1>
    </div>
    <div class="flex justify-start items-center mb-4 space-x-4">
        <form method="GET" action="{{ route('school.security.report.visitor-log') }}" class="flex justify-start items-center mb-4 space-x-4">         
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
                <select id="statusFilter" name="status" class="form-input w-32" @change="filterStatus($event)">
                    <option value="">All</option>
                    <option value="1" {{ request()->input('status') == '1' ? 'selected' : '' }}>Active
                    </option>
                    <option value="0" {{ request()->input('status') == '0' ? 'selected' : '' }}>Inactive
                    </option>
                </select>
            </div>
            <div class="flex items-center">
                <button type="submit" class="btn btn-primary rounded">Filter</button>
            </div>
        </form>
    </div>

    <br>

    <div class="table-responsive">
        <table class="min-w-full shadow-lg rounded-lg overflow-hidden">
            <thead>
                <tr>
                    <tr>
                        <th class="font-bold py-2 px-6">S.No</th>
                        <th class="font-bold py-2 px-8">Visitor ID</th>
                        <th class="font-bold py-2 px-8">Date</th>
                        <th class="font-bold py-2 px-8">Photo</th>
                        <th class="font-bold py-2 px-8">Full Name</th>
                        <th class="font-bold py-2 px-8">In Time</th>
                        <th class="font-bold py-2 px-8">Out Time</th>
                        <th class="font-bold py-2 px-8">ID Proof</th>                    
                        <th class="font-bold py-2 px-8">Status</th>
                    </tr>
                </tr>
            </thead>
            <tbody>
                @foreach($visitor as $key => $item)
                <tr class="border-b duration-300">
                    <td>{{ $key + 1}}</td>
                    <td>{{ $item->visitor_id}}</td>
                    <td>{{ $item->date}}</td>
                    <td>
                        <img src="{{ asset($item->photo) }}" alt="{{$item->visitor_name}}" class="w-12 h-12">
                    </td>
                    <td>{{ $item->visitor_name}}</td>
                    <td>{{ $item->in_time}}</td>
                    <td>{{ $item->out_time}}</td>
                    <td>
                        <a href="{{ asset($item->id_proof) }}" download="{{ $item->id_proof }}" target="_blank">                            
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M8 22.0002H16C18.8284 22.0002 20.2426 22.0002 21.1213 21.1215C22 20.2429 22 18.8286 22 16.0002V15.0002C22 12.1718 22 10.7576 21.1213 9.8789C20.3529 9.11051 19.175 9.01406 17 9.00195M7 9.00195C4.82497 9.01406 3.64706 9.11051 2.87868 9.87889C2 10.7576 2 12.1718 2 15.0002L2 16.0002C2 18.8286 2 20.2429 2.87868 21.1215C3.17848 21.4213 3.54062 21.6188 4 21.749" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"></path>
                            <path d="M12 2L12 15M12 15L9 11.5M12 15L15 11.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                        </svg>
                    </a>
                    </td>                    
                    <td>
                        <form action="{{ route('school.security.visitor.status', $item->id) }}" method="post">
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
            </tbody>
        </table>
    </div>

</x-layout.default>
