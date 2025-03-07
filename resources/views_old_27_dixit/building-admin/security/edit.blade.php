<x-layout.default>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <div
        class="relative flex min-h-screen items-center justify-center bg-[url(/assets/images/auth/map.png)] bg-cover bg-center bg-no-repeat px-6 py-10 dark:bg-[#060818] sm:px-16">

        <div class="panel shadow-lg rounded-lg p-8 max-w-6xl mx-auto"
            style="border-color: #a8acaf; border-width: medium;">
            <div class="flex justify-center mb-4">
                <h1 class="text-2xl font-bold">Edit Security</h1>
            </div>
            <form action="{{ route('building-admin.security.update', $security->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')


                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div>
                        <label for="SecurityId"><strong>Security ID </strong></label>
                        <input id="SecurityId" type="text" name="security_id" placeholder="Auto Generate" value="{{ $security->security_id }}" class="form-input" required readonly/>
                    </div>
                    <div>
                        <label for="BuildingId"><strong>Building ID </strong></label>
                        <input id="BuildingId" type="text" name="building_id" placeholder="Auto Generate" value="{{ $security->building_id }}" class="form-input" required readonly/>
                    </div>
                </div>
            
                <!-- Name and Contact Information -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div>
                        <label for="name"><strong>Name</strong></label>
                        <input id="name" type="text" name="name" value="{{ old('name', $security->name) }}"
                            placeholder="Enter Name" class="form-input" required />
                    </div>
                    <div>
                        <label for="contact"><strong>Contact Number</strong></label>
                        <input id="contact" name="contact" type="number"
                            value="{{ old('contact', $security->contact) }}" placeholder="Enter Contact Number"
                            class="form-input" required />
                    </div>
                </div>

                <!-- WhatsApp Number and Email -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div>
                        <label for="whatsup"><strong>WhatsApp Number</strong></label>
                        <input id="whatsup" name="whatsup" type="number"
                            value="{{ old('whatsup', $security->whatsup) }}" placeholder="Enter WhatsApp Number"
                            class="form-input" required />
                    </div>
                    <div>
                        <label for="email"><strong>Email ID</strong></label>
                        <div class="flex">
                            <div
                                class="bg-[#eee] flex justify-center items-center ltr:rounded-l-md rtl:rounded-r-md px-3 font-semibold border ltr:border-r-0 rtl:border-l-0 border-[#e0e6ed] dark:border-[#17263c] dark:bg-[#1b2e4b]">
                                @</div>
                            <input id="email" type="email" name="email"
                                value="{{ old('email', $security->email) }}" placeholder="Enter Email"
                                class="form-input ltr:rounded-l-none rtl:rounded-r-none" required />
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
                        <input id="current_address_1" name="current_address_1" type="text"
                            value="{{ old('current_address_1', $security->current_address_1) }}"
                            placeholder="Enter Address 1" class="form-input" required />
                    </div>
                    <div>
                        <label for="current_address_2"><strong>Address 2</strong></label>
                        <input id="current_address_2" name="current_address_2" type="text"
                            value="{{ old('current_address_2', $security->current_address_2) }}"
                            placeholder="Enter Address 2" class="form-input" />
                    </div>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div>
                        <label for="landmark"><strong>Landmark</strong></label>
                        <input id="landmark" name="landmark" type="text"
                            value="{{ old('landmark', $security->landmark) }}" placeholder="Enter Landmark"
                            class="form-input" />
                    </div>
                    <div>
                        <label for="current_city"><strong>City</strong></label>
                        <input id="current_city" name="current_city" type="text"
                            value="{{ old('current_city', $security->current_city) }}" placeholder="Enter City"
                            class="form-input" required />
                    </div>
                </div>

                <!-- Permanent Address -->
                <div>
                    <label><strong>Permanent Address</strong></label>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div>
                        <label for="permanent_address_1"><strong>Address 1</strong></label>
                        <input id="permanent_address_1" name="permanent_address_1" type="text"
                            value="{{ old('permanent_address_1', $security->permanent_address_1) }}"
                            placeholder="Enter Address 1" class="form-input" required />
                    </div>
                    <div>
                        <label for="permanent_address_2"><strong>Address 2</strong></label>
                        <input id="permanent_address_2" name="permanent_address_2" type="text"
                            value="{{ old('permanent_address_2', $security->permanent_address_2) }}"
                            placeholder="Enter Address 2" class="form-input" />
                    </div>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div>
                        <label for="country"><strong>Country</strong></label>
                        <select id="countryDropdown" name="country" class="form-input" required
                            onchange="filterLocations()">
                            <option value="" disabled selected>Select Country</option>
                            @foreach ($country as $countryList)
                                <option value="{{ $countryList->id }}"
                                    @if (old('country', $security->country) == $countryList->id) selected @endif>
                                    {{ $countryList->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label for="state"><strong>State</strong></label>
                        <select id="stateDropdown" name="state" class="form-input" required
                            onchange="filterLocations()">
                            <option value="" disabled selected>Select State</option>
                            @foreach ($states as $state)
                                <option value="{{ $state->id }}" @if (old('state', $security->state) == $state->id) selected @endif>
                                    {{ $state->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div>
                        <label for="city"><strong>City</strong></label>
                        <select id="cityDropdown" name="city" class="form-input" required>
                            <option value="" disabled selected>Select City</option>
                            @foreach ($cities as $city)
                                <option value="{{ $city->id }}" @if (old('city', $security->city) == $city->id) selected @endif>
                                    {{ $city->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label for="workingFromDate"><strong>Working From Date</strong></label>
                        <input id="workingFromDate" name="workingFromDate" type="date"
                            value="{{ old('workingFromDate', $security->workingFromDate) }}" class="form-input"
                            required />
                    </div>


                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div class="relative">
                        <label for="password"><strong>Password</strong></label>
                        <input id="password" name="password" type="password" placeholder="Enter Password"
                            class="form-input pr-10"  style="padding-right: 2.5rem;"  />
                        <button type="button"  style="
    padding-top: 1rem;
    margin: -2rem;
    margin-top: 9px;
" class="absolute right-3 top-2"
                            onclick="togglePasswordVisibility('password', this)">
                            <i class="fas fa-eye" id="eye-icon-password"></i>
                        </button>
                    </div>
                    <div class="relative">
    <label for="secret_key"><strong>Secret Key</strong></label>
    <input 
        id="secret_key" 
        name="secret_key" 
        type="password" 
        placeholder="Enter Secret Key" 
        class="form-input pr-10" 
        value="{{ old('secret_key', $security->secret_key) }}" 
        style="padding-right: 2.5rem;" 
    />
    <button style="
    padding-top: 1rem;
"
        type="button" 
        class="absolute inset-y-0 right-0 pr-3 flex items-center" 
        onclick="togglePasswordVisibility('secret_key', this)"
    >
        <i class="fas fa-eye" id="eye-icon-secret_key"></i>
    </button>
</div>
                </div>



                <!-- Working From Date -->


                <!-- Photo ID and Address Proof Upload -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div>
                        <label for="photoId"><strong>Photo ID (Upload)</strong></label>
                        <input type="file" id="photoId" name="photo" class="form-input" />
                        <img src="{{ asset($security->photo) }}" alt="image" class="w-24 h-24 object-cover mb-5" />

                    </div>
                    <div>
                        <label for="addressProof"><strong>Address Proof (Upload)</strong></label>
                        <input type="file" id="addressProof" name="addressproof" class="form-input" />
                        <img src="{{ asset($security->addressproof) }}" alt="image" class="w-24 h-24 object-cover mb-5" />

                    </div>
                </div>

                <!-- Logo Upload -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div>
                        <label for="tenantPhoto"><strong>Photo (Upload)</strong></label>
                        <input type="file" id="tenantPhoto" name="tenantPhoto" class="form-input" />
                        <img src="{{ asset($security->tenantPhoto) }}" alt="image" class="w-24 h-24 object-cover mb-5" />
                    </div>
                    <div>
                        <label for="logo"><strong>Logo</strong></label>
                        <input type="file" id="Logo" name="logo" class="form-input" />
                        <img src="{{ asset($security->logo) }}" alt="image" class="w-24 h-24 object-cover mb-5" />

                    </div>
                </div>

                <!-- Submit Button -->
                <div>
                    <button type="submit" class="btn btn-primary !mt-6">Update</button>
                </div>
            </form>
        </div>
    </div>
    <script>
        function filterLocations() {
            var countryId = document.getElementById('countryDropdown').value;
            var stateDropdown = document.getElementById('stateDropdown');
            var cityDropdown = document.getElementById('cityDropdown');

            var selectedStateId = stateDropdown.value;

            stateDropdown.innerHTML = '<option value="">Select State</option>';
            cityDropdown.innerHTML = '<option value="">Select City</option>';

            var states = {!! json_encode($states) !!};
            states.forEach(function(state) {
                if (state.country_id == countryId) {
                    var option = document.createElement("option");
                    option.value = state.id;
                    option.text = state.name;
                    if (state.id == selectedStateId) {
                        option.selected = true;
                    }
                    stateDropdown.appendChild(option);
                }
            });

            var cities = {!! json_encode($cities) !!};
            cities.forEach(function(city) {
                if (city.state_id == selectedStateId) {
                    var option = document.createElement("option");
                    option.value = city.id;
                    option.text = city.name;
                    cityDropdown.appendChild(option);
                }
            });
        }

        
    </script>
    <script>
        function togglePasswordVisibility(inputId, button) {
            const input = document.getElementById(inputId);
            const icon = button.querySelector('i'); 

            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                input.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        }
        </script>
</x-layout.default>
