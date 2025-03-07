<x-layout.default>
    <div class="flex justify-center mb-4">
        <h1 class="text-2xl font-bold">Student List</h1>
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
                    <tr>
                        <th class="font-bold py-2 px-4">S.No</th>
                        <th class="font-bold py-2 px-4">Student ID</th>
                        <th class="font-bold py-2 px-4">Name</th>
                        <th class="font-bold py-2 px-4">Middle</th>
                        <th class="font-bold py-2 px-4">Last</th>
                        <th class="font-bold py-2 px-4">Class</th>
                        <th class="font-bold py-2 px-4">Section</th>
                        <th class="font-bold py-2 px-4">Mobile</th>
                        <th class="font-bold py-2 px-4">WhatsApp</th>
                        <th class="font-bold py-2 px-4">Email ID</th>
                        <th class="font-bold py-2 px-4">Status</th>
                    </tr>
                </tr>
            </thead>
            <tbody>
                @foreach ($student as $key => $item)
                <tr class="border-b duration-300">
                    <td>{{ $key + 1}}</td>
                    <td>{{ $item->student_id }}</td>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->middle }}</td>
                    <td>{{ $item->last }}</td>
                    <td>{{ $item->class }}</td>
                    <td>{{ $item->section }}</td>
                    <td>{{ $item->mobile }}</td>
                    <td>{{ $item->whatsapp }}</td>
                    <td>{{ $item->email }}</td>                  
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
