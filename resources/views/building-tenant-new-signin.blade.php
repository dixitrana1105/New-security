<x-layout.auth>
    <div x-data="{ currentForm: 'building-tenant' }">
        <div class="absolute inset-0">
            <img src="/assets/images/auth/bg-gradient.png" alt="image" class="h-full w-full object-cover" />
        </div>
        <div class="relative flex min-h-screen items-center justify-center bg-[url(/assets/images/auth/map.png)] bg-cover bg-center bg-no-repeat px-6 py-10 dark:bg-[#060818] sm:px-16 tenant">
            <img src="/assets/images/auth/coming-soon-object1.png" alt="image" class="absolute left-0 top-1/2 h-full max-h-[893px] -translate-y-1/2" />
            <img src="/assets/images/auth/coming-soon-object2.png" alt="image" class="absolute left-24 top-0 h-40 md:left-[30%]" />
            <img src="/assets/images/auth/coming-soon-object3.png" alt="image" class="absolute right-0 top-0 h-[300px]" />
            <img src="/assets/images/auth/polygon-object.svg" alt="image" class="absolute bottom-0 end-[28%]" />
            <div class="relative flex w-full max-w-[800px] flex-col justify-between overflow-hidden rounded-md bg-white/60 backdrop-blur-lg dark:bg-black/50 lg:min-h-[500px] lg:flex-row lg:gap-10 xl:gap-0">
                <!-- Left Part: Buttons and Logo -->
                <div class="relative w-full lg:max-w-[250px] p-4 flex flex-col items-center justify-center bg-[linear-gradient(225deg,rgba(239,18,98,1)_0%,rgba(67,97,238,1)_100%)]">
                    <div class="w-36 mb-8">
                        <img src="/assets/images/security-logo.png" alt="Logo" class="w-full" />
                    </div>
                    <div class="w-full space-y-4">
                        <button
                            @click="currentForm = 'building-tenant'"
                            :class="{'bg-primary/90 text-white': currentForm === 'building-tenant', 'bg-gray-100 hover:bg-gray-200 text-gray-700': currentForm !== 'building-tenant'}"
                            class="btn w-full border-0 uppercase transition-all duration-300 ease-in-out transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-primary/50 rounded-lg py-2 px-4 shadow-md"
                        >
                            Building User
                        </button>
                        <button
                            @click="currentForm = 'school-security'"
                            :class="{'bg-primary/90 text-white': currentForm === 'school-security', 'bg-gray-100 hover:bg-gray-200 text-gray-700': currentForm !== 'school-security'}"
                            class="btn w-full border-0 uppercase transition-all duration-300 ease-in-out transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-primary/50 rounded-lg py-2 px-4 shadow-md"
                        >
                            School Security
                        </button>
                        <button
                            @click="currentForm = 'building-security'"
                            :class="{'bg-primary/90 text-white': currentForm === 'building-security', 'bg-gray-100 hover:bg-gray-200 text-gray-700': currentForm !== 'building-security'}"
                            class="btn w-full border-0 uppercase transition-all duration-300 ease-in-out transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-primary/50 rounded-lg py-2 px-4 shadow-md"
                        >
                            Building Security
                        </button>
                    </div>
                </div>

                <!-- Right Part: Form -->
                <div class="relative flex w-full flex-col items-center justify-center gap-4 px-4 pb-12 pt-4 sm:px-6 lg:max-w-[500px]">
                    <!-- Slider Container -->
                    <div class="w-full max-w-[360px] lg:mt-12">
                        <!-- Building Tenant Form -->
                        <div x-show="currentForm === 'building-tenant'" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 transform translate-x-4" x-transition:enter-end="opacity-100 transform translate-x-0" x-transition:leave="transition ease-in duration-300" x-transition:leave-start="opacity-100 transform translate-x-0" x-transition:leave-end="opacity-0 transform -translate-x-4">
                            <div class="mb-8">
                                <h1 class="text-2xl font-extrabold uppercase !leading-snug text-primary md:text-3xl">Building User</h1>
                                <p class="text-sm font-bold leading-normal text-white-dark">Enter your email and password to login</p>
                            </div>
                            <form id="loginForm" class="space-y-4 dark:text-white" method="POST" action="{{ route('building-tenant.login') }}">
                                @csrf
                                <!-- Form fields for Building Tenant -->
                                <div>
                                    <label for="Email">User Name</label>
                                    <div class="relative text-white-dark">
                                        <input id="Email" name="email" type="email" placeholder="Enter Email" class="form-input ps-10 placeholder:text-white-dark" required />
                                        <span class="absolute start-4 top-1/2 -translate-y-1/2">
                                            <!-- Email Icon SVG -->
                                            <svg width="18" height="18" viewBox="0 0 18 18" fill="none">
                                                <path opacity="0.5" d="M10.65 2.25H7.35..." fill="currentColor" />
                                                <path d="M14.3465 6.02574C14.609 5.80698..." fill="currentColor" />
                                            </svg>
                                        </span>
                                    </div>
                                </div>
                                <div>
                                    <label for="Password">Password</label>
                                    <div class="relative text-white-dark">
                                        <input id="Password" name="password" type="password" placeholder="Enter Password" class="form-input ps-10 placeholder:text-white-dark" required />
                                        <span class="absolute start-4 top-1/2 -translate-y-1/2">
                                            <!-- Password Icon SVG -->
                                            <svg width="18" height="18" viewBox="0 0 18 18" fill="none">
                                                <path opacity="0.5" d="M1.5 12C1.5 9.87868..." fill="currentColor" />
                                                <path d="M6 12.75C6.41421 12.75..." fill="currentColor" />
                                            </svg>
                                        </span>
                                    </div>
                                </div>
                                <div>
                                    <label for="SecretKey">Secret Key</label>
                                    <div class="relative text-white-dark">
                                        <input id="SecretKey" name="secret_key" type="password" placeholder="Enter Secret Key" class="form-input ps-10 placeholder:text-white-dark" />
                                        <span class="absolute start-4 top-1/2 -translate-y-1/2">
                                            <!-- Secret Key Icon SVG -->
                                            <svg width="18" height="18" viewBox="0 0 18 18" fill="none">
                                                <path opacity="0.5" d="M1.5 12C1.5 9.87868..." fill="currentColor" />
                                                <path d="M6 12.75C6.41421 12.75..." fill="currentColor" />
                                            </svg>
                                        </span>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-gradient !mt-4 w-full border-0 uppercase shadow-[0_10px_20px_-10px_rgba(67,97,238,0.44)]">
                                    Sign In
                                </button>
                            </form>
                        </div>

                        <!-- School Security Form -->
                        <div x-show="currentForm === 'school-security'" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 transform translate-x-4" x-transition:enter-end="opacity-100 transform translate-x-0" x-transition:leave="transition ease-in duration-300" x-transition:leave-start="opacity-100 transform translate-x-0" x-transition:leave-end="opacity-0 transform -translate-x-4">
                            <div class="mb-8">
                                <h1 class="text-2xl font-extrabold uppercase !leading-snug text-primary md:text-3xl">School Security</h1>
                                <p class="text-sm font-bold leading-normal text-white-dark">Enter your email and password to login</p>
                            </div>
                            <form id="loginForm" class="space-y-4 dark:text-white" method="POST" action="{{ route('school.security.login') }}">
                                @csrf
                                <!-- Form fields for School Security -->
                                <div>
                                    <label for="Email">User Name</label>
                                    <div class="relative text-white-dark">
                                        <input id="Email" name="email" type="email" placeholder="Enter Email" class="form-input ps-10 placeholder:text-white-dark" required />
                                        <span class="absolute start-4 top-1/2 -translate-y-1/2">
                                            <!-- Email Icon SVG -->
                                            <svg width="18" height="18" viewBox="0 0 18 18" fill="none">
                                                <path opacity="0.5" d="M10.65 2.25H7.35..." fill="currentColor" />
                                                <path d="M14.3465 6.02574C14.609 5.80698..." fill="currentColor" />
                                            </svg>
                                        </span>
                                    </div>
                                </div>
                                <div>
                                    <label for="Password">Password</label>
                                    <div class="relative text-white-dark">
                                        <input id="Password" name="password" type="password" placeholder="Enter Password" class="form-input ps-10 placeholder:text-white-dark" required />
                                        <span class="absolute start-4 top-1/2 -translate-y-1/2">
                                            <!-- Password Icon SVG -->
                                            <svg width="18" height="18" viewBox="0 0 18 18" fill="none">
                                                <path opacity="0.5" d="M1.5 12C1.5 9.87868..." fill="currentColor" />
                                                <path d="M6 12.75C6.41421 12.75..." fill="currentColor" />
                                            </svg>
                                        </span>
                                    </div>
                                </div>
                                <div>
                                    <label for="SecretKey">Secret Key</label>
                                    <div class="relative text-white-dark">
                                        <input id="SecretKey" name="secret_key" type="password" placeholder="Enter Secret Key" class="form-input ps-10 placeholder:text-white-dark" />
                                        <span class="absolute start-4 top-1/2 -translate-y-1/2">
                                            <!-- Secret Key Icon SVG -->
                                            <svg width="18" height="18" viewBox="0 0 18 18" fill="none">
                                                <path opacity="0.5" d="M1.5 12C1.5 9.87868..." fill="currentColor" />
                                                <path d="M6 12.75C6.41421 12.75..." fill="currentColor" />
                                            </svg>
                                        </span>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-gradient !mt-4 w-full border-0 uppercase shadow-[0_10px_20px_-10px_rgba(67,97,238,0.44)]">
                                    Sign In
                                </button>
                            </form>
                        </div>

                        <!-- Building Security Form -->
                        <div x-show="currentForm === 'building-security'" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 transform translate-x-4" x-transition:enter-end="opacity-100 transform translate-x-0" x-transition:leave="transition ease-in duration-300" x-transition:leave-start="opacity-100 transform translate-x-0" x-transition:leave-end="opacity-0 transform -translate-x-4">
                            <div class="mb-8">
                                <h1 class="text-2xl font-extrabold uppercase !leading-snug text-primary md:text-3xl">Building Security</h1>
                                <p class="text-sm font-bold leading-normal text-white-dark">Enter your email and password to login</p>
                            </div>
                            <form id="loginForm" class="space-y-4 dark:text-white" method="POST" action="{{ route('building-security.login') }}">
                                @csrf
                                <!-- Form fields for Building Security -->
                                <div>
                                    <label for="Email">User Name</label>
                                    <div class="relative text-white-dark">
                                        <input id="Email" name="email" type="email" placeholder="Enter Email" class="form-input ps-10 placeholder:text-white-dark" required />
                                        <span class="absolute start-4 top-1/2 -translate-y-1/2">
                                            <!-- Email Icon SVG -->
                                            <svg width="18" height="18" viewBox="0 0 18 18" fill="none">
                                                <path opacity="0.5" d="M10.65 2.25H7.35..." fill="currentColor" />
                                                <path d="M14.3465 6.02574C14.609 5.80698..." fill="currentColor" />
                                            </svg>
                                        </span>
                                    </div>
                                </div>
                                <div>
                                    <label for="Password">Password</label>
                                    <div class="relative text-white-dark">
                                        <input id="Password" name="password" type="password" placeholder="Enter Password" class="form-input ps-10 placeholder:text-white-dark" required />
                                        <span class="absolute start-4 top-1/2 -translate-y-1/2">
                                            <!-- Password Icon SVG -->
                                            <svg width="18" height="18" viewBox="0 0 18 18" fill="none">
                                                <path opacity="0.5" d="M1.5 12C1.5 9.87868..." fill="currentColor" />
                                                <path d="M6 12.75C6.41421 12.75..." fill="currentColor" />
                                            </svg>
                                        </span>
                                    </div>
                                </div>
                                <div>
                                    <label for="SecretKey">Secret Key</label>
                                    <div class="relative text-white-dark">
                                        <input id="SecretKey" name="secret_key" type="password" placeholder="Enter Secret Key" class="form-input ps-10 placeholder:text-white-dark" />
                                        <span class="absolute start-4 top-1/2 -translate-y-1/2">
                                            <!-- Secret Key Icon SVG -->
                                            <svg width="18" height="18" viewBox="0 0 18 18" fill="none">
                                                <path opacity="0.5" d="M1.5 12C1.5 9.87868..." fill="currentColor" />
                                                <path d="M6 12.75C6.41421 12.75..." fill="currentColor" />
                                            </svg>
                                        </span>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-gradient !mt-4 w-full border-0 uppercase shadow-[0_10px_20px_-10px_rgba(67,97,238,0.44)]">
                                    Sign In
                                </button>
                            </form>
                        </div>
                    </div>

                    {{-- <p class="absolute bottom-4 w-full text-center dark:text-white">
                        © <span id="footer-year">2022</span>. V6IT All Rights Reserved.
                    </p> --}}
                </div>
            </div>
        </div>
    </div>
</x-layout.auth>
