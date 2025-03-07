<x-layout.default>
    <div class="relative flex min-h-screen items-center justify-center bg-[url(/assets/images/auth/map.png)] bg-cover bg-center bg-no-repeat px-6 py-10 dark:bg-[#060818] sm:px-16">

    <div class="panel shadow-lg rounded-lg p-8 max-w-6xl mx-auto " style="border-color: #a8acaf; border-width: medium;">
        <div class="flex justify-center mb-4">
            <h1 class="text-2xl font-bold">Edit Security</h1>
        </div>
       

        <form method="POST" action="{{route('school.security.update', $value->id )}}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <div>
                    <label for="name"><strong>Name</strong></label>
                    <input id="name" type="text" name="name" value="{{ $value->name}}" placeholder="Enter Name" class="form-input" required />
                </div>
                <div>
                    <label for="contact"><strong>Contact Number</strong></label>
                    <input id="contact" name="contact" type="number" value="{{ $value->contant_number}}" placeholder="Enter Contact Number" class="form-input" required />
                </div>
            </div>

            <!-- WhatsApp Number and Email -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <div>
                    <label for="whatsup"><strong>WhatsApp Number</strong></label>
                    <input id="whatsup" name="whatsup" type="number" value="{{ $value->whatsapp}}" placeholder="Enter WhatsApp Number" class="form-input" required />
                </div>
                <div>
                    <label for="email"><strong>Email ID</strong></label>
                    <div class="flex">
                        <div class="bg-[#eee] flex justify-center items-center ltr:rounded-l-md rtl:rounded-r-md px-3 font-semibold border ltr:border-r-0 rtl:border-l-0 border-[#e0e6ed] dark:border-[#17263c] dark:bg-[#1b2e4b]">@</div>
                        <input id="email" type="email" name="email" value="{{ $value->email}}" placeholder="Enter Email" class="form-input ltr:rounded-l-none rtl:rounded-r-none" required />
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
                    <input id="current_address_1" name="current_address_1" value="{{ $value->c_address_1}}" type="text" placeholder="Enter Address 1" class="form-input" required />
                </div>
                <div>
                    <label for="current_address_2"><strong>Address 2</strong></label>
                    <input id="current_address_2" name="current_address_2" value="{{ $value->c_address_2}}" type="text" placeholder="Enter Address 2" class="form-input" />
                </div>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <div>
                    <label for="landmark"><strong>Landmark</strong></label>
                    <input id="landmark" name="landmark" value="{{ $value->c_landmark}}" type="text" placeholder="Enter Landmark" class="form-input" />
                </div>
                <div>
                    <label for="current_city"><strong>City</strong></label>
                    <input id="current_city" name="current_city" value="{{ $value->current_city}}" type="text" placeholder="Enter City" class="form-input" required />
                </div>
            </div>

            <!-- Permanent Address -->
            <div>
                <label><strong>Permanent Address</strong></label>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <div>
                    <label for="permanent_address_1"><strong>Address 1</strong></label>
                    <input id="permanent_address_1" name="permanent_address_1" value="{{ $value->p_address_1}}" type="text" placeholder="Enter Address 1" class="form-input" required />
                </div>
                <div>
                    <label for="permanent_address_2"><strong>Address 2</strong></label>
                    <input id="permanent_address_2" name="permanent_address_2" value="{{ $value->p_address_2}}" type="text" placeholder="Enter Address 2" class="form-input" />
                </div>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
                <div>
                    <label for="country"><strong>Country</strong></label>
                    <select id="countryDropdown" name="country"  class="form-input" required onchange="filterLocations()">
                        <option value="" disabled selected>Select Country</option> 
                        @isset($country)
                        @foreach ($country as $countryList)
                            <option value="{{ $countryList->id }}"
                                {{ $value->country == $countryList->id ? 'selected' : '' }}>{{ $countryList->name }}
                            </option>
                        @endforeach
                        @endisset
                    </select>                </div>
                <div>
                    <label for="state"><strong>State</strong></label>
                    <select id="stateDropdown" name="state"  class="form-input" required onchange="filterLocations()">
                        <option value="{{ $value->state }}">{{ $value->State->name }}</option>
                    </select>
                </div>
                <div>
                    <label for="permanent_city"><strong>City</strong></label>
                    <select id="cityDropdown" name="city"  class="form-input" required>
                        <option value="{{ $value->city }}">{{ $value->City->name }}</option>
                    </select>
                </div>
            </div>
             <!-- Photo ID and Address Proof Upload -->
             <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
                <div>
                    <label for="photoId"><strong>Photo ID (Upload)</strong></label>
                    <input type="file" id="photoId" name="photoId" class="form-input"  />
                    <a href="{{ asset('assets/upload/'.$value->photo_id) }}" download="{{ $value->photo_id }}" target="_blank" style="color: blue;">
                        {{$value->photo_id}}</a>
                </div>
                <div>
                    <label for="addressProof"><strong>Address Proof (Upload)</strong></label>
                    <input type="file" id="addressProof" name="addressProof" class="form-input"  />
                    <a href="{{ asset('assets/upload/'.$value->address_proof) }}" download="{{ $value->address_proof }}" target="_blank" style="color: blue;">
                        {{$value->address_proof}}</a>
                </div>
                <div>
                    <label for="photo"><strong>Photo (Upload)</strong></label>
                    <input type="file" id="photo" name="photo" class="form-input"  />
                    <a href="{{ asset('assets/images/'.$value->photo) }}" download="{{ $value->photo }}" target="_blank" style="color: blue;">
                        {{$value->photo}}</a>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
                <div>
                    <label for="workingFromDate"><strong>Working From Date</strong></label>
                    <input id="workingFromDate" name="workingFromDate" value="{{ $value->working_date }}" type="date" class="form-input" required />
                </div>                
                <div>
                    <label for="password"><strong>Password</strong></label>
                    <input id="password" name="password" type="password" placeholder="Enter password" class="form-input"  />
                </div>
                <div>
                    <label for="secretkey"><strong>Secret Key</strong></label>
                    <input id="secretkey" name="secretkey" value="{{ $value->secret_key }}" type="text" placeholder="Enter secretkey" class="form-input" required />
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
    <script>
        function filterLocations() {
            var countryId = document.getElementById('countryDropdown').value;
            var stateDropdown = document.getElementById('stateDropdown');
            var cityDropdown = document.getElementById('cityDropdown');
    
            // Get the currently selected state (if any)
            var selectedStateId = stateDropdown.value;
    
            // Clear existing options
            stateDropdown.innerHTML = '<option value="">Select State</option>';
            cityDropdown.innerHTML = '<option value="">Select City</option>';
    
            // Show states corresponding to the selected country
            var states = {!! json_encode($states) !!};
            states.forEach(function(state) {
                if (state.country_id == countryId) {
                    var option = document.createElement("option");
                    option.value = state.id;
                    option.text = state.name;
                    if (state.id == selectedStateId) {
                        option.selected = true; // Set selected attribute for the selected state
                    }
                    stateDropdown.appendChild(option);
                }
            });
    
            // Show cities corresponding to the selected state
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


    </x-layout.default>