<x-layout.default>
    <div class="relative flex min-h-screen items-center justify-center bg-[url(/assets/images/auth/map.png)] bg-cover bg-center bg-no-repeat px-6 py-10 dark:bg-[#060818] sm:px-16">
        <div>
            <form
                class="border border-[#ebedf2] dark:border-[#191e3a] rounded-md p-4 mb-5 bg-white dark:bg-[#0e1726]">
                <h6 class="text-lg font-bold mb-5">Set Company Profile</h6>
                <div class="flex flex-col sm:flex-row">                    
                    <div class="flex-1 grid grid-cols-1 sm:grid-cols-2 gap-5">
                        <div>
                            <label for="logo">Logo</label>
                            <input id="logo" type="file" 
                                class="form-input" required />
                        </div>
                        <div>
                            <label for="businessname">Business Name</label>
                            <input id="businessname" type="text" placeholder="business name"
                                class="form-input" required/>
                        </div>
                        <div>
                            <label for="name">Contact Person Name</label>
                            <input id="name" type="text" placeholder="name"
                                class="form-input" required />
                        </div>
                        <div>
                            <label for="phone">Contact Number</label>
                            <input id="phone" type="text" placeholder="+1 (530) 555-12121"
                                class="form-input" required/>
                        </div>
                        <div>
                            <label for="email">Email</label>
                            <input id="email" type="email" placeholder="Jimmy@gmail.com"
                                class="form-input" required/>
                        </div>
                        <div>
                            <label for="address">Address 1</label>
                            <input id="address" type="text" placeholder="New York"
                                class="form-input" required />
                        </div>
                        <div>
                            <label for="address_1">Address 2</label>
                            <input id="address_1" type="text" placeholder="New York"
                                class="form-input" required />
                        </div>                        
                        <div>
                            <label for="country">Country</label>
                            <select id="country" class="form-select text-white-dark" required>
                                <option>All Countries</option>
                                <option selected="">United States</option>
                                <option>India</option>
                                <option>Japan</option>
                                <option>China</option>
                                <option>Brazil</option>
                                <option>Norway</option>
                                <option>Canada</option>
                            </select>
                        </div>                     
                       <div>
                            <label for="state">State</label>
                            <select id="state" class="form-select text-white-dark" required>
                                <option>All State</option>
                                <option selected="">United States</option>
                                <option>India</option>
                                <option>Japan</option>
                                <option>China</option>
                                <option>Brazil</option>
                                <option>Norway</option>
                                <option>Canada</option>
                            </select>
                        </div>
                        <div>
                            <label for="city">City</label>
                            <select id="city" class="form-select text-white-dark" required>
                                <option>All City</option>
                                <option selected="">United States</option>
                                <option>India</option>
                                <option>Japan</option>
                                <option>China</option>
                                <option>Brazil</option>
                                <option>Norway</option>
                                <option>Canada</option>
                            </select>
                        </div>                       
                        <div class="sm:col-span-2 mt-3">
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </div>
                </div>
            </form>            
        </div>
    </div>
        </x-layout.default>