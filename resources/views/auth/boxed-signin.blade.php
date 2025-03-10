<x-layout.auth>

    <div x-data="auth">
        <div class="absolute inset-0">
            <img src="/assets/images/auth/bg-gradient.png" alt="image" class="h-full w-full object-cover" />
        </div>
        <div class="relative flex min-h-screen items-center justify-center bg-[url(/assets/images/auth/map.png)] bg-cover bg-center bg-no-repeat px-6 py-10 dark:bg-[#060818] sm:px-16">
            <img src="/assets/images/auth/coming-soon-object1.png" alt="image" class="absolute left-0 top-1/2 h-full max-h-[893px] -translate-y-1/2" />
            <img src="/assets/images/auth/coming-soon-object2.png" alt="image" class="absolute left-24 top-0 h-40 md:left-[30%]" />
            <img src="/assets/images/auth/coming-soon-object3.png" alt="image" class="absolute right-0 top-0 h-[300px]" />
            <img src="/assets/images/auth/polygon-object.svg" alt="image" class="absolute bottom-0 end-[28%]" />
            <div class="relative flex w-full max-w-[1502px] flex-col justify-between overflow-hidden rounded-md bg-white/60 backdrop-blur-lg dark:bg-black/50 lg:min-h-[758px] lg:flex-row lg:gap-10 xl:gap-0">
                <div
                    class="relative hidden w-full items-center justify-center bg-[linear-gradient(225deg,rgba(239,18,98,1)_0%,rgba(67,97,238,1)_100%)] p-5 lg:inline-flex lg:max-w-[835px] xl:-ms-32 ltr:xl:skew-x-[14deg] rtl:xl:skew-x-[-14deg]">
                    <div class="absolute inset-y-0 w-8 from-primary/10 via-transparent to-transparent ltr:-right-10 ltr:bg-gradient-to-r rtl:-left-10 rtl:bg-gradient-to-l xl:w-16 ltr:xl:-right-20 rtl:xl:-left-20"></div>
                    <div class="ltr:xl:-skew-x-[14deg] rtl:xl:skew-x-[14deg]">
                        <a href="/super-admin" class="w-48 block lg:w-72 ms-10">
                            <img src="/assets/images/security-logo.png" alt="Logo" class="w-48 mx-auto" />
                        </a>
                        <div class="mt-24 hidden w-full max-w-[430px] lg:block">
                            <img src="/assets/images/auth/login.svg" alt="Cover Image" class="w-full" />
                        </div>
                    </div>
                </div>
                <div class="relative flex w-full flex-col items-center justify-center gap-6 px-4 pb-16 pt-6 sm:px-6 lg:max-w-[500px] xl:max-w-[450px]">


                    <div class="w-full flex justify-center lg:hidden">
                        <a href="/super-admin" class="block w-48">
                            <img src="/assets/images/security-logo.png" alt="Logo" class="w-48 mx-auto" />
                        </a>
                    </div>
                    <div class="w-full max-w-[440px] lg:mt-16">
                        <div class="mb-10">
                            <h1 class="text-3xl font-extrabold uppercase !leading-snug text-primary md:text-4xl">Super Admin</h1>
                            <p class="text-base font-bold leading-normal text-white-dark">Enter your email and password to login</p>
                        </div>
                        <form class="space-y-5 dark:text-white" method="POST" action="{{ route('super-admin.login') }}">
                            @csrf
                            <div>
                                <label for="Email">User Name</label>
                                <div class="relative text-white-dark">
                                    <input id="Email" name="email" type="email" placeholder="Enter Email" class="form-input ps-10 placeholder:text-white-dark" required />
                                </div>
                            </div>
                            <div>
                                <label for="Password">Password</label>
                                <div class="relative text-white-dark">
                                    <input id="Password" name="password" type="password" placeholder="Enter Password" class="form-input ps-10 placeholder:text-white-dark" required />
                                </div>
                            </div>
                            <div>
                                <label for="SecretKey">Secret Key</label>
                                <div class="relative text-white-dark">
                                    <input id="SecretKey" name="secret_key" type="password" placeholder="Enter Secret Key" class="form-input ps-10 placeholder:text-white-dark" required/>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-gradient !mt-6 w-full border-0 uppercase shadow-[0_10px_20px_-10px_rgba(67,97,238,0.44)]">Sign in</button>


                        </form>
                    <p class="absolute bottom-6 w-full text-center dark:text-white">
                        © <span id="footer-year">2022</span>. V6IT All Rights Reserved.
                    </p>
                </div>
            </div>
        </div>
    </div>

</x-layout.auth>
