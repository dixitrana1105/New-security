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
                    <a href="/school/security/dashboard" class="nav-link group">
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
                    <span>Visitor</span>
                </h2>

                <li class="nav-item">
                    <ul>
                        <li class="menu nav-item">
                            <button type="button" class="nav-link group"
                                :class="{ 'active': activeDropdown === 'visitor' }"
                                @click="activeDropdown === 'visitor' ? activeDropdown = null : activeDropdown = 'visitor'">
                                <div class="flex items-center">

                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <circle cx="12" cy="6" r="4" stroke="currentColor" stroke-width="1.5"></circle>
                                        <path d="M15 20.6151C14.0907 20.8619 13.0736 21 12 21C8.13401 21 5 19.2091 5 17C5 14.7909 8.13401 13 12 13C15.866 13 19 14.7909 19 17C19 17.3453 18.9234 17.6804 18.7795 18" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"></path>
                                    </svg>
                                    <span
                                        class="ltr:pl-3 rtl:pr-3 text-black dark:text-[#506690] dark:group-hover:text-white-dark">visitor</span>
                                </div>
                                <div class="rtl:rotate-180" :class="{ '!rotate-90': activeDropdown === 'visitor' }">

                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path d="M9 5L15 12L9 19" stroke="currentColor" stroke-width="1.5"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                </div>
                            </button>
                            <ul x-cloak x-show="activeDropdown === 'visitor'" x-collapse
                                class="sub-menu text-gray-500">
                                <li>
                                    <a href="/new-entry">New Entry</a>
                                </li>
                                <li>
                                    <a href="/school/security/visitor/index">List</a>
                                </li>
                                {{-- <li>
                                    <a href="/school/security/visitor/create">Add</a>
                                </li> --}}
                            </ul>
                        </li>                        
                    </ul>
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
                                :class="{ 'active': activeDropdown === 'student' }"
                                @click="activeDropdown === 'student' ? activeDropdown = null : activeDropdown = 'student'">
                                <div class="flex items-center">

                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path opacity="0.5" d="M16 4.00195C18.175 4.01406 19.3529 4.11051 20.1213 4.87889C21 5.75757 21 7.17179 21 10.0002V16.0002C21 18.8286 21 20.2429 20.1213 21.1215C19.2426 22.0002 17.8284 22.0002 15 22.0002H9C6.17157 22.0002 4.75736 22.0002 3.87868 21.1215C3 20.2429 3 18.8286 3 16.0002V10.0002C3 7.17179 3 5.75757 3.87868 4.87889C4.64706 4.11051 5.82497 4.01406 8 4.00195" stroke="currentColor" stroke-width="1.5"></path>
                                        <path d="M8 14H16" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"></path>
                                        <path d="M7 10.5H17" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"></path>
                                        <path d="M9 17.5H15" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"></path>
                                        <path d="M8 3.5C8 2.67157 8.67157 2 9.5 2H14.5C15.3284 2 16 2.67157 16 3.5V4.5C16 5.32843 15.3284 6 14.5 6H9.5C8.67157 6 8 5.32843 8 4.5V3.5Z" stroke="currentColor" stroke-width="1.5"></path>
                                    </svg>
                                    <span
                                        class="ltr:pl-3 rtl:pr-3 text-black dark:text-[#506690] dark:group-hover:text-white-dark">Student</span>
                                </div>
                                <div class="rtl:rotate-180" :class="{ '!rotate-90': activeDropdown === 'student' }">

                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path d="M9 5L15 12L9 19" stroke="currentColor" stroke-width="1.5"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                </div>
                            </button>
                            <ul x-cloak x-show="activeDropdown === 'student'" x-collapse
                                class="sub-menu text-gray-500">
                                <li>
                                    <a href="/school/security/master/student-index">List</a>
                                </li>                                
                            </ul>
                        </li>
                        <li class="menu nav-item">
                            <button type="button" class="nav-link group"
                                :class="{ 'active': activeDropdown === 'security' }"
                                @click="activeDropdown === 'security' ? activeDropdown = null : activeDropdown = 'security'">
                                <div class="flex items-center">

                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M12 2L3 6V11C3 16 7 20.5 12 22C17 20.5 21 16 21 11V6L12 2Z" stroke="currentColor" stroke-width="1.5" stroke-linejoin="round"></path>
                                        <path d="M12 2L3 6V11C3 16 7 20.5 12 22C17 20.5 21 16 21 11V6L12 2Z" fill="currentColor" fill-opacity="0.2"></path>
                                        <path d="M9 11L11 13L15 9" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                      </svg>
                                    <span
                                        class="ltr:pl-3 rtl:pr-3 text-black dark:text-[#506690] dark:group-hover:text-white-dark">Security</span>
                                </div>
                                <div class="rtl:rotate-180" :class="{ '!rotate-90': activeDropdown === 'security' }">

                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path d="M9 5L15 12L9 19" stroke="currentColor" stroke-width="1.5"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                </div>
                            </button>
                            <ul x-cloak x-show="activeDropdown === 'security'" x-collapse
                                class="sub-menu text-gray-500">
                                <li>
                                    <a href="/school/security/master/security-index">List</a>
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
                <span>REPORT</span>
            </h2>

            {{-- <li class="menu nav-item">
                <button type="button" class="nav-link group"
                    :class="{ 'active': activeDropdown === 'securitysubtenant' }"
                    @click="activeDropdown === 'securitysubtenant' ? activeDropdown = null : activeDropdown = 'securitysubtenant'">
                    <div class="flex items-center">

                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 64" width="64" height="64">
                            <!-- Main tenant icon (black) -->
                            <circle cx="32" cy="16" r="8" stroke="black" stroke-width="2" fill="white" />
                            <rect x="16" y="32" width="32" height="16" stroke="black" stroke-width="2" fill="white" />

                            <!-- Sub-tenant (linked to the main tenant) -->
                            <circle cx="48" cy="48" r="6" stroke="black" stroke-width="2" fill="white" />
                            <line x1="38" y1="38" x2="48" y2="48" stroke="black" stroke-width="2" />

                            <!-- Small tenant icon -->
                            <circle cx="16" cy="48" r="6" stroke="black" stroke-width="2" fill="white" />
                            <line x1="26" y1="38" x2="16" y2="48" stroke="black" stroke-width="2" />
                          </svg>

                        <span
                            class="ltr:pl-3 rtl:pr-3 text-black dark:text-[#506690] dark:group-hover:text-white-dark">Sub Tenant</span>
                    </div>
                    <div class="rtl:rotate-180" :class="{ '!rotate-90': activeDropdown === 'securitysubtenant' }">

                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path d="M9 5L15 12L9 19" stroke="currentColor" stroke-width="1.5"
                                stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </div>
                </button>
                <ul x-cloak x-show="activeDropdown === 'securitysubtenant'" x-collapse class="sub-menu text-gray-500">
                    <li>
                        <a href="/school/security/report/sub-tenant">List</a>
                    </li>
                </ul>
            </li> --}}

            <li class="menu nav-item">
                <button type="button" class="nav-link group" :class="{ 'active': activeDropdown === 'elements' }"
                    @click="activeDropdown === 'elements' ? activeDropdown = null : activeDropdown = 'elements'">
                    <div class="flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 64" width="64" height="64">
                            <!-- Main tenant icon (black) -->
                            <circle cx="32" cy="16" r="8" stroke="black" stroke-width="2" fill="white" />
                            <rect x="16" y="32" width="32" height="16" stroke="black" stroke-width="2" fill="white" />

                            <!-- Sub-tenant (linked to the main tenant) -->
                            <circle cx="48" cy="48" r="6" stroke="black" stroke-width="2" fill="white" />
                            <line x1="38" y1="38" x2="48" y2="48" stroke="black" stroke-width="2" />

                            <!-- Small tenant icon -->
                            <circle cx="16" cy="48" r="6" stroke="black" stroke-width="2" fill="white" />
                            <line x1="26" y1="38" x2="16" y2="48" stroke="black" stroke-width="2" />
                          </svg>

                        <span
                            class="ltr:pl-3 rtl:pr-3 text-black dark:text-[#506690] dark:group-hover:text-white-dark">Visitor Log</span>
                    </div>
                    <div class="rtl:rotate-180" :class="{ '!rotate-90': activeDropdown === 'elements' }">

                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path d="M9 5L15 12L9 19" stroke="currentColor" stroke-width="1.5"
                                stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </div>
                </button>
                <ul x-cloak x-show="activeDropdown === 'elements'" x-collapse class="sub-menu text-gray-500">
                    <li>
                        <a href="/school/security/report/visitor-log">List</a>
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
                    <a href="/school/security/dashboard-ticket" class="nav-link group">
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
                        :class="{ 'active': activeDropdown === 'myticketsecurity' }"
                        @click="activeDropdown === 'myticketsecurity' ? activeDropdown = null : activeDropdown = 'myticketsecurity'">
                        <div class="flex items-center">

                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path opacity="0.5" d="M3.77772 18.3259C4.78661 19 6.19108 19 9 19L15 19C17.8089 19 19.2134 19 20.2223 18.3259C20.659 18.034 21.034 17.659 21.3259 17.2223C22 16.2134 22 14.8089 22 12C22 9.19107 22 7.78661 21.3259 6.77772C21.034 6.34096 20.659 5.96595 20.2223 5.67412C19.2134 5 17.8089 5 15 5H9C6.19108 5 4.78661 5 3.77772 5.67412C3.34096 5.96596 2.96596 6.34096 2.67412 6.77772C2 7.78661 2 9.19108 2 12C2 14.8089 2 16.2134 2.67412 17.2223C2.96596 17.659 3.34096 18.034 3.77772 18.3259Z" fill="currentColor"></path>
                                <path d="M5.5 15.75C5.08579 15.75 4.75 15.4142 4.75 15L4.75 9C4.75 8.58579 5.08579 8.25 5.5 8.25C5.91421 8.25 6.25 8.58579 6.25 9L6.25 15C6.25 15.4142 5.91421 15.75 5.5 15.75Z" fill="currentColor"></path>
                                <path d="M17.75 15C17.75 15.4142 18.0858 15.75 18.5 15.75C18.9142 15.75 19.25 15.4142 19.25 15V9C19.25 8.58579 18.9142 8.25 18.5 8.25C18.0858 8.25 17.75 8.58579 17.75 9V15Z" fill="currentColor"></path>
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M8.25 12C8.25 14.0711 9.92893 15.75 12 15.75C14.0711 15.75 15.75 14.0711 15.75 12C15.75 9.92893 14.0711 8.25 12 8.25C9.92893 8.25 8.25 9.92893 8.25 12ZM9.75 12C9.75 13.2426 10.7574 14.25 12 14.25C13.2426 14.25 14.25 13.2426 14.25 12C14.25 10.7574 13.2426 9.75 12 9.75C10.7574 9.75 9.75 10.7574 9.75 12Z" fill="currentColor"></path>
                            </svg>
                            <span
                                class="ltr:pl-3 rtl:pr-3 text-black dark:text-[#506690] dark:group-hover:text-white-dark">myticket</span>
                        </div>
                        <div class="rtl:rotate-180" :class="{ '!rotate-90': activeDropdown === 'myticketsecurity' }">

                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path d="M9 5L15 12L9 19" stroke="currentColor" stroke-width="1.5"
                                    stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </div>
                    </button>
                    <ul x-cloak x-show="activeDropdown === 'myticketsecurity'" x-collapse
                        class="sub-menu text-gray-500">
                        <li>
                            <a href="/school/security/my-ticket-index">List</a>
                        </li>
                        <li>
                            <a href="/school/security/my-ticket-create">Add</a>
                        </li>
                    </ul>
                </li>
                <li class="menu nav-item">
                    <a href="/school/security/new-ticket" class="nav-link group">
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
                    <a href="/school/security/open-ticket" class="nav-link group">
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
                    <a href="/school/security/hold-ticket" class="nav-link group">
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
                    <a href="/school/security/close-ticket" class="nav-link group">
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
                    <a href="/school/security/setting/profile" class="nav-link group">
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
                    <a href="/school/security/setting/reset-password" class="nav-link group">
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
                {{-- <li class="menu nav-item">
                    <a href="/school-admin/setting/reset-key" class="nav-link group">
                        <div class="flex items-center">

                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M15.6807 14.5869C19.1708 14.5869 22 11.7692 22 8.29344C22 4.81767 19.1708 2 15.6807 2C12.1907 2 9.3615 4.81767 9.3615 8.29344C9.3615 9.90338 10.0963 11.0743 10.0963 11.0743L2.45441 18.6849C2.1115 19.0264 1.63143 19.9143 2.45441 20.7339L3.33616 21.6121C3.67905 21.9048 4.54119 22.3146 5.2466 21.6121L6.27531 20.5876C7.30403 21.6121 8.4797 21.0267 8.92058 20.4412C9.65538 19.4167 8.77362 18.3922 8.77362 18.3922L9.06754 18.0995C10.4783 19.5045 11.7128 18.6849 12.1537 18.0995C12.8885 17.075 12.1537 16.0505 12.1537 16.0505C11.8598 15.465 11.272 15.465 12.0067 14.7333L12.8885 13.8551C13.5939 14.4405 15.0439 14.5869 15.6807 14.5869Z" stroke="currentColor" stroke-width="1.5" stroke-linejoin="round"></path>
                                <path d="M17.8853 8.29353C17.8853 9.50601 16.8984 10.4889 15.681 10.4889C14.4635 10.4889 13.4766 9.50601 13.4766 8.29353C13.4766 7.08105 14.4635 6.09814 15.681 6.09814C16.8984 6.09814 17.8853 7.08105 17.8853 8.29353Z" stroke="currentColor" stroke-width="1.5"></path>
                            </svg>
                            <span
                                class="ltr:pl-3 rtl:pr-3 text-black dark:text-[#506690] dark:group-hover:text-white-dark">Reset Key</span>
                        </div>
                    </a>
                </li> --}}
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
