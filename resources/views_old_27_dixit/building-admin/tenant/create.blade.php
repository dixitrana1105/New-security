<x-layout.default>
    <div class="relative flex min-h-screen items-center justify-center bg-[url(/assets/images/auth/map.png)] bg-cover bg-center bg-no-repeat px-6 py-10 dark:bg-[#060818] sm:px-16">

    <div class="panel shadow-lg rounded-lg p-8 max-w-6xl mx-auto " style="border-color: #a8acaf; border-width: medium;">
        <div class="flex justify-center mb-4">
            <h1 class="text-2xl font-bold">Add User</h1>
        </div>
        <form action="{{route('building-admin.tenant-store')}}" method="POST" enctype="multipart/form-data">
            @csrf
        <div class="flex justify-between items-center">
            <div></div>
            <div>
                <label for="registerDate"><strong>Register Date</strong></label>
                <input id="registerDate" type="date" name="date" style="width: 100%" class="form-input" required/>
            </div>
        </div>
        <br>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <div>
                    <label for="tenantId"><strong>User ID </strong></label>
                    <input id="tenantId" type="text" name="tenantId" placeholder="Auto Generate" value="{{ $nextId }}" class="form-input" required readonly/>
                </div>
                <div>
                    <label for="flat_office_number"><strong>Flat Office Number</strong></label>
                    <input id="flat_office_number" name="flat_office_number" type="number" placeholder="Enter Flat Office Number" class="form-input" required/>
                </div>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <div>
                    <label for="sub_user"><strong>No. of Sub user Allow</strong></label>
                    <input id="sub_user" name="sub_user" type="number" placeholder="Enter No. of Sub user Allow" class="form-input" required />
                </div>
                <div>
                    <label for="email"><strong>Email ID</strong></label>
                    <div class="flex">
                    <div class="bg-[#eee] flex justify-center items-center ltr:rounded-l-md rtl:rounded-r-md px-3 font-semibold border ltr:border-r-0 rtl:border-l-0 border-[#e0e6ed] dark:border-[#17263c] dark:bg-[#1b2e4b]">@</div>
                    <input id="email" type="email" name="email" placeholder="Enter Email" class="form-input ltr:rounded-l-none rtl:rounded-r-none"  required/>
                    </div>
                </div>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <div>
                    <label for="name"><strong>Contact Person</strong></label>
                    <input id="name" type="text" name="name" placeholder="name" class="form-input" required/>
                </div>
                <div>
                    <label for="contact"><strong>Contact Number</strong></label>
                    <input id="contact" name="contact" type="number" placeholder="Enter contact number" class="form-input" required />
                </div>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <div>
                    <label for="whatsup"><strong>WhatsApp Number</strong></label>
                    <input id="whatsup" name="whatsup" type="number" placeholder="Enter whatsApp Number" class="form-input" required />
                </div>
                <div>
                    <label for="emer_number"><strong>Emergency Contact Number</strong></label>
                    <input id="emer_number" name="emer_number" type="number" placeholder="Enter emergency Contact Number" class="form-input" required />
                </div>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <div>
                    <label for="fromTime"><strong>Visiting Hour (From)</strong></label>
                    <input id="fromTime" name="fromTime" type="time" placeholder="Enter Visiting Time" class="form-input" required />
                </div>
                <div>
                    <label for="toTime"><strong>Visiting Hour (To)</strong></label>
                    <input id="toTime" name="toTime" type="time" placeholder="Enter Visiting Time" class="form-input" required />
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <div>
                    <label for="tenantPhoto"><strong>User Photo</strong></label>
                    <input type="file" id="tenantPhoto" name="tenantPhoto" class="form-input" required/>
                </div>
                <div>
                    <label for="tenantIdProof"><strong>User ID Proof Document Upload</strong></label>
                    <input type="file" id="tenantIdProof" name="tenantIdProof" class="form-input" required />
                </div>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <div>
                    <label for="password"><strong>Password</strong></label>
                    <input id="password" type="password" name="password" placeholder="password" class="form-input" required />
                </div>
                <div>
                    <label for="secretkey"><strong>Secret Key</strong></label>
                    <input id="secretkey" name="secretkey" type="text" placeholder="secret Key" class="form-input" />
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

