<x-layout.default>
    <div class="relative flex min-h-screen items-center justify-center bg-[url(/assets/images/auth/map.png)] bg-cover bg-center bg-no-repeat px-6 py-10 dark:bg-[#060818] sm:px-16">

        <div class="panel shadow-lg rounded-lg p-8 max-w-6xl mx-auto " style="border-color: #a8acaf; border-width: medium;">
            <div class="flex justify-center mb-4">
                <h1 class="text-2xl font-bold">Edit Security</h1>
            </div>
            <form>
                <!-- Name and Contact Information -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div>
                        <label for="name"><strong>Name</strong></label>
                        <input id="name" type="text" name="name" placeholder="Enter Name" class="form-input" value="John Doe" required />
                    </div>
                    <div>
                        <label for="contact"><strong>Contact Number</strong></label>
                        <input id="contact" name="contact" type="number" placeholder="Enter Contact Number" class="form-input" value="1234567890" required />
                    </div>
                </div>

                <!-- WhatsApp Number and Email -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div>
                        <label for="whatsup"><strong>WhatsApp Number</strong></label>
                        <input id="whatsup" name="whatsup" type="number" placeholder="Enter WhatsApp Number" class="form-input" value="0987654321" required />
                    </div>
                    <div>
                        <label for="email"><strong>Email ID</strong></label>
                        <div class="flex">
                            <div class="bg-[#eee] flex justify-center items-center ltr:rounded-l-md rtl:rounded-r-md px-3 font-semibold border ltr:border-r-0 rtl:border-l-0 border-[#e0e6ed] dark:border-[#17263c] dark:bg-[#1b2e4b]">@</div>
                            <input id="email" type="email" name="email" placeholder="Enter Email" class="form-input ltr:rounded-l-none rtl:rounded-r-none" value="johndoe@example.com" required />
                        </div>
                    </div>
                </div>

                <!-- Current Address -->
                <div>
                    <label><strong>Current Address</strong></label>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div>
                        <label for="current_address_1"><strong>Address 1</strong></label>
                        <input id="current_address_1" name="current_address_1" type="text" placeholder="Enter Address 1" class="form-input" value="123 Main St" required />
                    </div>
                    <div>
                        <label for="current_address_2"><strong>Address 2</strong></label>
                        <input id="current_address_2" name="current_address_2" type="text" placeholder="Enter Address 2" class="form-input" value="Apt 4B" />
                    </div>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div>
                        <label for="landmark"><strong>Landmark</strong></label>
                        <input id="landmark" name="landmark" type="text" placeholder="Enter Landmark" class="form-input" value="Near Central Park" />
                    </div>
                    <div>
                        <label for="city"><strong>City</strong></label>
                        <input id="city" name="city" type="text" placeholder="Enter City" class="form-input" value="New York" required />
                    </div>
                </div>

                <!-- Permanent Address -->
                <div>
                    <label><strong>Permanent Address</strong></label>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div>
                        <label for="permanent_address_1"><strong>Address 1</strong></label>
                        <input id="permanent_address_1" name="permanent_address_1" type="text" placeholder="Enter Address 1" class="form-input" value="456 Elm St" required />
                    </div>
                    <div>
                        <label for="permanent_address_2"><strong>Address 2</strong></label>
                        <input id="permanent_address_2" name="permanent_address_2" type="text" placeholder="Enter Address 2" class="form-input" value="Suite 100" />
                    </div>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div>
                        <label for="country"><strong>Country</strong></label>
                        <input id="country" name="country" type="text" placeholder="Enter Country" class="form-input" value="USA" required />
                    </div>
                    <div>
                        <label for="state"><strong>State</strong></label>
                        <input id="state" name="state" type="text" placeholder="Enter State" class="form-input" value="NY" required />
                    </div>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div>
                        <label for="permanent_city"><strong>City</strong></label>
                        <input id="permanent_city" name="permanent_city" type="text" placeholder="Enter City" class="form-input" value="New York" required />
                    </div>
                </div>

                <!-- Photo ID and Address Proof Upload -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div>
                        <label for="photoId"><strong>Photo ID (Upload)</strong></label>
                        <input type="file" id="photoId" name="photoId" class="form-input" required />
                    </div>
                    <div>
                        <label for="addressProof"><strong>Address Proof (Upload)</strong></label>
                        <input type="file" id="addressProof" name="addressProof" class="form-input" required />
                    </div>
                </div>

                <!-- Working From Date -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div>
                        <label for="tenantPhoto"><strong>Photo (Upload)</strong></label>
                        <input type="file" id="tenantPhoto" name="tenantPhoto" class="form-input" required />
                    </div>
                    <div>
                        <label for="workingFromDate"><strong>Working From Date</strong></label>
                        <input id="workingFromDate" name="workingFromDate" type="date" class="form-input" value="2024-01-01" required />
                    </div>
                </div>

                <!-- Submit Button -->
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
