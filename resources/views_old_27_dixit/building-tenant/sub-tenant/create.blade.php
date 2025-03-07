<x-layout.default>
    <div
        class="relative flex min-h-screen items-center justify-center bg-[url(/assets/images/auth/map.png)] bg-cover bg-center bg-no-repeat px-6 py-10 dark:bg-[#060818] sm:px-16">

        <div class="panel shadow-lg rounded-lg p-8 max-w-6xl mx-auto "
            style="border-color: #a8acaf; border-width: medium;">
            <div class="flex justify-center mb-4">
                <h1 class="text-2xl font-bold">Sub User</h1>
            </div>
            @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <style>
            .alert-danger {
                color: red;
            }

            .alert-success {
                color: #5CB85C;
            }
        </style>
            <form action="{{route('building-tenant.sub-tenant-store')}}" method="POST">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div>
                        <label for="tenantId"><strong>User ID</strong></label>
                        <input id="tenantId" type="text" name="tenantId" placeholder="Auto Generate" value="{{ $tenant->tenant_id }}" class="form-input" required readonly/>
                        <input type="hidden" name="building_id" value="{{ $tenant->building_id }}" />
                        <input type="hidden" name="secret_key" value="{{ $tenant->secret_key }}" />
                        <input type="hidden" name="visiting_hour_from" value="{{ $tenant->visiting_hour_from }}" />
                        <input type="hidden" name="visiting_hour_to" value="{{ $tenant->visiting_hour_to }}" />
                        {{-- <input type="hidden" name="email" value="{{ $tenant->email }}" /> --}}
                        <input type="hidden" name="emergency_contact_no" value="{{ $tenant->emergency_contact_no }}" />
                        {{-- <input type="hidden" name="" value="{{ $tenant->building_id }}" /> --}}
                    </div>
                    <div>
                        <label for="flat_office_number"><strong>Flat / Office Number</strong></label>
                        <input id="flat_office_number" name="flat_office_number" type="text" placeholder="Enter Flat / Office Number"
                           value="{{ $tenant->flat_office_no }}" class="form-input" required readonly/>
                    </div>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div>
                        <label for="sub_tenant_id"><strong>Sub User ID</strong></label>
                        <input id="sub_tenant_id" name="sub_tenant_id" type="number" class="form-input" value="{{ $nextId }}" required readonly/>
                    </div>
                    <div>
                        <label for="sub_tenant_name"><strong>Sub User Name</strong></label>
                        <input id="sub_tenant_name" name="sub_tenant_name" type="text" placeholder="Enter Full Name"
                            class="form-input" required />
                    </div>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div>
                        <label for="sub_tenant_contact_number"><strong>Sub User Contact Number</strong></label>
                        <input id="sub_tenant_contact_number" type="tel" name="sub_tenant_contact_number"
                            placeholder="Enter Contact Number" class="form-input" required />
                    </div>
                    <div>
                        <label for="sub_tenant_whatsapp_number"><strong>Sub User WhatsApp Number</strong></label>
                        <input id="sub_tenant_whatsapp_number" name="sub_tenant_whatsapp_number" type="tel"
                            placeholder="Enter WhatsApp Number" class="form-input" required />
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div>
                        <label for="email"><strong>Email</strong></label>
                        <input id="email" type="email" name="email"
                            placeholder="Enter Email" class="form-input" required />
                    </div>
                    <div>
                        <label for="password"><strong>Password</strong></label>
                        <input id="password" name="password" type="password"
                            placeholder="password" class="form-input" required />
                    </div>
                    <button type="submit" class="btn btn-primary !mt-6">Submit</button>
                    </div>
                </div>
            </form>

        </div>
    </div>
    <script>
        document.getElementById('registerDate').value = new Date().toISOString().substring(0, 10);
    </script>

</x-layout.default>
