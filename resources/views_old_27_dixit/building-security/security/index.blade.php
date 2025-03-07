<x-layout.default>
    <div class="flex justify-center mb-4">
        <h1 class="text-2xl font-bold">Security List</h1>
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
                    <th class="font-bold py-2 px-8">Action</th>
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
                            <a href="{{ route('building-security.security-show', ['id' => $security->id]) }}" title="show">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24">
  <g fill="none" stroke="black" stroke-width="2">
    <circle cx="12" cy="12" r="3" fill="black"/>
    <path d="M1 12c3.5-5 9-8 11-8s7.5 3 11 8c-3.5 5-9 8-11 8S4.5 17 1 12z"/>
  </g>
</svg>


                            </a>
                        </td>
                        
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-layout.default>
