<x-layout.default>
    <div x-data="auth">
        <div class="relative flex min-h-screen items-center justify-center bg-[url(/assets/images/auth/map.png)] bg-cover bg-center bg-no-repeat px-4 py-6 dark:bg-[#060818] sm:px-16">
            <img src="/assets/images/auth/coming-soon-object1.png" alt="image" class="absolute left-0 top-1/2 h-full max-h-[893px] -translate-y-1/2" />
            <img src="/assets/images/auth/coming-soon-object2.png" alt="image" class="absolute left-24 top-0 h-40 md:left-[30%]" />
            <img src="/assets/images/auth/coming-soon-object3.png" alt="image" class="absolute right-0 top-0 h-[300px]" />
            <img src="/assets/images/auth/polygon-object.svg" alt="image" class="absolute bottom-0 end-[28%]" />
            <div class="relative flex w-full max-w-[1502px] flex-col justify-between overflow-hidden rounded-md bg-white/60 backdrop-blur-lg dark:bg-black/50 lg:min-h-[758px] lg:flex-row lg:gap-10 xl:gap-0">
                <div
                    class="relative hidden w-full items-center justify-center bg-[linear-gradient(225deg,rgba(239,18,98,1)_0%,rgba(67,97,238,1)_100%)] p-5 lg:inline-flex lg:max-w-[835px] xl:-ms-28 ltr:xl:skew-x-[14deg] rtl:xl:skew-x-[-14deg]">
                    <div class="absolute inset-y-0 w-8 from-primary/10 via-transparent to-transparent ltr:-right-10 ltr:bg-gradient-to-r rtl:-left-10 rtl:bg-gradient-to-l xl:w-16 ltr:xl:-right-20 rtl:xl:-left-20"></div>
                    <div class="ltr:xl:-skew-x-[14deg] rtl:xl:skew-x-[14deg]">
                        <div class="mt-24 hidden w-full max-w-[430px] lg:block">
                            <img src="/assets/images/auth/reset-password.svg" alt="Cover Image" class="w-full" />
                        </div>
                    </div>
                </div>
                <div class="relative flex w-full flex-col items-center justify-center gap-6 px-4 pb-16 pt-6 sm:px-6 lg:max-w-[667px]">

                    <div class="w-full max-w-[440px] lg:mt-16">
                        <div class="mb-7">
                            <h1 class="mb-3 text-2xl font-bold !leading-snug dark:text-white">Password Reset</h1>
                        </div>
                        <form action="{{ route('building-security.password.update') }}" method="POST">
                            @csrf
                            <div class="flex flex-col gap-2 mb-4">
                                <label for="oldpsw" class="mb-1">Old Password</label>
                                <input id="oldpsw" name="oldpsw" type="password" placeholder="Enter old password" class="form-input pl-10 placeholder:text-white-dark" required />
                            </div>
                            @error('oldpsw')
                            <span class="text-red-600">{{ $message }}</span>
                        @enderror

                            <div class="flex flex-col gap-2 mb-4">
                                <label for="newpsw" class="mb-1">New Password</label>
                                <input id="newpsw" name="newpsw" type="password" placeholder="Enter new password" class="form-input pl-10 placeholder:text-white-dark" required />
                            </div>
                            @error('newpsw')
                            <span class="text-red-600">{{ $message }}</span>
                        @enderror

                            <div class="flex flex-col gap-2 mb-4">
                                <label for="confpsw" class="mb-1">Confirm Password</label>
                                <input id="confpsw" name="newpsw_confirmation" type="password" placeholder="Enter confirm password" class="form-input pl-10 placeholder:text-white-dark" required />
                            </div>

                            <button type="submit" class="btn btn-gradient mt-6 w-full border-0 uppercase shadow-[0_10px_20px_-10px_rgba(67,97,238,0.44)]">
                                RECOVER
                            </button>
                        </form>

                    </div>
                    <p class="absolute bottom-6 w-full text-center dark:text-white">
                        © <span id="footer-year">2022</span>. V6IT All Rights Reserved.
                    </p>
                </div>
            </div>
        </div>
    </div>

</x-layout.default>
