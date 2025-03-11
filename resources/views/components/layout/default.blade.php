<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset='utf-8' />
    <meta http-equiv='X-UA-Compatible' content='IE=edge' />
    <title>{{ $title ?? 'V6IT' }}</title>

    <meta name='viewport' content='width=device-width, initial-scale=1' />
    <link rel="icon" type="image/svg" href="/assets/images/security-logo.jpg" />

    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;500;600;700;800&display=swap"
        rel="stylesheet" />

    <script src="/assets/js/perfect-scrollbar.min.js"></script>
    <script defer src="/assets/js/popper.min.js"></script>
    <script defer src="/assets/js/tippy-bundle.umd.min.js"></script>
    <script defer src="/assets/js/sweetalert.min.js"></script>
    {{-- <!--@vite(['resources/css/app.css'])--> --}}


    {{-- @if (strpos(request()->getHost(), '127.0.0.1') !== false || strpos(request()->getHost(), 'localhost') !== false)
        @vite(['resources/css/app.css'])
    @else --}}
    <!-- CSS and JS for Live Environment -->
    <link rel="preload" as="style" href="{{ asset('assets/build/assets/app.5875a52e.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/build/assets/app.5875a52e.css') }}" data-navigate-track="reload" />
    {{-- @endif --}}
</head>

<body x-data="main" class="antialiased relative font-nunito text-sm font-normal overflow-x-hidden"
    :class="[$store.app.sidebar ? 'toggle-sidebar' : '', $store.app.theme === 'dark' || $store.app.isDarkMode ? 'dark' : '',
        $store.app.menu, $store.app.layout, $store.app
        .rtlClass
    ]">

    <!-- sidebar menu overlay -->
    <div x-cloak class="fixed inset-0 bg-[black]/60 z-50 lg:hidden" :class="{ 'hidden': !$store.app.sidebar }"
        @click="$store.app.toggleSidebar()"></div>

    <!-- screen loader -->
    <div
        class="screen_loader fixed inset-0 bg-[#fafafa] dark:bg-[#060818] z-[60] grid place-content-center animate__animated">
        <svg width="64" height="64" viewBox="0 0 135 135" xmlns="http://www.w3.org/2000/svg" fill="#4361ee">
            <path
                d="M67.447 58c5.523 0 10-4.477 10-10s-4.477-10-10-10-10 4.477-10 10 4.477 10 10 10zm9.448 9.447c0 5.523 4.477 10 10 10 5.522 0 10-4.477 10-10s-4.478-10-10-10c-5.523 0-10 4.477-10 10zm-9.448 9.448c-5.523 0-10 4.477-10 10 0 5.522 4.477 10 10 10s10-4.478 10-10c0-5.523-4.477-10-10-10zM58 67.447c0-5.523-4.477-10-10-10s-10 4.477-10 10 4.477 10 10 10 10-4.477 10-10z">
                <animateTransform attributeName="transform" type="rotate" from="0 67 67" to="-360 67 67" dur="2.5s"
                    repeatCount="indefinite" />
            </path>
            <path
                d="M28.19 40.31c6.627 0 12-5.374 12-12 0-6.628-5.373-12-12-12-6.628 0-12 5.372-12 12 0 6.626 5.372 12 12 12zm30.72-19.825c4.686 4.687 12.284 4.687 16.97 0 4.686-4.686 4.686-12.284 0-16.97-4.686-4.687-12.284-4.687-16.97 0-4.687 4.686-4.687 12.284 0 16.97zm35.74 7.705c0 6.627 5.37 12 12 12 6.626 0 12-5.373 12-12 0-6.628-5.374-12-12-12-6.63 0-12 5.372-12 12zm19.822 30.72c-4.686 4.686-4.686 12.284 0 16.97 4.687 4.686 12.285 4.686 16.97 0 4.687-4.686 4.687-12.284 0-16.97-4.685-4.687-12.283-4.687-16.97 0zm-7.704 35.74c-6.627 0-12 5.37-12 12 0 6.626 5.373 12 12 12s12-5.374 12-12c0-6.63-5.373-12-12-12zm-30.72 19.822c-4.686-4.686-12.284-4.686-16.97 0-4.686 4.687-4.686 12.285 0 16.97 4.686 4.687 12.284 4.687 16.97 0 4.687-4.685 4.687-12.283 0-16.97zm-35.74-7.704c0-6.627-5.372-12-12-12-6.626 0-12 5.373-12 12s5.374 12 12 12c6.628 0 12-5.373 12-12zm-19.823-30.72c4.687-4.686 4.687-12.284 0-16.97-4.686-4.686-12.284-4.686-16.97 0-4.687 4.686-4.687 12.284 0 16.97 4.686 4.687 12.284 4.687 16.97 0z">
                <animateTransform attributeName="transform" type="rotate" from="0 67 67" to="360 67 67" dur="8s"
                    repeatCount="indefinite" />
            </path>
        </svg>
    </div>

    <div class="fixed bottom-6 ltr:right-6 rtl:left-6 z-50" x-data="scrollToTop">
        <template x-if="showTopButton">
            <button type="button"
                class="btn btn-outline-primary rounded-full p-2 animate-pulse bg-[#fafafa] dark:bg-[#060818] dark:hover:bg-primary"
                @click="goToTop">
                <svg width="24" height="24" class="h-4 w-4" viewBox="0 0 24 24" fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <path opacity="0.5" fill-rule="evenodd" clip-rule="evenodd"
                        d="M12 20.75C12.4142 20.75 12.75 20.4142 12.75 20L12.75 10.75L11.25 10.75L11.25 20C11.25 20.4142 11.5858 20.75 12 20.75Z"
                        fill="currentColor" />
                    <path
                        d="M6.00002 10.75C5.69667 10.75 5.4232 10.5673 5.30711 10.287C5.19103 10.0068 5.25519 9.68417 5.46969 9.46967L11.4697 3.46967C11.6103 3.32902 11.8011 3.25 12 3.25C12.1989 3.25 12.3897 3.32902 12.5304 3.46967L18.5304 9.46967C18.7449 9.68417 18.809 10.0068 18.6929 10.287C18.5768 10.5673 18.3034 10.75 18 10.75L6.00002 10.75Z"
                        fill="currentColor" />
                </svg>
            </button>
        </template>
    </div>

    <script>
        document.addEventListener("alpine:init", () => {
            Alpine.data("scrollToTop", () => ({
                showTopButton: false,
                init() {
                    window.onscroll = () => {
                        this.scrollFunction();
                    };
                },

                scrollFunction() {
                    if (document.body.scrollTop > 50 || document.documentElement.scrollTop > 50) {
                        this.showTopButton = true;
                    } else {
                        this.showTopButton = false;
                    }
                },

                goToTop() {
                    document.body.scrollTop = 0;
                    document.documentElement.scrollTop = 0;
                },
            }));
        });
    </script>

    <x-common.theme-customiser />

    <div class="main-container text-black dark:text-white-dark min-h-screen" :class="[$store.app.navbar]">

        <x-common.superadmin-sidebar />

        @if (Request::is(
                'building/dashboard',
                'building-admin/tenant-create',
                'building-admin/tenant-index',
                'building-admin/tenant-edit/*',
                'building-admin/security-index',
                'building-admin/security-create',
                'building-admin/security-edit',
                'building-admin/profile-form',
                'building-admin/sub-tenant',
                'building-admin/visitor-log',
                'building-admin/password-reset',
                'building-admin/key-reset',
                'building-admin/security-edit/*',
                'building-admin/ticket-dashboard',
                'building-admin/new-ticket',
                'building-admin/open-ticket',
                'building-admin/hold-ticket',
                'building-admin/close-ticket',
                'building-admin/myTicket-index',
                'building-admin/myTicket-create',
                'building-admin/profile'))
            <x-common.building-sidebar />
        @endif


        @if (Request::is(
                'building-security/dashboard',
                'building-security/visitor-index',
                'building-security/new-entry',
                'building-security/repeat-visitor-create',
                'building-security/visitor-create',
                'building-security/tenant-index',
                'building-security/security-index',
                'building-security/sub-tenant',
                'building-security/visitor-log',
                'building-security/tenant-add-visitor-index-for-visitor',
                'building-security/profile',
                'building-security/key-reset',
                'building-security/security-show',
                'building-security/security-show/*',
                'building-security/profile',
                'building-security/profile-form',
                'building-security/password-reset',
                                'newMessages*',

                'building-security/new-ticket',
                'building-security/ticket-dashboard',
                'building-security/open-ticket',
                'building-security/hold-ticket',
                'building-security/close-ticket',
                'building-security/myTicket-index',
                'building-security/myTicket-create'))
            <x-common.building-security-sidebar />
        @endif





        @if (Request::is(
                'building-tenant/dashboard',
                'building-sub-tenant/dashboard',
                'building-sub-tenant/visitor-index',
                'building-tenant/visitor-index',
                'building-tenant/visitor-create',
                'building-tenant/tenant-index',
                'building-tenant/tenant-add-visitor-index',
                'building-tenant/sub-tenant-create',
                'building-tenant/security-index',
                'building-tenant/sub-tenant',
                'building-tenant/visitor-log',
                'building-tenant/new-ticket',
                'building-tenant/ticket-dashboard',
                'building-tenant/security-show/*',
                'building-tenant/open-ticket',
                'building-tenant/hold-ticket',
                'building-tenant/close-ticket',
                'building-tenant/myTicket-index',
                'building-tenant/myTicket-create',
                'building-tenant/profile',
                'building-tenant/profile-form',
                'building-tenant/password-reset'))
            <x-common.building-tenant-sidebar />
        @endif



        @if (Request::is(
                'school/dashboard',
                'school/student/create',
                'school/student/index',
                'school/student/edit/*',
                'school/security/index',
                'school/security/create',
                'school/security/edit',
                'school/security/edit/*',
                'school-admin/visitor-log',
                'school-admin/hold-ticket',
                'school-admin/my-ticket-index',
                'school-admin/my-ticket-create',
                'school-admin/close-ticket',
                'school-admin/open-ticket',
                'school-admin/new-ticket',
                'school-admin/dashboard-ticket',
                'school-admin/setting/profile',
                'school-admin/setting/profile-form',
                'school-admin/setting/email',
                'school-admin/setting/reset-password',
                'school-admin/setting/reset-key'))
            <x-common.school-sidebar />
        @endif


        @if (Request::is(
                'school/security/dashboard',
                'school/security/close-ticket',
                'school/security/new-ticket',
                'school/security/hold-ticket',
                'school/security/open-ticket',
                'school/security/my-ticket-create',
                'school/security/my-ticket-index',
                'school/security/dashboard-ticket',
                'school/security/setting/profile',
                'school/security/setting/profile-form',
                'school/security/setting/reset-password',
                'school/security/report/sub-tenant',
                'school/security/report/visitor-log',
                'school/security/visitor/create',
                'school/security/visitor/index',
                'school/security/master/security-index',
                'school/security/master/student-index',
                'new-entry',
                'school/security/repeat-visitor/create'))
            <x-common.school-security-sidebar />
        @endif


        <div class="main-content flex flex-col min-h-screen">
            <x-common.header/>

            @include('partials.messages')


            <div class="p-6 animate__animated" :class="[$store.app.animation]">
                {{ $slot }}
            </div>

            <x-pagination :paginator="$paginator" />


            <x-common.footer />
        </div>
    </div>
    <script src="/assets/js/alpine-collaspe.min.js"></script>
    <script src="/assets/js/alpine-persist.min.js"></script>
    <script defer src="/assets/js/alpine-ui.min.js"></script>
    <script defer src="/assets/js/alpine-focus.min.js"></script>
    <script defer src="/assets/js/alpine.min.js"></script>
    <script src="/assets/js/custom.js"></script>
</body>

</html>
