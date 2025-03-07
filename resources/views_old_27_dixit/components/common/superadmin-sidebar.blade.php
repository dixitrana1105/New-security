<div :class="{ 'dark text-white-dark': $store.app.semidark }">
    <nav x-data="sidebar"
        class="sidebar fixed min-h-screen h-full top-0 bottom-0 w-[260px] shadow-[5px_0_25px_0_rgba(94,92,154,0.1)] z-50 transition-all duration-300">
        <div class="bg-white dark:bg-[#0e1726] h-full">
            <div class="flex justify-between items-center px-4 py-3">
                <a href="/" class="main-logo flex items-center shrink-0">
                    <img class="w-8 ml-[5px] flex-none" src="/assets/images/security-logo.png"
                        alt="image" />
                    <span
                        class="text-2xl ltr:ml-1.5 rtl:mr-1.5  font-semibold  align-middle lg:inline dark:text-white-light">V6IT</span>
                </a>
                <a href="javascript:;"
                    class="collapse-icon w-8 h-8 rounded-full flex items-center hover:bg-gray-500/10 dark:hover:bg-dark-light/10 dark:text-white-light transition duration-300 rtl:rotate-180"
                    @click="$store.app.toggleSidebar()">
                    <svg class="w-5 h-5 m-auto" width="20" height="20" viewBox="0 0 24 24" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path d="M13 19L7 12L13 5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                            stroke-linejoin="round" />
                        <path opacity="0.5" d="M16.9998 19L10.9998 12L16.9998 5" stroke="currentColor"
                            stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </a>
            </div>
            <ul class="perfect-scrollbar relative font-semibold space-y-0.5 h-[calc(100vh-80px)] overflow-y-auto overflow-x-hidden  p-4 py-0"
                x-data="{ activeDropdown: null }">

                <li class="menu nav-item">
                    <a href="/dashboard" class="nav-link group">
                        <div class="flex items-center">
                            <svg class="group-hover:!text-primary shrink-0" width="20" height="20" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path opacity="0.5"
                                    d="M2 12.2039C2 9.91549 2 8.77128 2.5192 7.82274C3.0384 6.87421 3.98695 6.28551 5.88403 5.10813L7.88403 3.86687C9.88939 2.62229 10.8921 2 12 2C13.1079 2 14.1106 2.62229 16.116 3.86687L18.116 5.10812C20.0131 6.28551 20.9616 6.87421 21.4808 7.82274C22 8.77128 22 9.91549 22 12.2039V13.725C22 17.6258 22 19.5763 20.8284 20.7881C19.6569 22 17.7712 22 14 22H10C6.22876 22 4.34315 22 3.17157 20.7881C2 19.5763 2 17.6258 2 13.725V12.2039Z"
                                    fill="currentColor" />
                                <path
                                    d="M9 17.25C8.58579 17.25 8.25 17.5858 8.25 18C8.25 18.4142 8.58579 18.75 9 18.75H15C15.4142 18.75 15.75 18.4142 15.75 18C15.75 17.5858 15.4142 17.25 15 17.25H9Z"
                                    fill="currentColor" />
                            </svg>

                            <span
                                class="ltr:pl-3 rtl:pr-3 text-black dark:text-[#506690] dark:group-hover:text-white-dark">Dashboard</span>
                        </div>
                    </a>
                </li>

                <h2
                    class="py-3 px-7 flex items-center uppercase font-extrabold bg-white-light/30 dark:bg-dark dark:bg-opacity-[0.08] -mx-4 mb-1">

                    <svg class="w-4 h-5 flex-none hidden" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"
                        fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="5" y1="12" x2="19" y2="12"></line>
                    </svg>
                    <span>Master</span>
                </h2>
                <li class="nav-item">
                    <ul>
                        <li class="menu nav-item">
                            <button type="button" class="nav-link group"
                                :class="{ 'active': activeDropdown === 'building' }"
                                @click="activeDropdown === 'building' ? activeDropdown = null : activeDropdown = 'building'">
                                <div class="flex items-center">

                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M3 22V12C3 10.1144 3 9.17157 3.58579 8.58579C4.17157 8 5.11438 8 7 8C8.88562 8 9.82843 8 10.4142 8.58579C11 9.17157 11 10.1144 11 12" stroke="currentColor" stroke-width="1.5"></path>
                                        <path d="M17 22V16C17 14.1144 17 13.1716 16.4142 12.5858C15.8284 12 14.8856 12 13 12H11C9.11438 12 8.17157 12 7.58579 12.5858C7 13.1716 7 14.1144 7 16V22" stroke="currentColor" stroke-width="1.5"></path>
                                        <path d="M21 21.9999V7.77195C21 6.4311 21 5.76068 20.6439 5.24676C20.2877 4.73283 19.66 4.49743 18.4045 4.02663C15.9492 3.10591 14.7216 2.64555 13.8608 3.2421C13 3.83864 13 5.14974 13 7.77195V11.9999" stroke="currentColor" stroke-width="1.5"></path>
                                        <path d="M4 8V6.5C4 5.55719 4 5.08579 4.29289 4.79289C4.58579 4.5 5.05719 4.5 6 4.5H8C8.94281 4.5 9.41421 4.5 9.70711 4.79289C10 5.08579 10 5.55719 10 6.5V8" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"></path>
                                        <path d="M7 4V2" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"></path>
                                        <path d="M22 22L2 22" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"></path>
                                        <path d="M10 15H14" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"></path>
                                        <path d="M10 18H14" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"></path>
                                    </svg>
                                    <span
                                        class="ltr:pl-3 rtl:pr-3 text-black dark:text-[#506690] dark:group-hover:text-white-dark">Building</span>
                                </div>
                                <div class="rtl:rotate-180" :class="{ '!rotate-90': activeDropdown === 'building' }">

                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path d="M9 5L15 12L9 19" stroke="currentColor" stroke-width="1.5"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                </div>
                            </button>
                            <ul x-cloak x-show="activeDropdown === 'building'" x-collapse
                                class="sub-menu text-gray-500">
                                <li>
                                    <a href="/super-admin/building-index">List</a>
                                </li>
                                <li>
                                    <a href="/super-admin/building-create">Add</a>
                                </li>
                            </ul>
                        </li>
                        <li class="menu nav-item">
                            <button type="button" class="nav-link group"
                                :class="{ 'active': activeDropdown === 'school' }"
                                @click="activeDropdown === 'school' ? activeDropdown = null : activeDropdown = 'school'">
                                <div class="flex items-center">

                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M22 22L2 22" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"></path>
                                        <path d="M2 11L10.1259 4.49931C11.2216 3.62279 12.7784 3.62279 13.8741 4.49931L22 11" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"></path>
                                        <path opacity="0.5" d="M15.5 5.5V3.5C15.5 3.22386 15.7239 3 16 3H18.5C18.7761 3 19 3.22386 19 3.5V8.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"></path>
                                        <path d="M4 22V9.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"></path>
                                        <path d="M20 22V9.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"></path>
                                        <path opacity="0.5" d="M15 22V17C15 15.5858 15 14.8787 14.5607 14.4393C14.1213 14 13.4142 14 12 14C10.5858 14 9.87868 14 9.43934 14.4393C9 14.8787 9 15.5858 9 17V22" stroke="currentColor" stroke-width="1.5"></path>
                                        <path opacity="0.5" d="M14 9.5C14 10.6046 13.1046 11.5 12 11.5C10.8954 11.5 10 10.6046 10 9.5C10 8.39543 10.8954 7.5 12 7.5C13.1046 7.5 14 8.39543 14 9.5Z" stroke="currentColor" stroke-width="1.5"></path>
                                    </svg>
                                    <span
                                        class="ltr:pl-3 rtl:pr-3 text-black dark:text-[#506690] dark:group-hover:text-white-dark">School</span>
                                </div>
                                <div class="rtl:rotate-180" :class="{ '!rotate-90': activeDropdown === 'school' }">

                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path d="M9 5L15 12L9 19" stroke="currentColor" stroke-width="1.5"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                </div>
                            </button>
                            <ul x-cloak x-show="activeDropdown === 'school'" x-collapse
                                class="sub-menu text-gray-500">
                                <li>
                                    <a href="/super-admin/school-index">List</a>
                                </li>
                                <li>
                                    <a href="/super-admin/school-create">Add</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </li>

                <h2
                    class="py-3 px-7 flex items-center uppercase font-extrabold bg-white-light/30 dark:bg-dark dark:bg-opacity-[0.08] -mx-4 mb-1">

                    <svg class="w-4 h-5 flex-none hidden" viewBox="0 0 24 24" stroke="currentColor"
                        stroke-width="1.5" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="5" y1="12" x2="19" y2="12"></line>
                    </svg>
                    <span>Ticket</span>
                </h2>

                <li class="menu nav-item">
                    <a href="/super-admin/ticket-dashboard" class="nav-link group">
                        <div class="flex items-center">
                            <svg class="group-hover:!text-primary shrink-0" width="20" height="20" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path opacity="0.5"
                                    d="M2 12.2039C2 9.91549 2 8.77128 2.5192 7.82274C3.0384 6.87421 3.98695 6.28551 5.88403 5.10813L7.88403 3.86687C9.88939 2.62229 10.8921 2 12 2C13.1079 2 14.1106 2.62229 16.116 3.86687L18.116 5.10812C20.0131 6.28551 20.9616 6.87421 21.4808 7.82274C22 8.77128 22 9.91549 22 12.2039V13.725C22 17.6258 22 19.5763 20.8284 20.7881C19.6569 22 17.7712 22 14 22H10C6.22876 22 4.34315 22 3.17157 20.7881C2 19.5763 2 17.6258 2 13.725V12.2039Z"
                                    fill="currentColor" />
                                <path
                                    d="M9 17.25C8.58579 17.25 8.25 17.5858 8.25 18C8.25 18.4142 8.58579 18.75 9 18.75H15C15.4142 18.75 15.75 18.4142 15.75 18C15.75 17.5858 15.4142 17.25 15 17.25H9Z"
                                    fill="currentColor" />
                            </svg>

                            <span
                                class="ltr:pl-3 rtl:pr-3 text-black dark:text-[#506690] dark:group-hover:text-white-dark">Dashboard</span>
                        </div>
                    </a>
                </li>
                <li class="menu nav-item">
                    <button type="button" class="nav-link group"
                        :class="{ 'active': activeDropdown === 'tickets' }"
                        @click="activeDropdown === 'tickets' ? activeDropdown = null : activeDropdown = 'tickets'">
                        <div class="flex items-center">

                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path opacity="0.5"
                                    d="M3.77772 18.3259C4.78661 19 6.19108 19 9 19L15 19C17.8089 19 19.2134 19 20.2223 18.3259C20.659 18.034 21.034 17.659 21.3259 17.2223C22 16.2134 22 14.8089 22 12C22 9.19107 22 7.78661 21.3259 6.77772C21.034 6.34096 20.659 5.96595 20.2223 5.67412C19.2134 5 17.8089 5 15 5H9C6.19108 5 4.78661 5 3.77772 5.67412C3.34096 5.96596 2.96596 6.34096 2.67412 6.77772C2 7.78661 2 9.19108 2 12C2 14.8089 2 16.2134 2.67412 17.2223C2.96596 17.659 3.34096 18.034 3.77772 18.3259Z"
                                    fill="currentColor"></path>
                                <path
                                    d="M5.5 15.75C5.08579 15.75 4.75 15.4142 4.75 15L4.75 9C4.75 8.58579 5.08579 8.25 5.5 8.25C5.91421 8.25 6.25 8.58579 6.25 9L6.25 15C6.25 15.4142 5.91421 15.75 5.5 15.75Z"
                                    fill="currentColor"></path>
                                <path
                                    d="M17.75 15C17.75 15.4142 18.0858 15.75 18.5 15.75C18.9142 15.75 19.25 15.4142 19.25 15V9C19.25 8.58579 18.9142 8.25 18.5 8.25C18.0858 8.25 17.75 8.58579 17.75 9V15Z"
                                    fill="currentColor"></path>
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M8.25 12C8.25 14.0711 9.92893 15.75 12 15.75C14.0711 15.75 15.75 14.0711 15.75 12C15.75 9.92893 14.0711 8.25 12 8.25C9.92893 8.25 8.25 9.92893 8.25 12ZM9.75 12C9.75 13.2426 10.7574 14.25 12 14.25C13.2426 14.25 14.25 13.2426 14.25 12C14.25 10.7574 13.2426 9.75 12 9.75C10.7574 9.75 9.75 10.7574 9.75 12Z"
                                    fill="currentColor"></path>
                            </svg>

                            <span
                                class="ltr:pl-3 rtl:pr-3 text-black dark:text-[#506690] dark:group-hover:text-white-dark">My
                                Ticket</span>
                        </div>
                        <div class="rtl:rotate-180" :class="{ '!rotate-90': activeDropdown === 'tickets' }">

                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path d="M9 5L15 12L9 19" stroke="currentColor" stroke-width="1.5"
                                    stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </div>
                    </button>
                    <ul x-cloak x-show="activeDropdown === 'tickets'" x-collapse class="sub-menu text-gray-500">
                        <li>
                            <a href="/super-admin/myTicket-index">List</a>
                        </li>
                        <li>
                            <a href="/super-admin/myTicket-create">Add</a>
                        </li>
                    </ul>
                </li>
                <li class="menu nav-item">
                    <a href="/super-admin/new-ticket" class="nav-link group">
                        <div class="flex items-center">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path opacity="0.5" d="M3.77772 18.3259C4.78661 19 6.19108 19 9 19L15 19C17.8089 19 19.2134 19 20.2223 18.3259C20.659 18.034 21.034 17.659 21.3259 17.2223C22 16.2134 22 14.8089 22 12C22 9.19107 22 7.78661 21.3259 6.77772C21.034 6.34096 20.659 5.96595 20.2223 5.67412C19.2134 5 17.8089 5 15 5H9C6.19108 5 4.78661 5 3.77772 5.67412C3.34096 5.96596 2.96596 6.34096 2.67412 6.77772C2 7.78661 2 9.19108 2 12C2 14.8089 2 16.2134 2.67412 17.2223C2.96596 17.659 3.34096 18.034 3.77772 18.3259Z" fill="currentColor"></path>
                                <path d="M5.5 15.75C5.08579 15.75 4.75 15.4142 4.75 15L4.75 9C4.75 8.58579 5.08579 8.25 5.5 8.25C5.91421 8.25 6.25 8.58579 6.25 9L6.25 15C6.25 15.4142 5.91421 15.75 5.5 15.75Z" fill="currentColor"></path>
                                <path d="M17.75 15C17.75 15.4142 18.0858 15.75 18.5 15.75C18.9142 15.75 19.25 15.4142 19.25 15V9C19.25 8.58579 18.9142 8.25 18.5 8.25C18.0858 8.25 17.75 8.58579 17.75 9V15Z" fill="currentColor"></path>
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M8.25 12C8.25 14.0711 9.92893 15.75 12 15.75C14.0711 15.75 15.75 14.0711 15.75 12C15.75 9.92893 14.0711 8.25 12 8.25C9.92893 8.25 8.25 9.92893 8.25 12ZM9.75 12C9.75 13.2426 10.7574 14.25 12 14.25C13.2426 14.25 14.25 13.2426 14.25 12C14.25 10.7574 13.2426 9.75 12 9.75C10.7574 9.75 9.75 10.7574 9.75 12Z" fill="currentColor"></path>
                            </svg>

                            <span
                                class="ltr:pl-3 rtl:pr-3 text-black dark:text-[#506690] dark:group-hover:text-white-dark">New Ticket</span>
                        </div>
                    </a>
                </li>
                <li class="menu nav-item">
                    <a href="/super-admin/open-ticket" class="nav-link group">
                        <div class="flex items-center">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path opacity="0.5" d="M3.77772 18.3259C4.78661 19 6.19108 19 9 19L15 19C17.8089 19 19.2134 19 20.2223 18.3259C20.659 18.034 21.034 17.659 21.3259 17.2223C22 16.2134 22 14.8089 22 12C22 9.19107 22 7.78661 21.3259 6.77772C21.034 6.34096 20.659 5.96595 20.2223 5.67412C19.2134 5 17.8089 5 15 5H9C6.19108 5 4.78661 5 3.77772 5.67412C3.34096 5.96596 2.96596 6.34096 2.67412 6.77772C2 7.78661 2 9.19108 2 12C2 14.8089 2 16.2134 2.67412 17.2223C2.96596 17.659 3.34096 18.034 3.77772 18.3259Z" fill="currentColor"></path>
                                <path d="M5.5 15.75C5.08579 15.75 4.75 15.4142 4.75 15L4.75 9C4.75 8.58579 5.08579 8.25 5.5 8.25C5.91421 8.25 6.25 8.58579 6.25 9L6.25 15C6.25 15.4142 5.91421 15.75 5.5 15.75Z" fill="currentColor"></path>
                                <path d="M17.75 15C17.75 15.4142 18.0858 15.75 18.5 15.75C18.9142 15.75 19.25 15.4142 19.25 15V9C19.25 8.58579 18.9142 8.25 18.5 8.25C18.0858 8.25 17.75 8.58579 17.75 9V15Z" fill="currentColor"></path>
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M8.25 12C8.25 14.0711 9.92893 15.75 12 15.75C14.0711 15.75 15.75 14.0711 15.75 12C15.75 9.92893 14.0711 8.25 12 8.25C9.92893 8.25 8.25 9.92893 8.25 12ZM9.75 12C9.75 13.2426 10.7574 14.25 12 14.25C13.2426 14.25 14.25 13.2426 14.25 12C14.25 10.7574 13.2426 9.75 12 9.75C10.7574 9.75 9.75 10.7574 9.75 12Z" fill="currentColor"></path>
                            </svg>

                            <span
                                class="ltr:pl-3 rtl:pr-3 text-black dark:text-[#506690] dark:group-hover:text-white-dark">Open Ticket</span>
                        </div>
                    </a>
                </li>
                <li class="menu nav-item">
                    <a href="/super-admin/hold-ticket" class="nav-link group">
                        <div class="flex items-center">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path opacity="0.5" d="M3.77772 18.3259C4.78661 19 6.19108 19 9 19L15 19C17.8089 19 19.2134 19 20.2223 18.3259C20.659 18.034 21.034 17.659 21.3259 17.2223C22 16.2134 22 14.8089 22 12C22 9.19107 22 7.78661 21.3259 6.77772C21.034 6.34096 20.659 5.96595 20.2223 5.67412C19.2134 5 17.8089 5 15 5H9C6.19108 5 4.78661 5 3.77772 5.67412C3.34096 5.96596 2.96596 6.34096 2.67412 6.77772C2 7.78661 2 9.19108 2 12C2 14.8089 2 16.2134 2.67412 17.2223C2.96596 17.659 3.34096 18.034 3.77772 18.3259Z" fill="currentColor"></path>
                                <path d="M5.5 15.75C5.08579 15.75 4.75 15.4142 4.75 15L4.75 9C4.75 8.58579 5.08579 8.25 5.5 8.25C5.91421 8.25 6.25 8.58579 6.25 9L6.25 15C6.25 15.4142 5.91421 15.75 5.5 15.75Z" fill="currentColor"></path>
                                <path d="M17.75 15C17.75 15.4142 18.0858 15.75 18.5 15.75C18.9142 15.75 19.25 15.4142 19.25 15V9C19.25 8.58579 18.9142 8.25 18.5 8.25C18.0858 8.25 17.75 8.58579 17.75 9V15Z" fill="currentColor"></path>
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M8.25 12C8.25 14.0711 9.92893 15.75 12 15.75C14.0711 15.75 15.75 14.0711 15.75 12C15.75 9.92893 14.0711 8.25 12 8.25C9.92893 8.25 8.25 9.92893 8.25 12ZM9.75 12C9.75 13.2426 10.7574 14.25 12 14.25C13.2426 14.25 14.25 13.2426 14.25 12C14.25 10.7574 13.2426 9.75 12 9.75C10.7574 9.75 9.75 10.7574 9.75 12Z" fill="currentColor"></path>
                            </svg>

                            <span
                                class="ltr:pl-3 rtl:pr-3 text-black dark:text-[#506690] dark:group-hover:text-white-dark">Hold Ticket</span>
                        </div>
                    </a>
                </li>
                <li class="menu nav-item">
                    <a href="/super-admin/close-ticket" class="nav-link group">
                        <div class="flex items-center">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path opacity="0.5" d="M3.77772 18.3259C4.78661 19 6.19108 19 9 19L15 19C17.8089 19 19.2134 19 20.2223 18.3259C20.659 18.034 21.034 17.659 21.3259 17.2223C22 16.2134 22 14.8089 22 12C22 9.19107 22 7.78661 21.3259 6.77772C21.034 6.34096 20.659 5.96595 20.2223 5.67412C19.2134 5 17.8089 5 15 5H9C6.19108 5 4.78661 5 3.77772 5.67412C3.34096 5.96596 2.96596 6.34096 2.67412 6.77772C2 7.78661 2 9.19108 2 12C2 14.8089 2 16.2134 2.67412 17.2223C2.96596 17.659 3.34096 18.034 3.77772 18.3259Z" fill="currentColor"></path>
                                <path d="M5.5 15.75C5.08579 15.75 4.75 15.4142 4.75 15L4.75 9C4.75 8.58579 5.08579 8.25 5.5 8.25C5.91421 8.25 6.25 8.58579 6.25 9L6.25 15C6.25 15.4142 5.91421 15.75 5.5 15.75Z" fill="currentColor"></path>
                                <path d="M17.75 15C17.75 15.4142 18.0858 15.75 18.5 15.75C18.9142 15.75 19.25 15.4142 19.25 15V9C19.25 8.58579 18.9142 8.25 18.5 8.25C18.0858 8.25 17.75 8.58579 17.75 9V15Z" fill="currentColor"></path>
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M8.25 12C8.25 14.0711 9.92893 15.75 12 15.75C14.0711 15.75 15.75 14.0711 15.75 12C15.75 9.92893 14.0711 8.25 12 8.25C9.92893 8.25 8.25 9.92893 8.25 12ZM9.75 12C9.75 13.2426 10.7574 14.25 12 14.25C13.2426 14.25 14.25 13.2426 14.25 12C14.25 10.7574 13.2426 9.75 12 9.75C10.7574 9.75 9.75 10.7574 9.75 12Z" fill="currentColor"></path>
                            </svg>

                            <span
                                class="ltr:pl-3 rtl:pr-3 text-black dark:text-[#506690] dark:group-hover:text-white-dark">Close Ticket</span>
                        </div>
                    </a>
                </li>



                <h2
                    class="py-3 px-7 flex items-center uppercase font-extrabold bg-white-light/30 dark:bg-dark dark:bg-opacity-[0.08] -mx-4 mb-1">

                    <svg class="w-4 h-5 flex-none hidden" viewBox="0 0 24 24" stroke="currentColor"
                        stroke-width="1.5" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="5" y1="12" x2="19" y2="12"></line>
                    </svg>
                    <span>Setting</span>
                </h2>

                <li class="menu nav-item">
                    <a href="/super-admin/setting/email" class="nav-link group">
                        <div class="flex items-center">

                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M10.5487 21.5277L10.7988 21.1053C11.1996 20.4282 11.3999 20.0897 11.7191 19.9009C12.0383 19.712 12.4547 19.6987 13.2874 19.6721C14.0682 19.6471 14.593 19.579 15.0417 19.3931C15.9864 19.0018 16.7369 18.2513 17.1282 17.3066C17.4217 16.5981 17.4217 15.6999 17.4217 13.9035V13.1324C17.4217 10.6083 17.4217 9.34622 16.8536 8.4191C16.5357 7.90033 16.0995 7.46416 15.5807 7.14626C14.6536 6.57813 13.3916 6.57812 10.8675 6.57812H8.55422C6.03013 6.57812 4.76808 6.57813 3.84097 7.14626C3.3222 7.46416 2.88604 7.90033 2.56813 8.4191C2 9.34622 2 10.6083 2 13.1324V13.9035C2 15.6999 2 16.5981 2.29348 17.3066C2.68478 18.2513 3.43533 19.0018 4.38002 19.3931C4.82871 19.579 5.35348 19.6471 6.13427 19.6721C6.96698 19.6987 7.38334 19.712 7.70253 19.9009C8.02172 20.0897 8.2221 20.4282 8.62285 21.1053L8.87291 21.5277C9.24547 22.1572 10.1762 22.1572 10.5487 21.5277ZM13.0843 14.289C13.6167 14.289 14.0482 13.8574 14.0482 13.3251C14.0482 12.7928 13.6167 12.3613 13.0843 12.3613C12.552 12.3613 12.1205 12.7928 12.1205 13.3251C12.1205 13.8574 12.552 14.289 13.0843 14.289ZM10.6747 13.3251C10.6747 13.8574 10.2432 14.289 9.71084 14.289C9.17852 14.289 8.74699 13.8574 8.74699 13.3251C8.74699 12.7928 9.17852 12.3613 9.71084 12.3613C10.2432 12.3613 10.6747 12.7928 10.6747 13.3251ZM6.33735 14.289C6.86967 14.289 7.30121 13.8574 7.30121 13.3251C7.30121 12.7928 6.86967 12.3613 6.33735 12.3613C5.80503 12.3613 5.37349 12.7928 5.37349 13.3251C5.37349 13.8574 5.80503 14.289 6.33735 14.289Z" fill="currentColor"></path>
                                <path d="M15.1696 2C16.3214 1.99999 17.2372 1.99999 17.9717 2.06982C18.7249 2.14143 19.3617 2.29154 19.9289 2.63915C20.5125 2.9968 21.0032 3.48748 21.3608 4.0711C21.7085 4.63836 21.8586 5.27514 21.9302 6.02829C22 6.76279 22 7.67871 22 8.83039V9.61699C22 10.4367 22 11.0886 21.9639 11.6173C21.927 12.1581 21.85 12.6226 21.6698 13.0575C21.2296 14.1202 20.3853 14.9646 19.3225 15.4048C19.2959 15.4158 19.2692 15.4265 19.2423 15.4367C19.114 15.4858 19.0042 15.5278 18.9077 15.5591C18.9217 15.0903 18.9217 14.5563 18.9217 13.9537V13.0614C18.9217 11.8598 18.9217 10.8532 18.8439 10.0349C18.7625 9.17817 18.5853 8.37421 18.1325 7.63536C17.6909 6.91475 17.0851 6.30889 16.3645 5.8673C15.6256 5.41453 14.8217 5.23733 13.9649 5.15588C13.1466 5.07807 12.14 5.07809 10.9384 5.07812H8.48326C7.66717 5.0781 6.94105 5.07809 6.30276 5.10245C6.3325 4.9994 6.37324 4.88128 6.42106 4.74264C6.5024 4.50682 6.60519 4.28381 6.73554 4.0711C7.09318 3.48748 7.58386 2.9968 8.16748 2.63915C8.73473 2.29154 9.37152 2.14143 10.1247 2.06982C10.8592 1.99999 11.775 1.99999 12.9268 2H15.1696Z" fill="currentColor"></path>
                            </svg>
                            <span
                                class="ltr:pl-3 rtl:pr-3 text-black dark:text-[#506690] dark:group-hover:text-white-dark">Email</span>
                        </div>
                    </a>
                </li>
                <li class="menu nav-item">
                    <a href="/super-admin/setting/profile" class="nav-link group">
                        <div class="flex items-center">

                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <circle cx="12" cy="6" r="4" stroke="currentColor" stroke-width="1.5"></circle>
                                <path opacity="0.5" d="M18 9C19.6569 9 21 7.88071 21 6.5C21 5.11929 19.6569 4 18 4" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"></path>
                                <path opacity="0.5" d="M6 9C4.34315 9 3 7.88071 3 6.5C3 5.11929 4.34315 4 6 4" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"></path>
                                <ellipse cx="12" cy="17" rx="6" ry="4" stroke="currentColor" stroke-width="1.5"></ellipse>
                                <path opacity="0.5" d="M20 19C21.7542 18.6153 23 17.6411 23 16.5C23 15.3589 21.7542 14.3847 20 14" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"></path>
                                <path opacity="0.5" d="M4 19C2.24575 18.6153 1 17.6411 1 16.5C1 15.3589 2.24575 14.3847 4 14" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"></path>
                            </svg>
                            <span
                                class="ltr:pl-3 rtl:pr-3 text-black dark:text-[#506690] dark:group-hover:text-white-dark">Profile</span>
                        </div>
                    </a>
                </li>
                <li class="menu nav-item">
                    <a href="/super-admin/setting/reset-password" class="nav-link group">
                        <div class="flex items-center">

                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <circle cx="12" cy="12" r="3" stroke="currentColor" stroke-width="1.5"></circle>
                                <path d="M3.66122 10.6392C4.13377 10.9361 4.43782 11.4419 4.43782 11.9999C4.43781 12.558 4.13376 13.0638 3.66122 13.3607C3.33966 13.5627 3.13248 13.7242 2.98508 13.9163C2.66217 14.3372 2.51966 14.869 2.5889 15.3949C2.64082 15.7893 2.87379 16.1928 3.33973 16.9999C3.80568 17.8069 4.03865 18.2104 4.35426 18.4526C4.77508 18.7755 5.30694 18.918 5.83284 18.8488C6.07287 18.8172 6.31628 18.7185 6.65196 18.5411C7.14544 18.2803 7.73558 18.2699 8.21895 18.549C8.70227 18.8281 8.98827 19.3443 9.00912 19.902C9.02332 20.2815 9.05958 20.5417 9.15224 20.7654C9.35523 21.2554 9.74458 21.6448 10.2346 21.8478C10.6022 22 11.0681 22 12 22C12.9319 22 13.3978 22 13.7654 21.8478C14.2554 21.6448 14.6448 21.2554 14.8478 20.7654C14.9404 20.5417 14.9767 20.2815 14.9909 19.9021C15.0117 19.3443 15.2977 18.8281 15.7811 18.549C16.2644 18.27 16.8545 18.2804 17.3479 18.5412C17.6837 18.7186 17.9271 18.8173 18.1671 18.8489C18.693 18.9182 19.2249 18.7756 19.6457 18.4527C19.9613 18.2106 20.1943 17.807 20.6603 17C20.8677 16.6407 21.029 16.3614 21.1486 16.1272M20.3387 13.3608C19.8662 13.0639 19.5622 12.5581 19.5621 12.0001C19.5621 11.442 19.8662 10.9361 20.3387 10.6392C20.6603 10.4372 20.8674 10.2757 21.0148 10.0836C21.3377 9.66278 21.4802 9.13092 21.411 8.60502C21.3591 8.2106 21.1261 7.80708 20.6601 7.00005C20.1942 6.19301 19.9612 5.7895 19.6456 5.54732C19.2248 5.22441 18.6929 5.0819 18.167 5.15113C17.927 5.18274 17.6836 5.2814 17.3479 5.45883C16.8544 5.71964 16.2643 5.73004 15.781 5.45096C15.2977 5.1719 15.0117 4.6557 14.9909 4.09803C14.9767 3.71852 14.9404 3.45835 14.8478 3.23463C14.6448 2.74458 14.2554 2.35523 13.7654 2.15224C13.3978 2 12.9319 2 12 2C11.0681 2 10.6022 2 10.2346 2.15224C9.74458 2.35523 9.35523 2.74458 9.15224 3.23463C9.05958 3.45833 9.02332 3.71848 9.00912 4.09794C8.98826 4.65566 8.70225 5.17191 8.21891 5.45096C7.73557 5.73002 7.14548 5.71959 6.65205 5.4588C6.31633 5.28136 6.0729 5.18269 5.83285 5.15108C5.30695 5.08185 4.77509 5.22436 4.35427 5.54727C4.03866 5.78945 3.80569 6.19297 3.33974 7C3.13231 7.35929 2.97105 7.63859 2.85138 7.87273" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"></path>
                            </svg>
                            <span
                                class="ltr:pl-3 rtl:pr-3 text-black dark:text-[#506690] dark:group-hover:text-white-dark">Reset Password</span>
                        </div>
                    </a>
                </li>
                <li class="menu nav-item">
                    <a href="/super-admin/setting/reset-key" class="nav-link group">
                        <div class="flex items-center">

                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M15.6807 14.5869C19.1708 14.5869 22 11.7692 22 8.29344C22 4.81767 19.1708 2 15.6807 2C12.1907 2 9.3615 4.81767 9.3615 8.29344C9.3615 9.90338 10.0963 11.0743 10.0963 11.0743L2.45441 18.6849C2.1115 19.0264 1.63143 19.9143 2.45441 20.7339L3.33616 21.6121C3.67905 21.9048 4.54119 22.3146 5.2466 21.6121L6.27531 20.5876C7.30403 21.6121 8.4797 21.0267 8.92058 20.4412C9.65538 19.4167 8.77362 18.3922 8.77362 18.3922L9.06754 18.0995C10.4783 19.5045 11.7128 18.6849 12.1537 18.0995C12.8885 17.075 12.1537 16.0505 12.1537 16.0505C11.8598 15.465 11.272 15.465 12.0067 14.7333L12.8885 13.8551C13.5939 14.4405 15.0439 14.5869 15.6807 14.5869Z" stroke="currentColor" stroke-width="1.5" stroke-linejoin="round"></path>
                                <path d="M17.8853 8.29353C17.8853 9.50601 16.8984 10.4889 15.681 10.4889C14.4635 10.4889 13.4766 9.50601 13.4766 8.29353C13.4766 7.08105 14.4635 6.09814 15.681 6.09814C16.8984 6.09814 17.8853 7.08105 17.8853 8.29353Z" stroke="currentColor" stroke-width="1.5"></path>
                            </svg>
                            <span
                                class="ltr:pl-3 rtl:pr-3 text-black dark:text-[#506690] dark:group-hover:text-white-dark">Reset Key</span>
                        </div>
                    </a>
                </li>





            </ul>
        </div>
    </nav>
</div>
<script>
    document.addEventListener("alpine:init", () => {
        Alpine.data("sidebar", () => ({
            init() {
                const selector = document.querySelector('.sidebar ul a[href="' + window.location
                    .pathname + '"]');
                if (selector) {
                    selector.classList.add('active');
                    const ul = selector.closest('ul.sub-menu');
                    if (ul) {
                        let ele = ul.closest('li.menu').querySelectorAll('.nav-link');
                        if (ele) {
                            ele = ele[0];
                            setTimeout(() => {
                                ele.click();
                            });
                        }
                    }
                }
            },
        }));
    });
</script>
