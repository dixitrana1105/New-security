<x-layout.default>
    <div
        class="relative flex min-h-screen items-center justify-center bg-[url(/assets/images/auth/map.png)] bg-cover bg-center bg-no-repeat px-6 py-10 dark:bg-[#060818] sm:px-16">

        <div class="panel shadow-lg rounded-lg p-8 max-w-6xl mx-auto "
            style="border-color: #a8acaf; border-width: medium;">
            <div class="flex justify-center mb-4">
                <h1 class="text-2xl font-bold">Add Visitor</h1>
            </div>
            <form action="{{ route('building-tenant.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div>
                        <label for="VisitorId"><strong>Visitor ID </strong></label>
                        <input id="VisitorId" type="text" name="VisitorId" value="{{ $nextVisitorId }}" placeholder="Auto Generate" class="form-input" required readonly />
                    </div>
                    <div>
    <label for="date"><strong>Date</strong></label>
    <input
        id="date"
        name="date"
        placeholder="Enter Date"
        class="form-input"
        required
        readonly
        value="{{ date('Y-m-d') }}"
    />
</div>


                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div>
                        <label for="photo"><strong>Photo</strong></label>
                        <input id="photo" name="photo" type="file" class="form-input" required />
                    </div>
                    <div>
                        <label for="full_name"><strong>Full Name</strong></label>
                        <input id="full_name" name="full_name" type="text" placeholder="Enter Full Name"
                            class="form-input" required />
                    </div>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">


                    <?php
date_default_timezone_set('Asia/Kolkata');
?>

                    <div>
                        <label for="in_time"><strong>In Time (IST)</strong></label>
                        <input id="in_time" name="in_time" type="time" value="{{ date('H:i') }}" placeholder="Enter time" class="form-input" required readonly />
                    </div>

                    <div>
                        <label for="out_time"><strong>Out Time</strong></label>
                        <input id="out_time" name="out_time" type="time" placeholder="Enter  time" class="form-input"
                             />
                    </div>



                </div>




                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <!-- ID Proof Section -->
                    {{-- <div>
                        <label for="id_proof" class="block text-sm font-bold mb-2"><strong>ID Proof</strong></label>
                        <input id="id_proof" name="id_proof" type="file" class="form-input w-full p-2 border border-gray-300 rounded-lg" required />
                    </div> --}}


                    <!-- Previous Log Modal Section -->
                    <div class="mt-5">
                        <div x-data="{ open: false }">
                            <!-- Button to trigger modal -->
                            {{-- <button type="button" class="btn btn-primary w-40 float-right mb-2" @click="open = true">
                                View Previous Log
                            </button> --}}

                            <!-- Modal overlay -->
                            <div class="fixed inset-0 bg-black/60 z-[999] hidden" :class="{ '!block': open }">
                                <div class="flex items-start justify-center min-h-screen px-4" @click.self="open = false">
                                    <div x-show="open" x-transition x-transition.duration.300 class="panel border-0 p-0 rounded-lg overflow-hidden w-full max-w-5xl my-8">
                                        <!-- Modal Header -->
                                        <div class="flex bg-[#fbfbfb] dark:bg-[#121c2c] items-center justify-between px-5 py-3">
                                            <h5 class="font-bold text-lg">Previous Log List</h5>
                                            <button type="button" class="text-white-dark hover:text-dark" @click="open = false">
                                                <svg style="max-height: 40px;" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x">
                                                    <line x1="18" y1="6" x2="6" y2="18"></line>
                                                    <line x1="6" y1="6" x2="18" y2="18"></line>
                                                </svg>
                                            </button>
                                        </div>

                                        <!-- Modal Body -->
                                        <div class="p-5">
                                            @include('building-tenant.visitor.previous-log')
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div>
                        <label for="visiter_purpose"><strong>Visitor Purpose</strong></label>
                        <input id="visiter_purpose" name="visiter_purpose" type="text" placeholder="Enter Visitor Purpose"
                            class="form-input" required />
                    </div>
                    <div>
                        <label for="tenant_flat_office_no"><strong>Tenant</strong></label>
                        <input id="tenant_flat_office_no" type="text" name="tenant_flat_office_no" value="{{ $tenants }}" placeholder="Auto Generate" class="form-input" required readonly />

                    </div>

                </div>


                <div>
                    <button type="submit" class="btn btn-primary !mt-6">Submit</button>
                </div>
            </form>
        </div>
    </div>
    <script>
        document.getElementById('registerDate').value = new Date().toISOString().substring(0, 10);
    </script>

</x-layout.default>
