<x-layout.default>
    <div class="flex justify-center mb-4">
        <h1 class="text-2xl font-bold">Building List</h1>
    </div>

<style>
    .alert-danger {
        color: red;
    }

    .alert-success {
        color: #5CB85C;
    }
</style>
    <form method="GET" class="container mt-3">
        <div class="flex gap-2">
            <div class="flex justify-start items-center mb-4 space-x-2">
                <label for="city" class="whitespace-nowrap"><strong>Filter by City:</strong></label>
                <select id="city" name="city" class="form-input w-32" @change="filterStatus($event)">
                    <option value="">Select City</option>
                    @isset($city)
                    @foreach ($city as $cityList)
                        <option value="{{ $cityList->city }}"
                            {{ request('city') == $cityList->city ? 'selected' : '' }}
                            >{{ $cityList->City->name }}
                        </option>
                    @endforeach
                    @endisset
                </select>
            </div>
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
    <div class="table-responsive" x-data="form">
        <table class="min-w-full shadow-lg rounded-lg overflow-hidden">
            <thead>
                <tr>
                    <th class="font-bold py-2 px-6">S.No</th>
                    <th class="font-bold py-2 px-8">Register Date</th>
                    <th class="font-bold py-2 px-4">Business Name</th>
                    <th class="font-bold py-2 px-8">Building ID</th>
                    <th class="font-bold py-2 px-8">Type of Building</th>
                    <th class="font-bold py-2 px-8">Building Name</th>
                    <th class="font-bold py-2 px-8">Country</th>
                    <th class="font-bold py-2 px-8">City</th>
                    <th class="font-bold py-2 px-8">Contact Person</th>
                    <th class="font-bold py-2 px-8">Contact Number</th>
                    <th class="font-bold py-2 px-8">Email ID</th>
                    <th class="font-bold py-2 px-8">No. of User</th>
                    <th class="font-bold py-2 px-8">No. of Security</th>
                    <th class="font-bold text-center py-2 px-8">Action</th>
                    <th class="font-bold py-2 px-8">Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($building as $key => $item)
                    <tr class="border-b duration-300">
                        <td>{{$key + 1}}</td>
                        <td>{{$item->date}}</td>
                        <td>{{$item->business_name}}</td>
                        <td>{{$item->building_id}}</td>
                        <td>
    @switch($item->type_of_building)
        @case(1)
            Commercial
            @break
        @case(2)
            Residential
            @break
        @case(3)
            Commercial & Residential
            @break
        @case(4)
            School
            @break
        @default
            Unknown
    @endswitch
</td>

                        <td>{{$item->name}}</td>
                        <td>{{$item->Country->name ?? ''}}</td>
                        <td>{{$item->City->name ?? ''}}</td>
                        <td>{{$item->contact_person}}</td>
                        <td>{{$item->contact_number}}</td>
                        <td>{{$item->email}}</td>
                        <td>{{$item->no_of_tenant}}</td>
                        <td>{{$item->no_security_person}}</td>
                        <td>
                            <a href="{{route('super-admin.building-edit', $item->id)}}" x-tooltip="Edit">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M11.4001 18.1612L11.4001 18.1612L18.796 10.7653C17.7894 10.3464 16.5972 9.6582 15.4697 8.53068C14.342 7.40298 13.6537 6.21058 13.2348 5.2039L5.83882 12.5999L5.83879 12.5999C5.26166 13.1771 4.97307 13.4657 4.7249 13.7838C4.43213 14.1592 4.18114 14.5653 3.97634 14.995C3.80273 15.3593 3.67368 15.7465 3.41556 16.5208L2.05445 20.6042C1.92743 20.9852 2.0266 21.4053 2.31063 21.6894C2.59466 21.9734 3.01478 22.0726 3.39584 21.9456L7.47918 20.5844C8.25351 20.3263 8.6407 20.1973 9.00498 20.0237C9.43469 19.8189 9.84082 19.5679 10.2162 19.2751C10.5343 19.0269 10.823 18.7383 11.4001 18.1612Z" fill="currentColor"></path>
                                    <path d="M20.8482 8.71306C22.3839 7.17735 22.3839 4.68748 20.8482 3.15178C19.3125 1.61607 16.8226 1.61607 15.2869 3.15178L14.3999 4.03882C14.4121 4.0755 14.4246 4.11268 14.4377 4.15035C14.7628 5.0875 15.3763 6.31601 16.5303 7.47002C17.6843 8.62403 18.9128 9.23749 19.85 9.56262C19.8875 9.57563 19.9245 9.58817 19.961 9.60026L20.8482 8.71306Z" fill="currentColor"></path>
                                </svg>
                            </a>
                        </td>
                        <td>
                            <form action="{{ route('super-admin.building-status', $item->id) }}" method="post">
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
