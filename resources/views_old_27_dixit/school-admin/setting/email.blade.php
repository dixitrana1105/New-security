<x-layout.default>
    <div
        class="relative flex min-h-screen items-center justify-center bg-[url(/assets/images/auth/map.png)] bg-cover bg-center bg-no-repeat px-6 py-10 dark:bg-[#060818] sm:px-16">
        <div class="panel shadow-lg rounded-lg p-8 max-w-6xl mx-auto"
            style="border-color: #a8acaf; border-width: medium;">
            <div class="flex justify-center mb-4">
                <h1 class="text-2xl font-bold">Email Setup</h1>
            </div>
            <form action="{{ route('school-email.setup.store') }}" method="POST">
                @csrf

                {{-- Check if setups exist, otherwise create an empty array to ensure form fields are displayed --}}
                @php
                    $setups = $setups->isEmpty() ? [null] : $setups;
                @endphp

                @foreach ($setups as $setup)
                    {{-- Loop through each setup --}}
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
                        <div>
                            <label for="driver"><strong>Mail Driver</strong></label>
                            <input id="driver" type="text" name="mail_driver" style="width: 100%"
                                placeholder="mail_driver" class="form-input"
                                value="{{ old('mail_driver.' . $loop->index, $setup->mail_driver ?? '') }}" required />
                        </div>
                        <div>
                            <label for="host"><strong>Mail Host</strong></label>
                            <input id="host" type="text" name="mail_host" placeholder="host" class="form-input"
                                value="{{ old('mail_host.' . $loop->index, $setup->mail_host ?? '') }}" required />
                        </div>
                        <div>
                            <label for="port"><strong>Mail Port</strong></label>
                            <input id="port" name="mail_port" type="text" placeholder="port" class="form-input"
                                value="{{ old('mail_port.' . $loop->index, $setup->mail_port ?? '') }}" required />
                        </div>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div>
                            <label for="name"><strong>Mail Username</strong></label>
                            <input id="name" type="text" name="mail_username" placeholder="name"
                                class="form-input"
                                value="{{ old('mail_username.' . $loop->index, $setup->mail_username ?? '') }}"
                                required />
                        </div>
                        <div>
                            <label for="psw"><strong>Mail Password</strong></label>
                            <div style="position: relative;">
                                <input id="psw" name="mail_password" type="password" placeholder="psw"
                                    class="form-input"
                                    value="{{ old('mail_password.' . $loop->index, $setup->mail_password ?? '') }}"
                                    required />
                                <span id="togglePassword"
                                    style="position: absolute; right: 10px; top: 50%; transform: translateY(-50%); cursor: pointer;">
                                    👁️
                                </span>
                            </div>
                        </div>

                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div>
                            <label for="encryption"><strong>Mail Encryption</strong></label>
                            <input id="encryption" name="mail_ency" type="text" placeholder="Encryption"
                                class="form-input"
                                value="{{ old('mail_ency.' . $loop->index, $setup->mail_ency ?? '') }}" required />
                        </div>
                        <div>
                            <label for="address"><strong>Mail From Address</strong></label>
                            <input id="address" name="mail_address" type="text" placeholder="Address"
                                class="form-input"
                                value="{{ old('mail_address.' . $loop->index, $setup->mail_address ?? '') }}"
                                required />
                        </div>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div>
                            <label for="mailname"><strong>Mail From Name</strong></label>
                            <input id="mailname" type="text" name="mail_name" placeholder="Name" class="form-input"
                                value="{{ old('mail_name.' . $loop->index, $setup->mail_name ?? '') }}" required />
                        </div>
                       

                        <div class="container mt-5">
                            <div x-data="modal">
                                <button type="button" class="btn btn-primary" @click="toggle"
                                    style="width: 100px; float:right; margin-bottom: 8px;">Test Email </button>
                                <div class="fixed inset-0 bg-[black]/60 z-[999]  hidden" :class="open && '!block'">
                                    <div class="flex items-start justify-center min-h-screen px-4"
                                        @click.self="open = false">
                                        <div x-show="open" x-transition x-transition.duration.300
                                            class="panel border-0 p-0 rounded-lg overflow-hidden w-full max-w-5xl my-8">
                                            <div
                                                class="flex bg-[#fbfbfb] dark:bg-[#121c2c] items-center justify-between px-5 py-3">
                                                <h5 class="font-bold text-lg">Test Email</h5>
                                                <button type="button" class="text-white-dark hover:text-dark"
                                                    @click="toggle"><svg style="max-height: 40px;"
                                                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                                        width="24" height="24" fill="none"
                                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                        stroke-linejoin="round" class="feather feather-x">
                                                        <line x1="18" y1="6" x2="6"
                                                            y2="18"></line>
                                                        <line x1="6" y1="6" x2="18"
                                                            y2="18"></line>
                                                    </svg>
                                                </button>
                                            </div>
                                            <div class="p-5">
                                                @include('school-admin.setting.email-test')
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div>
                        <input id="added_by" name="added_by" type="hidden" class="form-input"
                            value="{{ old('added_by.' . $loop->index, $setup->added_by ?? '') }}" required />
                    </div>
                @endforeach

                <div>
                    <button type="submit" class="btn btn-primary !mt-6">Submit</button>
                </div>
            </form>
        </div>
    </div>
    <script>
        const togglePassword = document.querySelector("#togglePassword");
        const passwordInput = document.querySelector("#psw");

        togglePassword.addEventListener("click", function() {
            // Toggle the type attribute
            const type = passwordInput.getAttribute("type") === "password" ? "text" : "password";
            passwordInput.setAttribute("type", type);

            // Toggle the eye icon (optional)
            this.textContent = type === "password" ? "👁️" : "🙈";
        });
    </script>
</x-layout.default>
