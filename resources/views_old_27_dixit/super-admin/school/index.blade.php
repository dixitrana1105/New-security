<x-layout.default>
    <div class="flex justify-center mb-4">
        <h1 class="text-2xl font-bold">School List</h1>
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
    {{-- <button type="button" class="btn btn-primary btn-sm m-1 " @click="exportTable('csv')">
        <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
            xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 ltr:mr-2 rtl:ml-2">
            <path
                d="M15.3929 4.05365L14.8912 4.61112L15.3929 4.05365ZM19.3517 7.61654L18.85 8.17402L19.3517 7.61654ZM21.654 10.1541L20.9689 10.4592V10.4592L21.654 10.1541ZM3.17157 20.8284L3.7019 20.2981H3.7019L3.17157 20.8284ZM20.8284 20.8284L20.2981 20.2981L20.2981 20.2981L20.8284 20.8284ZM14 21.25H10V22.75H14V21.25ZM2.75 14V10H1.25V14H2.75ZM21.25 13.5629V14H22.75V13.5629H21.25ZM14.8912 4.61112L18.85 8.17402L19.8534 7.05907L15.8947 3.49618L14.8912 4.61112ZM22.75 13.5629C22.75 11.8745 22.7651 10.8055 22.3391 9.84897L20.9689 10.4592C21.2349 11.0565 21.25 11.742 21.25 13.5629H22.75ZM18.85 8.17402C20.2034 9.3921 20.7029 9.86199 20.9689 10.4592L22.3391 9.84897C21.9131 8.89241 21.1084 8.18853 19.8534 7.05907L18.85 8.17402ZM10.0298 2.75C11.6116 2.75 12.2085 2.76158 12.7405 2.96573L13.2779 1.5653C12.4261 1.23842 11.498 1.25 10.0298 1.25V2.75ZM15.8947 3.49618C14.8087 2.51878 14.1297 1.89214 13.2779 1.5653L12.7405 2.96573C13.2727 3.16993 13.7215 3.55836 14.8912 4.61112L15.8947 3.49618ZM10 21.25C8.09318 21.25 6.73851 21.2484 5.71085 21.1102C4.70476 20.975 4.12511 20.7213 3.7019 20.2981L2.64124 21.3588C3.38961 22.1071 4.33855 22.4392 5.51098 22.5969C6.66182 22.7516 8.13558 22.75 10 22.75V21.25ZM1.25 14C1.25 15.8644 1.24841 17.3382 1.40313 18.489C1.56076 19.6614 1.89288 20.6104 2.64124 21.3588L3.7019 20.2981C3.27869 19.8749 3.02502 19.2952 2.88976 18.2892C2.75159 17.2615 2.75 15.9068 2.75 14H1.25ZM14 22.75C15.8644 22.75 17.3382 22.7516 18.489 22.5969C19.6614 22.4392 20.6104 22.1071 21.3588 21.3588L20.2981 20.2981C19.8749 20.7213 19.2952 20.975 18.2892 21.1102C17.2615 21.2484 15.9068 21.25 14 21.25V22.75ZM21.25 14C21.25 15.9068 21.2484 17.2615 21.1102 18.2892C20.975 19.2952 20.7213 19.8749 20.2981 20.2981L21.3588 21.3588C22.1071 20.6104 22.4392 19.6614 22.5969 18.489C22.7516 17.3382 22.75 15.8644 22.75 14H21.25ZM2.75 10C2.75 8.09318 2.75159 6.73851 2.88976 5.71085C3.02502 4.70476 3.27869 4.12511 3.7019 3.7019L2.64124 2.64124C1.89288 3.38961 1.56076 4.33855 1.40313 5.51098C1.24841 6.66182 1.25 8.13558 1.25 10H2.75ZM10.0298 1.25C8.15538 1.25 6.67442 1.24842 5.51887 1.40307C4.34232 1.56054 3.39019 1.8923 2.64124 2.64124L3.7019 3.7019C4.12453 3.27928 4.70596 3.02525 5.71785 2.88982C6.75075 2.75158 8.11311 2.75 10.0298 2.75V1.25Z"
                fill="currentColor" />
            <path opacity="0.5"
                d="M13 2.5V5C13 7.35702 13 8.53553 13.7322 9.26777C14.4645 10 15.643 10 18 10H22"
                stroke="currentColor" stroke-width="1.5" />
        </svg>
        CSV
    </button> --}}
    <div class="table-responsive" x-data="form">
        <table class="min-w-full shadow-lg rounded-lg overflow-hidden">
            <thead>
                <tr>
                    <th class="font-bold py-2 px-4">S.No</th>
                    <th class="font-bold py-2 px-4">Register Date</th>
                    <th class="font-bold py-2 px-4">Business Name</th>
                    <th class="font-bold py-2 px-4">School ID</th>
                    <th class="font-bold py-2 px-4">School Name</th>
                    <th class="font-bold py-2 px-4">Country</th>
                    <th class="font-bold py-2 px-4">City</th>
                    <th class="font-bold py-2 px-4">Contact Person</th>
                    <th class="font-bold py-2 px-4">Contact Number</th>
                    <th class="font-bold py-2 px-4">Email ID</th>
                    <th class="font-bold py-2 px-4">No. Security Person</th>
                    <th class="font-bold text-center py-2 px-4">Action</th>
                    <th class="font-bold py-2 px-4">Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($school as $key => $item)
                    <tr class="border-b duration-300">
                        <td>{{$key + 1}}</td>
                        <td>{{$item->date}}</td>
                        <td>{{$item->business_name}}</td>
                        <td>{{$item->school_id}}</td>
                        <td>{{$item->name}}</td>
                        <td>{{$item->Country->name}}</td>
                        <td>{{$item->City->name}}</td>
                        <td>{{$item->contact_person}}</td>
                        <td>{{$item->contact_number}}</td>
                        <td>{{$item->email}}</td>
                        <td>{{$item->no_security_person}}</td>
                        <td class="text-center py-2 px-4">
                            <a href="{{route('super-admin.school-edit', $item->id)}}" x-tooltip="Edit">
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
