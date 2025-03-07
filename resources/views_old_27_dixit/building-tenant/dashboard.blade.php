<x-layout.default>

    <div
        class="relative rounded-t-md bg-primary-light bg-[url('/assets/images/knowledge/pattern.png')] bg-contain bg-left-top bg-no-repeat px-5 py-10 dark:bg-black md:px-10">
        <script defer src="/assets/js/apexcharts.js"></script>
        <div x-data="finance">
            <ul class="flex space-x-2 rtl:space-x-reverse">
                <li>
                    <a href="javascript:;" class="text-primary hover:underline">Dashboard</a>
                </li>
                <li class="before:content-['/'] ltr:before:mr-1 rtl:before:ml-1">
                    <span>Building User</span>
                </li>
            </ul>

            <div class="pt-5">
                <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-5 gap-6 mb-6 text-white">
                    <!-- Users Visit -->
                    <div class="panel bg-gradient-to-r from-cyan-500 to-cyan-400">
                        <div class="flex justify-between">
                            <div class="ltr:mr-1 rtl:ml-1 text-md font-semibold">Total Visitor Currently</div>
                            <div x-data="dropdown" @click.outside="open = false" class="dropdown">
                                <a href="javascript:;" @click="toggle">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 hover:opacity-80 opacity-70">
                                        <circle cx="5" cy="12" r="2" stroke="currentColor"
                                            stroke-width="1.5" />
                                        <circle opacity="0.5" cx="12" cy="12" r="2" stroke="currentColor"
                                            stroke-width="1.5" />
                                        <circle cx="19" cy="12" r="2" stroke="currentColor"
                                            stroke-width="1.5" />
                                    </svg>
                                </a>
                                <ul x-cloak x-show="open" x-transition x-transition.duration.300ms
                                    class="ltr:right-0 rtl:left-0 text-black dark:text-white-dark">
                                    <li><a href="javascript:;" @click="toggle">View Report</a></li>
                                    <li><a href="javascript:;" @click="toggle">Edit Report</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="flex items-center mt-5">
                            <div class="text-3xl font-bold ltr:mr-3 rtl:ml-3">{{$currentvisitorCount}}</div>
                            {{-- <div class="badge bg-white/30">+ 2.35% </div> --}}
                        </div>
                        {{-- <div class="flex items-center font-semibold mt-5">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 ltr:mr-2 rtl:ml-2 shrink-0">
                                <path opacity="0.5"
                                    d="M3.27489 15.2957C2.42496 14.1915 2 13.6394 2 12C2 10.3606 2.42496 9.80853 3.27489 8.70433C4.97196 6.49956 7.81811 4 12 4C16.1819 4 19.028 6.49956 20.7251 8.70433C21.575 9.80853 22 10.3606 22 12C22 13.6394 21.575 14.1915 20.7251 15.2957C19.028 17.5004 16.1819 20 12 20C7.81811 20 4.97196 17.5004 3.27489 15.2957Z"
                                    stroke="currentColor" stroke-width="1.5"></path>
                                <path
                                    d="M15 12C15 13.6569 13.6569 15 12 15C10.3431 15 9 13.6569 9 12C9 10.3431 10.3431 9 12 9C13.6569 9 15 10.3431 15 12Z"
                                    stroke="currentColor" stroke-width="1.5"></path>
                            </svg>
                            Last Week 0
                        </div> --}}
                    </div>

                    <!-- Sessions -->
                    <div class="panel bg-gradient-to-r from-violet-500 to-violet-400">
                        <div class="flex justify-between">
                            <div class="ltr:mr-1 rtl:ml-1 text-md font-semibold">Today’s Visitor </div>
                            <div x-data="dropdown" @click.outside="open = false" class="dropdown">
                                <a href="javascript:;" @click="toggle">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 hover:opacity-80 opacity-70">
                                        <circle cx="5" cy="12" r="2" stroke="currentColor"
                                            stroke-width="1.5" />
                                        <circle opacity="0.5" cx="12" cy="12" r="2" stroke="currentColor"
                                            stroke-width="1.5" />
                                        <circle cx="19" cy="12" r="2" stroke="currentColor"
                                            stroke-width="1.5" />
                                    </svg>
                                </a>
                                <ul x-cloak x-show="open" x-transition x-transition.duration.300ms
                                    class="ltr:right-0 rtl:left-0 text-black dark:text-white-dark">

                                    <li><a href="javascript:;" @click="toggle">View Report</a></li>
                                    <li><a href="javascript:;" @click="toggle">Edit Report</a></li>

                                </ul>
                            </div>
                        </div>
                        <div class="flex items-center mt-5">
                            <div class="text-3xl font-bold ltr:mr-3 rtl:ml-3">{{$todayvisitorCount}}</div>
                            {{-- <div class="badge bg-white/30">- 2.35% </div> --}}
                        </div>
                        <div class="flex items-center font-semibold mt-5">
                            {{-- <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 ltr:mr-2 rtl:ml-2 shrink-0">
                                <path opacity="0.5"
                                    d="M3.27489 15.2957C2.42496 14.1915 2 13.6394 2 12C2 10.3606 2.42496 9.80853 3.27489 8.70433C4.97196 6.49956 7.81811 4 12 4C16.1819 4 19.028 6.49956 20.7251 8.70433C21.575 9.80853 22 10.3606 22 12C22 13.6394 21.575 14.1915 20.7251 15.2957C19.028 17.5004 16.1819 20 12 20C7.81811 20 4.97196 17.5004 3.27489 15.2957Z"
                                    stroke="currentColor" stroke-width="1.5"></path>
                                <path
                                    d="M15 12C15 13.6569 13.6569 15 12 15C10.3431 15 9 13.6569 9 12C9 10.3431 10.3431 9 12 9C13.6569 9 15 10.3431 15 12Z"
                                    stroke="currentColor" stroke-width="1.5"></path>
                            </svg>
                            Last Week 0 --}}
                        </div>
                    </div>

                    <!-- Time On-Site -->
                    <div class="panel bg-gradient-to-r from-blue-500 to-blue-400">
                        <div class="flex justify-between">
                            <div class="ltr:mr-1 rtl:ml-1 text-md font-semibold">Weekly Visitor</div>
                            <div x-data="dropdown" @click.outside="open = false" class="dropdown">
                                <a href="javascript:;" @click="toggle">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 hover:opacity-80 opacity-70">
                                        <circle cx="5" cy="12" r="2" stroke="currentColor"
                                            stroke-width="1.5" />
                                        <circle opacity="0.5" cx="12" cy="12" r="2"
                                            stroke="currentColor" stroke-width="1.5" />
                                        <circle cx="19" cy="12" r="2" stroke="currentColor"
                                            stroke-width="1.5" />
                                    </svg>
                                </a>
                                <ul x-cloak x-show="open" x-transition x-transition.duration.300ms
                                    class="ltr:right-0 rtl:left-0 text-black dark:text-white-dark">
                                    <li><a href="javascript:;" @click="toggle">View Report</a></li>
                                    <li><a href="javascript:;" @click="toggle">Edit Report</a></li>

                                </ul>
                            </div>
                        </div>
                        <div class="flex items-center mt-5">
                            <div class="text-3xl font-bold ltr:mr-3 rtl:ml-3">{{$weeklyvisitor}}</div>
                            {{-- <div class="badge bg-white/30">+ 1.35% </div> --}}
                        </div>
                        <div class="flex items-center font-semibold mt-5">
                            {{-- <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 ltr:mr-2 rtl:ml-2 shrink-0">
                                <path opacity="0.5"
                                    d="M3.27489 15.2957C2.42496 14.1915 2 13.6394 2 12C2 10.3606 2.42496 9.80853 3.27489 8.70433C4.97196 6.49956 7.81811 4 12 4C16.1819 4 19.028 6.49956 20.7251 8.70433C21.575 9.80853 22 10.3606 22 12C22 13.6394 21.575 14.1915 20.7251 15.2957C19.028 17.5004 16.1819 20 12 20C7.81811 20 4.97196 17.5004 3.27489 15.2957Z"
                                    stroke="currentColor" stroke-width="1.5"></path>
                                <path
                                    d="M15 12C15 13.6569 13.6569 15 12 15C10.3431 15 9 13.6569 9 12C9 10.3431 10.3431 9 12 9C13.6569 9 15 10.3431 15 12Z"
                                    stroke="currentColor" stroke-width="1.5"></path>
                            </svg>
                            Last Week 0 --}}
                        </div>
                    </div>

                    <!-- Bounce Rate -->
                    <div class="panel bg-gradient-to-r from-fuchsia-500 to-fuchsia-400">
                        <div class="flex justify-between">
                            <div class="ltr:mr-1 rtl:ml-1 text-md font-semibold">Current Month Visitor</div>
                            <div x-data="dropdown" @click.outside="open = false" class="dropdown">
                                <a href="javascript:;" @click="toggle">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg"
                                        class="w-5 h-5 hover:opacity-80 opacity-70">
                                        <circle cx="5" cy="12" r="2" stroke="currentColor"
                                            stroke-width="1.5" />
                                        <circle opacity="0.5" cx="12" cy="12" r="2"
                                            stroke="currentColor" stroke-width="1.5" />
                                        <circle cx="19" cy="12" r="2" stroke="currentColor"
                                            stroke-width="1.5" />
                                    </svg>
                                </a>
                                <ul x-cloak x-show="open" x-transition x-transition.duration.300ms
                                    class="ltr:right-0 rtl:left-0 text-black dark:text-white-dark">
                                    <li><a href="javascript:;" @click="toggle">View Report</a></li>
                                    <li><a href="javascript:;" @click="toggle">Edit Report</a></li>

                                </ul>
                            </div>
                        </div>
                        <div class="flex items-center mt-5">
                            <div class="text-3xl font-bold ltr:mr-3 rtl:ml-3">{{$monthlyvisitor}}</div>
                            {{-- <div class="badge bg-white/30">- 0.35% </div> --}}
                        </div>
                        <div class="flex items-center font-semibold mt-5">
                            {{-- <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 ltr:mr-2 rtl:ml-2 shrink-0">
                                <path opacity="0.5"
                                    d="M3.27489 15.2957C2.42496 14.1915 2 13.6394 2 12C2 10.3606 2.42496 9.80853 3.27489 8.70433C4.97196 6.49956 7.81811 4 12 4C16.1819 4 19.028 6.49956 20.7251 8.70433C21.575 9.80853 22 10.3606 22 12C22 13.6394 21.575 14.1915 20.7251 15.2957C19.028 17.5004 16.1819 20 12 20C7.81811 20 4.97196 17.5004 3.27489 15.2957Z"
                                    stroke="currentColor" stroke-width="1.5"></path>
                                <path
                                    d="M15 12C15 13.6569 13.6569 15 12 15C10.3431 15 9 13.6569 9 12C9 10.3431 10.3431 9 12 9C13.6569 9 15 10.3431 15 12Z"
                                    stroke="currentColor" stroke-width="1.5"></path>
                            </svg>
                            Last Week 0 --}}
                        </div>
                    </div>

                    <div class="panel bg-gradient-to-r from-cyan-500 to-cyan-400">
                        <div class="flex justify-between">
                            <div class="ltr:mr-1 rtl:ml-1 text-md font-semibold">Blocked Visitor</div>
                            <div x-data="dropdown" @click.outside="open = false" class="dropdown">
                                <a href="javascript:;" @click="toggle">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg"
                                        class="w-5 h-5 hover:opacity-80 opacity-70">
                                        <circle cx="5" cy="12" r="2" stroke="currentColor"
                                            stroke-width="1.5" />
                                        <circle opacity="0.5" cx="12" cy="12" r="2"
                                            stroke="currentColor" stroke-width="1.5" />
                                        <circle cx="19" cy="12" r="2" stroke="currentColor"
                                            stroke-width="1.5" />
                                    </svg>
                                </a>
                                <ul x-cloak x-show="open" x-transition x-transition.duration.300ms
                                    class="ltr:right-0 rtl:left-0 text-black dark:text-white-dark">
                                    <li><a href="javascript:;" @click="toggle">View Report</a></li>
                                    <li><a href="javascript:;" @click="toggle">Edit Report</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="flex items-center mt-5">
                            <div class="text-3xl font-bold ltr:mr-3 rtl:ml-3">{{$blocked_visitor}}</div>
                            {{-- <div class="badge bg-white/30">+ 2.35% </div> --}}
                        </div>
                        {{-- <div class="flex items-center font-semibold mt-5">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 ltr:mr-2 rtl:ml-2 shrink-0">
                                <path opacity="0.5"
                                    d="M3.27489 15.2957C2.42496 14.1915 2 13.6394 2 12C2 10.3606 2.42496 9.80853 3.27489 8.70433C4.97196 6.49956 7.81811 4 12 4C16.1819 4 19.028 6.49956 20.7251 8.70433C21.575 9.80853 22 10.3606 22 12C22 13.6394 21.575 14.1915 20.7251 15.2957C19.028 17.5004 16.1819 20 12 20C7.81811 20 4.97196 17.5004 3.27489 15.2957Z"
                                    stroke="currentColor" stroke-width="1.5"></path>
                                <path
                                    d="M15 12C15 13.6569 13.6569 15 12 15C10.3431 15 9 13.6569 9 12C9 10.3431 10.3431 9 12 9C13.6569 9 15 10.3431 15 12Z"
                                    stroke="currentColor" stroke-width="1.5"></path>
                            </svg>
                            Last Week 0
                        </div> --}}
                    </div>

                </div>

            </div>

            <div class="pt-5">
                <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-5 gap-6 mb-6 text-white">
                    <!-- Users Visit -->
                    <div class="panel bg-gradient-to-r from-cyan-500 to-cyan-400">
                        <div class="flex justify-between">
                            <div class="ltr:mr-1 rtl:ml-1 text-md font-semibold">My Ticket</div>
                            <div x-data="dropdown" @click.outside="open = false" class="dropdown">
                                <a href="javascript:;" @click="toggle">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg"
                                        class="w-5 h-5 hover:opacity-80 opacity-70">
                                        <circle cx="5" cy="12" r="2" stroke="currentColor"
                                            stroke-width="1.5" />
                                        <circle opacity="0.5" cx="12" cy="12" r="2"
                                            stroke="currentColor" stroke-width="1.5" />
                                        <circle cx="19" cy="12" r="2" stroke="currentColor"
                                            stroke-width="1.5" />
                                    </svg>
                                </a>
                                <ul x-cloak x-show="open" x-transition x-transition.duration.300ms
                                    class="ltr:right-0 rtl:left-0 text-black dark:text-white-dark">
                                    <li><a href="javascript:;" @click="toggle">View Report</a></li>
                                    <li><a href="javascript:;" @click="toggle">Edit Report</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="flex items-center mt-5">
                            <div class="text-3xl font-bold ltr:mr-3 rtl:ml-3"> 0 </div>
                            {{-- <div class="badge bg-white/30">+ 2.35% </div> --}}
                        </div>
                        {{-- <div class="flex items-center font-semibold mt-5">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 ltr:mr-2 rtl:ml-2 shrink-0">
                                <path opacity="0.5"
                                    d="M3.27489 15.2957C2.42496 14.1915 2 13.6394 2 12C2 10.3606 2.42496 9.80853 3.27489 8.70433C4.97196 6.49956 7.81811 4 12 4C16.1819 4 19.028 6.49956 20.7251 8.70433C21.575 9.80853 22 10.3606 22 12C22 13.6394 21.575 14.1915 20.7251 15.2957C19.028 17.5004 16.1819 20 12 20C7.81811 20 4.97196 17.5004 3.27489 15.2957Z"
                                    stroke="currentColor" stroke-width="1.5"></path>
                                <path
                                    d="M15 12C15 13.6569 13.6569 15 12 15C10.3431 15 9 13.6569 9 12C9 10.3431 10.3431 9 12 9C13.6569 9 15 10.3431 15 12Z"
                                    stroke="currentColor" stroke-width="1.5"></path>
                            </svg>
                            Last Week 0
                        </div> --}}
                    </div>

                    <!-- Sessions -->
                    <div class="panel bg-gradient-to-r from-violet-500 to-violet-400">
                        <div class="flex justify-between">
                            <div class="ltr:mr-1 rtl:ml-1 text-md font-semibold">New Tickets</div>
                            <div x-data="dropdown" @click.outside="open = false" class="dropdown">
                                <a href="javascript:;" @click="toggle">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg"
                                        class="w-5 h-5 hover:opacity-80 opacity-70">
                                        <circle cx="5" cy="12" r="2" stroke="currentColor"
                                            stroke-width="1.5" />
                                        <circle opacity="0.5" cx="12" cy="12" r="2"
                                            stroke="currentColor" stroke-width="1.5" />
                                        <circle cx="19" cy="12" r="2" stroke="currentColor"
                                            stroke-width="1.5" />
                                    </svg>
                                </a>
                                <ul x-cloak x-show="open" x-transition x-transition.duration.300ms
                                    class="ltr:right-0 rtl:left-0 text-black dark:text-white-dark">

                                    <li><a href="javascript:;" @click="toggle">View Report</a></li>
                                    <li><a href="javascript:;" @click="toggle">Edit Report</a></li>

                                </ul>
                            </div>
                        </div>
                        <div class="flex items-center mt-5">
                            <div class="text-3xl font-bold ltr:mr-3 rtl:ml-3">0 </div>
                            {{-- <div class="badge bg-white/30">- 2.35% </div> --}}
                        </div>
                        <div class="flex items-center font-semibold mt-5">
                            {{-- <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 ltr:mr-2 rtl:ml-2 shrink-0">
                                <path opacity="0.5"
                                    d="M3.27489 15.2957C2.42496 14.1915 2 13.6394 2 12C2 10.3606 2.42496 9.80853 3.27489 8.70433C4.97196 6.49956 7.81811 4 12 4C16.1819 4 19.028 6.49956 20.7251 8.70433C21.575 9.80853 22 10.3606 22 12C22 13.6394 21.575 14.1915 20.7251 15.2957C19.028 17.5004 16.1819 20 12 20C7.81811 20 4.97196 17.5004 3.27489 15.2957Z"
                                    stroke="currentColor" stroke-width="1.5"></path>
                                <path
                                    d="M15 12C15 13.6569 13.6569 15 12 15C10.3431 15 9 13.6569 9 12C9 10.3431 10.3431 9 12 9C13.6569 9 15 10.3431 15 12Z"
                                    stroke="currentColor" stroke-width="1.5"></path>
                            </svg>
                            Last Week 0 --}}
                        </div>
                    </div>

                    <!-- Time On-Site -->
                    <div class="panel bg-gradient-to-r from-blue-500 to-blue-400">
                        <div class="flex justify-between">
                            <div class="ltr:mr-1 rtl:ml-1 text-md font-semibold">Open Ticket</div>
                            <div x-data="dropdown" @click.outside="open = false" class="dropdown">
                                <a href="javascript:;" @click="toggle">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg"
                                        class="w-5 h-5 hover:opacity-80 opacity-70">
                                        <circle cx="5" cy="12" r="2" stroke="currentColor"
                                            stroke-width="1.5" />
                                        <circle opacity="0.5" cx="12" cy="12" r="2"
                                            stroke="currentColor" stroke-width="1.5" />
                                        <circle cx="19" cy="12" r="2" stroke="currentColor"
                                            stroke-width="1.5" />
                                    </svg>
                                </a>
                                <ul x-cloak x-show="open" x-transition x-transition.duration.300ms
                                    class="ltr:right-0 rtl:left-0 text-black dark:text-white-dark">
                                    <li><a href="javascript:;" @click="toggle">View Report</a></li>
                                    <li><a href="javascript:;" @click="toggle">Edit Report</a></li>

                                </ul>
                            </div>
                        </div>
                        <div class="flex items-center mt-5">
                            <div class="text-3xl font-bold ltr:mr-3 rtl:ml-3">0</div>
                            {{-- <div class="badge bg-white/30">+ 1.35% </div> --}}
                        </div>
                        <div class="flex items-center font-semibold mt-5">
                            {{-- <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 ltr:mr-2 rtl:ml-2 shrink-0">
                                <path opacity="0.5"
                                    d="M3.27489 15.2957C2.42496 14.1915 2 13.6394 2 12C2 10.3606 2.42496 9.80853 3.27489 8.70433C4.97196 6.49956 7.81811 4 12 4C16.1819 4 19.028 6.49956 20.7251 8.70433C21.575 9.80853 22 10.3606 22 12C22 13.6394 21.575 14.1915 20.7251 15.2957C19.028 17.5004 16.1819 20 12 20C7.81811 20 4.97196 17.5004 3.27489 15.2957Z"
                                    stroke="currentColor" stroke-width="1.5"></path>
                                <path
                                    d="M15 12C15 13.6569 13.6569 15 12 15C10.3431 15 9 13.6569 9 12C9 10.3431 10.3431 9 12 9C13.6569 9 15 10.3431 15 12Z"
                                    stroke="currentColor" stroke-width="1.5"></path>
                            </svg>
                            Last Week 0 --}}
                        </div>
                    </div>

                    <!-- Bounce Rate -->
                    <div class="panel bg-gradient-to-r from-fuchsia-500 to-fuchsia-400">
                        <div class="flex justify-between">
                            <div class="ltr:mr-1 rtl:ml-1 text-md font-semibold">Hold Ticket</div>
                            <div x-data="dropdown" @click.outside="open = false" class="dropdown">
                                <a href="javascript:;" @click="toggle">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg"
                                        class="w-5 h-5 hover:opacity-80 opacity-70">
                                        <circle cx="5" cy="12" r="2" stroke="currentColor"
                                            stroke-width="1.5" />
                                        <circle opacity="0.5" cx="12" cy="12" r="2"
                                            stroke="currentColor" stroke-width="1.5" />
                                        <circle cx="19" cy="12" r="2" stroke="currentColor"
                                            stroke-width="1.5" />
                                    </svg>
                                </a>
                                <ul x-cloak x-show="open" x-transition x-transition.duration.300ms
                                    class="ltr:right-0 rtl:left-0 text-black dark:text-white-dark">
                                    <li><a href="javascript:;" @click="toggle">View Report</a></li>
                                    <li><a href="javascript:;" @click="toggle">Edit Report</a></li>

                                </ul>
                            </div>
                        </div>
                        <div class="flex items-center mt-5">
                            <div class="text-3xl font-bold ltr:mr-3 rtl:ml-3">0</div>
                            {{-- <div class="badge bg-white/30">- 0.35% </div> --}}
                        </div>
                        <div class="flex items-center font-semibold mt-5">
                            {{-- <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 ltr:mr-2 rtl:ml-2 shrink-0">
                                <path opacity="0.5"
                                    d="M3.27489 15.2957C2.42496 14.1915 2 13.6394 2 12C2 10.3606 2.42496 9.80853 3.27489 8.70433C4.97196 6.49956 7.81811 4 12 4C16.1819 4 19.028 6.49956 20.7251 8.70433C21.575 9.80853 22 10.3606 22 12C22 13.6394 21.575 14.1915 20.7251 15.2957C19.028 17.5004 16.1819 20 12 20C7.81811 20 4.97196 17.5004 3.27489 15.2957Z"
                                    stroke="currentColor" stroke-width="1.5"></path>
                                <path
                                    d="M15 12C15 13.6569 13.6569 15 12 15C10.3431 15 9 13.6569 9 12C9 10.3431 10.3431 9 12 9C13.6569 9 15 10.3431 15 12Z"
                                    stroke="currentColor" stroke-width="1.5"></path>
                            </svg>
                            Last Week 0 --}}
                        </div>
                    </div>

                    <div class="panel bg-gradient-to-r from-cyan-500 to-cyan-400">
                        <div class="flex justify-between">
                            <div class="ltr:mr-1 rtl:ml-1 text-md font-semibold">Close Ticket</div>
                            <div x-data="dropdown" @click.outside="open = false" class="dropdown">
                                <a href="javascript:;" @click="toggle">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg"
                                        class="w-5 h-5 hover:opacity-80 opacity-70">
                                        <circle cx="5" cy="12" r="2" stroke="currentColor"
                                            stroke-width="1.5" />
                                        <circle opacity="0.5" cx="12" cy="12" r="2"
                                            stroke="currentColor" stroke-width="1.5" />
                                        <circle cx="19" cy="12" r="2" stroke="currentColor"
                                            stroke-width="1.5" />
                                    </svg>
                                </a>
                                <ul x-cloak x-show="open" x-transition x-transition.duration.300ms
                                    class="ltr:right-0 rtl:left-0 text-black dark:text-white-dark">
                                    <li><a href="javascript:;" @click="toggle">View Report</a></li>
                                    <li><a href="javascript:;" @click="toggle">Edit Report</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="flex items-center mt-5">
                            <div class="text-3xl font-bold ltr:mr-3 rtl:ml-3"> 0 </div>
                            {{-- <div class="badge bg-white/30">+ 2.35% </div> --}}
                        </div>
                        {{-- <div class="flex items-center font-semibold mt-5">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 ltr:mr-2 rtl:ml-2 shrink-0">
                                <path opacity="0.5"
                                    d="M3.27489 15.2957C2.42496 14.1915 2 13.6394 2 12C2 10.3606 2.42496 9.80853 3.27489 8.70433C4.97196 6.49956 7.81811 4 12 4C16.1819 4 19.028 6.49956 20.7251 8.70433C21.575 9.80853 22 10.3606 22 12C22 13.6394 21.575 14.1915 20.7251 15.2957C19.028 17.5004 16.1819 20 12 20C7.81811 20 4.97196 17.5004 3.27489 15.2957Z"
                                    stroke="currentColor" stroke-width="1.5"></path>
                                <path
                                    d="M15 12C15 13.6569 13.6569 15 12 15C10.3431 15 9 13.6569 9 12C9 10.3431 10.3431 9 12 9C13.6569 9 15 10.3431 15 12Z"
                                    stroke="currentColor" stroke-width="1.5"></path>
                            </svg>
                            Last Week 0
                        </div> --}}
                    </div>

                </div>

            </div>
            <div class="pt-5">
                <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-6 mb-6 text-white">
                    <div class="panel bg-gradient-to-r from-blue-500 to-blue-400">
                        <div class="flex justify-between">
                            <div class="ltr:mr-1 rtl:ml-1 text-md font-semibold">Total Sub Users </div>
                            <div x-data="dropdown" @click.outside="open = false" class="dropdown">
                                <a href="javascript:;" @click="toggle">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg"
                                        class="w-5 h-5 hover:opacity-80 opacity-70">
                                        <circle cx="5" cy="12" r="2" stroke="currentColor"
                                            stroke-width="1.5" />
                                        <circle opacity="0.5" cx="12" cy="12" r="2"
                                            stroke="currentColor" stroke-width="1.5" />
                                        <circle cx="19" cy="12" r="2" stroke="currentColor"
                                            stroke-width="1.5" />
                                    </svg>
                                </a>
                                <ul x-cloak x-show="open" x-transition x-transition.duration.300ms
                                    class="ltr:right-0 rtl:left-0 text-black dark:text-white-dark">
                                    <li><a href="javascript:;" @click="toggle">View Report</a></li>
                                    <li><a href="javascript:;" @click="toggle">Edit Report</a></li>

                                </ul>
                            </div>
                        </div>
                        <div class="flex items-center mt-5">
                            <div class="text-3xl font-bold ltr:mr-3 rtl:ml-3">0</div>
                            {{-- <div class="badge bg-white/30">+ 1.35% </div> --}}
                        </div>
                        <div class="flex items-center font-semibold mt-5">
                            {{-- <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 ltr:mr-2 rtl:ml-2 shrink-0">
                                <path opacity="0.5"
                                    d="M3.27489 15.2957C2.42496 14.1915 2 13.6394 2 12C2 10.3606 2.42496 9.80853 3.27489 8.70433C4.97196 6.49956 7.81811 4 12 4C16.1819 4 19.028 6.49956 20.7251 8.70433C21.575 9.80853 22 10.3606 22 12C22 13.6394 21.575 14.1915 20.7251 15.2957C19.028 17.5004 16.1819 20 12 20C7.81811 20 4.97196 17.5004 3.27489 15.2957Z"
                                    stroke="currentColor" stroke-width="1.5"></path>
                                <path
                                    d="M15 12C15 13.6569 13.6569 15 12 15C10.3431 15 9 13.6569 9 12C9 10.3431 10.3431 9 12 9C13.6569 9 15 10.3431 15 12Z"
                                    stroke="currentColor" stroke-width="1.5"></path>
                            </svg>
                            Last Week 0 --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener("alpine:init", () => {
            // finance
            Alpine.data("finance", () => ({
                init() {
                    const bitcoin = null;
                    const ethereum = null;
                    const litecoin = null;
                    const binance = null;
                    const tether = null;
                    const solana = null;

                    setTimeout(() => {
                        this.bitcoin = new ApexCharts(this.$refs.bitcoin, this.bitcoinOptions);
                        this.bitcoin.render();

                        this.ethereum = new ApexCharts(this.$refs.ethereum, this
                            .ethereumOptions);
                        this.ethereum.render();

                        this.litecoin = new ApexCharts(this.$refs.litecoin, this
                            .litecoinOptions);
                        this.litecoin.render();

                        this.binance = new ApexCharts(this.$refs.binance, this.binanceOptions);
                        this.binance.render();

                        this.tether = new ApexCharts(this.$refs.tether, this.tetherOptions);
                        this.tether.render();

                        this.solana = new ApexCharts(this.$refs.solana, this.solanaOptions);
                        this.solana.render();
                    }, 300);

                },

                get bitcoinOptions() {
                    return {
                        series: [{
                            data: [21, 9, 36, 12, 44, 25, 59, 41, 25, 66]
                        }],
                        chart: {
                            height: 45,
                            type: 'line',
                            sparkline: {
                                enabled: true
                            },
                        },
                        stroke: {
                            width: 2
                        },
                        markers: {
                            size: 0
                        },
                        colors: ['#00ab55'],
                        grid: {
                            padding: {
                                top: 0,
                                bottom: 0,
                                left: 0
                            }
                        },
                        tooltip: {
                            x: {
                                show: false
                            },
                            y: {
                                title: {
                                    formatter: formatter = () => {
                                        return '';
                                    },
                                },
                            },
                        },
                        responsive: [{
                            breakPoint: 576,
                            options: {
                                chart: {
                                    height: 95
                                },
                                grid: {
                                    padding: {
                                        top: 45,
                                        bottom: 0,
                                        left: 0
                                    }
                                }
                            }
                        }],
                    }
                },

                get ethereumOptions() {
                    return {
                        series: [{
                            data: [44, 25, 59, 41, 66, 25, 21, 9, 36, 12]
                        }],
                        chart: {
                            height: 45,
                            type: 'line',
                            sparkline: {
                                enabled: true
                            },
                        },
                        stroke: {
                            width: 2
                        },
                        markers: {
                            size: 0
                        },
                        colors: ['#e7515a'],
                        grid: {
                            padding: {
                                top: 0,
                                bottom: 0,
                                left: 0
                            }
                        },
                        tooltip: {
                            x: {
                                show: false
                            },
                            y: {
                                title: {
                                    formatter: formatter = () => {
                                        return '';
                                    },
                                },
                            },
                        },
                        responsive: [{
                            breakPoint: 576,
                            options: {
                                chart: {
                                    height: 95
                                },
                                grid: {
                                    padding: {
                                        top: 45,
                                        bottom: 0,
                                        left: 0
                                    }
                                }
                            }
                        }],
                    }
                },

                get litecoinOptions() {
                    return {
                        series: [{
                            data: [9, 21, 36, 12, 66, 25, 44, 25, 41, 59]
                        }],
                        chart: {
                            height: 45,
                            type: 'line',
                            sparkline: {
                                enabled: true
                            },
                        },
                        stroke: {
                            width: 2
                        },
                        markers: {
                            size: 0
                        },
                        colors: ['#00ab55'],
                        grid: {
                            padding: {
                                top: 0,
                                bottom: 0,
                                left: 0
                            }
                        },
                        tooltip: {
                            x: {
                                show: false
                            },
                            y: {
                                title: {
                                    formatter: formatter = () => {
                                        return '';
                                    },
                                },
                            },
                        },
                        responsive: [{
                            breakPoint: 576,
                            options: {
                                chart: {
                                    height: 95
                                },
                                grid: {
                                    padding: {
                                        top: 45,
                                        bottom: 0,
                                        left: 0
                                    }
                                }
                            }
                        }],
                    }
                },

                get binanceOptions() {
                    return {
                        series: [{
                            data: [25, 44, 25, 59, 41, 21, 36, 12, 19, 9]
                        }],
                        chart: {
                            height: 45,
                            type: 'line',
                            sparkline: {
                                enabled: true
                            },
                        },
                        stroke: {
                            width: 2
                        },
                        markers: {
                            size: 0
                        },
                        colors: ['#e7515a'],
                        grid: {
                            padding: {
                                top: 0,
                                bottom: 0,
                                left: 0
                            }
                        },
                        tooltip: {
                            x: {
                                show: false
                            },
                            y: {
                                title: {
                                    formatter: formatter = () => {
                                        return '';
                                    },
                                },
                            },
                        },
                        responsive: [{
                            breakPoint: 576,
                            options: {
                                chart: {
                                    height: 95
                                },
                                grid: {
                                    padding: {
                                        top: 45,
                                        bottom: 0,
                                        left: 0
                                    }
                                }
                            }
                        }],
                    }
                },

                get tetherOptions() {
                    return {
                        series: [{
                            data: [21, 59, 41, 44, 25, 66, 9, 36, 25, 12]
                        }],
                        chart: {
                            height: 45,
                            type: 'line',
                            sparkline: {
                                enabled: true
                            },
                        },
                        stroke: {
                            width: 2
                        },
                        markers: {
                            size: 0
                        },
                        colors: ['#00ab55'],
                        grid: {
                            padding: {
                                top: 0,
                                bottom: 0,
                                left: 0
                            }
                        },
                        tooltip: {
                            x: {
                                show: false
                            },
                            y: {
                                title: {
                                    formatter: formatter = () => {
                                        return '';
                                    },
                                },
                            },
                        },
                        responsive: [{
                            breakPoint: 576,
                            options: {
                                chart: {
                                    height: 95
                                },
                                grid: {
                                    padding: {
                                        top: 45,
                                        bottom: 0,
                                        left: 0
                                    }
                                }
                            }
                        }],
                    }
                },

                get solanaOptions() {
                    return {
                        series: [{
                            data: [21, -9, 36, -12, 44, 25, 59, -41, 66, -25]
                        }],
                        chart: {
                            height: 45,
                            type: 'line',
                            sparkline: {
                                enabled: true
                            },
                        },
                        stroke: {
                            width: 2
                        },
                        markers: {
                            size: 0
                        },
                        colors: ['#e7515a'],
                        grid: {
                            padding: {
                                top: 0,
                                bottom: 0,
                                left: 0
                            }
                        },
                        tooltip: {
                            x: {
                                show: false
                            },
                            y: {
                                title: {
                                    formatter: formatter = () => {
                                        return '';
                                    },
                                },
                            },
                        },
                        responsive: [{
                            breakPoint: 576,
                            options: {
                                chart: {
                                    height: 95
                                },
                                grid: {
                                    padding: {
                                        top: 45,
                                        bottom: 0,
                                        left: 0
                                    }
                                }
                            }
                        }],
                    }
                }
            }));
        });
    </script>

</x-layout.default>
