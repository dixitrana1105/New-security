<x-layout.default>
    <div
    class="relative flex min-h-screen items-center justify-center bg-[url(/assets/images/auth/map.png)] bg-cover bg-center bg-no-repeat px-6 py-10 dark:bg-[#060818] sm:px-16">
    <div class="pt-5">
        <div class="grid grid-cols-1 lg:grid-cols-3 xl:grid-cols-1 gap-5 mb-5">
            <div class="panel shadow-lg rounded-lg p-8 max-w-6xl mx-auto"
                style="border-color: #a8acaf; border-width: medium; width: 880px;">
                <div class="flex items-center justify-between mb-5">
                    <h5 class="font-semibold text-lg dark:text-white-light">Company Profile</h5>
                    <a href="/school-admin/setting/profile-form" class="ltr:ml-auto rtl:mr-auto btn btn-primary p-2 rounded-full">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5">
                            <path opacity="0.5" d="M4 22H20" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                            <path d="M14.6296 2.92142L13.8881 3.66293L7.07106 10.4799C6.60933 10.9416 6.37846 11.1725 6.17992 11.4271C5.94571 11.7273 5.74491 12.0522 5.58107 12.396C5.44219 12.6874 5.33894 12.9972 5.13245 13.6167L4.25745 16.2417L4.04356 16.8833C3.94194 17.1882 4.02128 17.5243 4.2485 17.7515C4.47573 17.9787 4.81182 18.0581 5.11667 17.9564L5.75834 17.7426L8.38334 16.8675L8.3834 16.8675C9.00284 16.6611 9.31256 16.5578 9.60398 16.4189C9.94775 16.2551 10.2727 16.0543 10.5729 15.8201C10.8275 15.6215 11.0583 15.3907 11.5201 14.929L11.5201 14.9289L18.3371 8.11195L19.0786 7.37044C20.3071 6.14188 20.3071 4.14999 19.0786 2.92142C17.85 1.69286 15.8581 1.69286 14.6296 2.92142Z" stroke="currentColor" stroke-width="1.5" />
                            <path opacity="0.5" d="M13.8879 3.66406C13.8879 3.66406 13.9806 5.23976 15.3709 6.63008C16.7613 8.0204 18.337 8.11308 18.337 8.11308M5.75821 17.7437L4.25732 16.2428" stroke="currentColor" stroke-width="1.5" />
                        </svg>
                    </a>
                </div>
                <div class="mb-5">
               
                    <div class="mb-5">
                        @foreach ($profiles as $profile)

                        <div class="flex flex-col justify-center items-center">
                            <img src="{{ asset($profile->logo) }}" alt="image" class="w-24 h-24 rounded-full object-cover mb-5" />
                        </div>
                        
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 mb-5">
                            <div class="flex flex-col justify-center items-start">
                                <ul class="mt-5 flex flex-col max-w-[300px] m-auto space-y-4 font-semibold text-white-dark">
                                    <li class="flex items-center gap-2">
                                        <strong>Business Name:</strong>
                                        <span>{{ $profile->business_name }}</span>
                                    </li>
                                    <li class="flex items-center gap-2">
                                        <strong>Contact:</strong>
                                        <span class="whitespace-nowrap" dir="ltr">{{ $profile->contact_number }}</span>
                                    </li>
                                    <li class="flex items-center gap-2">
                                        <strong>Address 1:</strong>
                                        <span>{{ $profile->address_1 }}</span>
                                    </li>
                                    <li class="flex items-center gap-2">
                                        <strong>Country:</strong>
                                        <span>{{ $profile->Country->name }}</span>
                                    </li>
                                    <li class="flex items-center gap-2">
                                        <strong>City:</strong>
                                        <span>{{ $profile->City->name }}</span>
                                    </li>
                                </ul>
                            </div>

                            <div class="flex flex-col justify-center items-start">
                                <ul class="mt-5 flex flex-col max-w-[300px] m-auto space-y-4 font-semibold text-white-dark">
                                    <li class="flex items-center gap-2">
                                        <strong>Name:</strong>
                                        <span>{{ $profile->name }}</span>
                                    </li>
                                    <li class="flex items-center gap-2">
                                        <strong>Email:</strong>
                                        <span class="text-primary truncate">{{ $profile->email }}</span>
                                    </li>
                                    <li class="flex items-center gap-2">
                                        <strong>Address 2:</strong>
                                        <span>{{ $profile->address_1 }}</span>
                                    </li>
                                    <li class="flex items-center gap-2">
                                        <strong>State:</strong>
                                        <span>{{ $profile->State->name }}</span>
                                    </li>
                                </ul>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


</x-layout.default>
