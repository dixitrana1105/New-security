<x-layout.default>
    <div class="relative flex min-h-screen items-center justify-center bg-[url(/assets/images/auth/map.png)] bg-cover bg-center bg-no-repeat px-6 py-10 dark:bg-[#060818] sm:px-16">
        <div>
            <form action="{{ route('building-tenant.profile.update') }}" method="POST" enctype="multipart/form-data" class="border border-[#ebedf2] dark:border-[#191e3a] rounded-md p-4 mb-5 bg-white dark:bg-[#0e1726]">
                @csrf
                @foreach ($profiles as $profile)
                    <h6 class="text-lg font-bold mb-5">Set Company Profile</h6>
                    <div class="flex flex-col sm:flex-row">
                        <div class="flex-1 grid grid-cols-1 sm:grid-cols-2 gap-5">
                            <div>
                                @if($profile->logo)
                                <div class="mt-2">
                                    <div class="flex flex-col justify-center items-center">
                                        <img src="{{ asset($profile->logo) }}" alt="image" class="w-24 h-24 object-cover mb-5" />
                                    </div>
                                </div>
                            @endif
                                <label for="logo">Logo</label>
                                <input id="logo" name="logo" type="file" class="form-input" />
                            </div>

                            <div>
                                <label for="businessname">Business Name</label>
                                <input id="businessname" type="text" name="business_name" placeholder="business name"
                                    class="form-input" required value="{{ $profile->business_name ?? '' }}" />
                            </div>
                            <div>
                                <label for="name">Contact Person Name</label>
                                <input id="name" type="text" name="contact_person" placeholder="name"
                                    class="form-input" required value="{{ $profile->contact_person ?? '' }}" />
                            </div>
                            <div>
                                <label for="phone">Contact Number</label>
                                <input id="phone" type="text" name="contact_number" placeholder="+1 (530) 555-12121"
                                    class="form-input" required value="{{ $profile->contact_number ?? '' }}" />
                            </div>
                            <div>
                                <label for="email">Email</label>
                                <input id="email" type="email" name="email" placeholder="Jimmy@gmail.com"
                                    class="form-input" required value="{{ $profile->email ?? '' }}" />
                            </div>
                            <div>
                                <label for="address">Address 1</label>
                                <input id="address" type="text" name="current_address_1" placeholder="New York"
                                    class="form-input" required value="{{ $profile->current_address_1 ?? '' }}" />
                            </div>
                            <div>
                                <label for="address_1">Address 2</label>
                                <input id="address_1" type="text" name="current_address_2" placeholder="New York"
                                    class="form-input" required value="{{ $profile->current_address_2 ?? '' }}" />
                            </div>
                            <div>
                                <label for="country">Country</label>
                                <select id="countryDropdown" name="country" class="form-input" required
                                    onchange="filterLocations()">
                                    <option value="" disabled selected>Select Country</option>
                                    @foreach ($country as $countryList)
                                        <option value="{{ $countryList->id }}"
                                            @if (old('country', $profile->country) == $countryList->id) selected @endif>
                                            {{ $countryList->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label for="state">State</label>
                                <select id="stateDropdown" name="state" class="form-input" required
                                    onchange="filterLocations()">
                                    <option value="" disabled selected>Select State</option>
                                    @foreach ($states as $state)
                                        <option value="{{ $state->id }}"
                                            @if (old('state', $profile->state) == $state->id) selected @endif>
                                            {{ $state->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label for="city">City</label>
                                <select id="cityDropdown" name="city" class="form-input" required>
                                    <option value="" disabled selected>Select City</option>
                                    @foreach ($cities as $city)
                                        <option value="{{ $city->id }}"
                                            @if (old('city', $profile->city) == $city->id) selected @endif>
                                            {{ $city->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="sm:col-span-2 mt-3">
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                        </div>
                    </div>
                @endforeach
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
        </x-layout.default>
