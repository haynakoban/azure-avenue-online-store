@include('partials._header')

    <div class="bg-[#e7493b]">
        <div class="flex items-center justify-center gap-x-6 overflow-hidden px-6 py-2.5 sm:px-3.5">
            <div class="flex flex-wrap items-center gap-x-4 gap-y-2 justify-center">
                <p class="text-sm leading-6 text-white text-center tracking-wide">
                    <strong class="font-semibold">AzureAvenue 2023</strong><svg viewBox="0 0 2 2" class="mx-2 inline h-0.5 w-0.5 fill-current" aria-hidden="true"><circle cx="1" cy="1" r="1" /></svg>Join us in Manila, Philippines from <strong class="font-semibold">May 1 – 31</strong> to see what’s coming next.
                </p>
                <a href="#" class="flex-none rounded-full bg-[#4E73DF] px-3.5 py-1 text-sm font-semibold text-white shadow-sm hover:bg-gray-700 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-gray-900">Register now <span aria-hidden="true">&rarr;</span></a>
            </div>
        </div>

        <nav x-data="{ open: false }" class="w-full z-20 top-0 left-0 border-b border-gray-200">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <div class="relative flex h-[72px] items-center">
                    <div class="flex flex-1 items-center sm:items-stretch sm:justify-start">
                        <div class="flex flex-shrink-0 items-center">
                            <a href="/">
                                <img class="block h-10 w-auto" src="https://tailwindui.com/img/logos/mark.svg?color=indigo&shade=500" alt="Your Company">
                            </a>
                        </div>
                        <div class="hidden sm:ml-6 sm:block grow">
                            <div class="w-full space-x-4">
                                <form method="GET" action="/search">   
                                    <label for="default-search" class="mb-2 text-sm font-medium text-gray-900 sr-only">Search</label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                            <svg aria-hidden="true" class="w-5 h-5 text-[#333333]" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                                        </div>
                                        <input type="search" name="keyword" id="default-search" class="block w-full p-4 pl-10 text-sm text-[#333333] border border-gray-300 rounded-lg bg-gray-50 focus:outline-none" placeholder="Search Products, Categories...">
                                        <button type="submit" class="text-white absolute right-2.5 bottom-2.5 bg-[#E74A3B] hover:bg-red-700 focus:outline-none font-medium rounded-lg text-sm px-4 py-2">Search</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="absolute inset-y-0 right-0 flex items-center pr-2 sm:static sm:inset-auto sm:ml-8 sm:pr-0">
                    <!-- Profile dropdown -->
                        <div class="relative mr-0 sm:mr-8">
                            <div class="flex items-center divide-x">
                                @auth
                                <span class="text-white mr-3 font-semibold text-md">{{ auth()->user()->name }}</span>
                                <button @click="open = !open" type="button" class="flex rounded-full bg-gray-800 text-sm focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800" id="user-menu-button" aria-expanded="false" aria-haspopup="true">
                                    <img class="h-8 w-8 rounded-full" src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="">
                                </button>
                                @else
                                <li class="mr-3 list-none" style="margin: 0 !important">
                                    <a href="/register" class="block py-2 px-4 text-white rounded">Sign Up</a>
                                </li>
                                <li class="list-none" style="margin: 0 !important">
                                    <a href="/login" class="block py-2 px-4 text-white rounded">Log In</a>
                                </li>
                                @endauth  
                            </div>

                            <div x-show="open" class="absolute right-0 z-10 mt-2 w-44 origin-top-right rounded-md bg-white py-1 shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none" role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button" tabindex="-1">
                                <a href="#" class="block px-4 py-2 text-sm text-[#333333]" role="menuitem" tabindex="-1" id="user-menu-item-0">Your Profile</a>
                                <a href="#" class="block px-4 py-2 text-sm text-[#333333]" role="menuitem" tabindex="-1" id="user-menu-item-1">Settings</a>
                                <form action="/logout" method="POST" class="w-full"> 
                                    @csrf
                                    <button type="submit" class="block px-4 py-2 text-sm text-[#333333]" role="menuitem" tabindex="-1">Sign out</a>
                                </form>
                            </div>
                        </div>

                    <!-- Shopping bag -->
                        <div :class="isBagOpen && 'hidden'" class="flex items-center">
                            {{-- @auth
                            <button x-on:click="isBagOpen = !isBagOpen" type="button" class="rounded-full bg-[#E74A3B] p-1 text-gray-400 hover:text-white">
                                <svg class="h-6 w-6" fill="none" stroke="#FFFFFF" stroke-width="1.75" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 10-7.5 0v4.5m11.356-1.993l1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 01-1.12-1.243l1.264-12A1.125 1.125 0 015.513 7.5h12.974c.576 0 1.059.435 1.119 1.007zM8.625 10.5a.375.375 0 11-.75 0 .375.375 0 01.75 0zm7.5 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z"></path>
                                </svg>
                            </button>
                            @else --}}
                            <a href="/login" class="rounded-full bg-[#E74A3B] p-1 text-gray-400 hover:text-white">
                                <svg class="h-6 w-6" fill="none" stroke="#FFFFFF" stroke-width="1.75" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 10-7.5 0v4.5m11.356-1.993l1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 01-1.12-1.243l1.264-12A1.125 1.125 0 015.513 7.5h12.974c.576 0 1.059.435 1.119 1.007zM8.625 10.5a.375.375 0 11-.75 0 .375.375 0 01.75 0zm7.5 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z"></path>
                                </svg>
                            </a>
                            {{-- @endauth   --}}
                            {{-- <span class="text-white pl-1 font-semibold text-md">{{ $shoppingBag->count() }}</span> --}}
                        </div>

                        {{-- <div :class="isBagOpen || 'hidden'">
                            <x-shopping-bag />
                        </div> --}}
                    </div>
                </div>
            </div>

            <!-- Mobile menu, show/hide based on menu state. -->
            <div class="sm:hidden" id="mobile-menu">
                <div class="space-y-1 px-4 pb-4 pt-2">
                    <form method="GET" action="/search">
                        @csrf  
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <svg aria-hidden="true" class="w-5 h-5 text-[#333333]" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                            </div>
                            <input type="search" name="keyword" id="default-search" class="block w-full p-4 pl-10 text-sm text-[#333333] border border-gray-300 rounded-lg bg-gray-50 focus:outline-none" placeholder="Search Products, Categories...">
                            <button type="submit" class="text-white absolute right-2.5 bottom-2.5 bg-[#E74A3B] hover:bg-red-700 focus:outline-none font-medium rounded-lg text-sm px-4 py-2">Search</button>
                        </div>
                    </form>
                </div>
            </div>
        </nav>
    </div>

    <main>
        @yield('content')
    </main>

    <footer class="bg-white">
        <div class="max-w-screen-xl px-4 py-8 mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 gap-8 lg:grid-cols-3">
                <div>
                    <a href="/">
                        <img class="mr-5 block h-10 w-auto" src="https://tailwindui.com/img/logos/mark.svg?color=indigo&shade=500" alt="logo" />
                    </a>
                    <p class="max-w-xs mt-4 text-sm text-gray-600">
                        Discover a wide range of competitively priced products at our online store. Shop with ease using our user-friendly interface, enjoy fast and reliable delivery, and secure payment options. Start shopping now for a hassle-free experience!
                    </p>
                    <div class="flex mt-8 space-x-6 text-gray-600">
                        <a class="hover:opacity-75" href target="_blank" rel="noreferrer">
                            <span class="sr-only"> Facebook </span>
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path fillRule="evenodd" d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z" clipRule="evenodd" />
                            </svg>
                        </a>
                        <a class="hover:opacity-75" href target="_blank" rel="noreferrer">
                            <span class="sr-only"> Instagram </span>
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path fillRule="evenodd" d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.465 2.427.048 1.067.06 1.407.06 4.123v.08c0 2.643-.012 2.987-.06 4.043-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.772 1.153c-.636.247-1.363.416-2.427.465-1.067.048-1.407.06-4.123.06h-.08c-2.643 0-2.987-.012-4.043-.06-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 01-1.772-1.153 4.902 4.902 0 01-1.153-1.772c-.247-.636-.416-1.363-.465-2.427-.047-1.024-.06-1.379-.06-3.808v-.63c0-2.43.013-2.784.06-3.808.049-1.064.218-1.791.465-2.427a4.902 4.902 0 011.153-1.772A4.902 4.902 0 015.45 2.525c.636-.247 1.363-.416 2.427-.465C8.901 2.013 9.256 2 11.685 2h.63zm-.081 1.802h-.468c-2.456 0-2.784.011-3.807.058-.975.045-1.504.207-1.857.344-.467.182-.8.398-1.15.748-.35.35-.566.683-.748 1.15-.137.353-.3.882-.344 1.857-.047 1.023-.058 1.351-.058 3.807v.468c0 2.456.011 2.784.058 3.807.045.975.207 1.504.344 1.857.182.466.399.8.748 1.15.35.35.683.566 1.15.748.353.137.882.3 1.857.344 1.054.048 1.37.058 4.041.058h.08c2.597 0 2.917-.01 3.96-.058.976-.045 1.505-.207 1.858-.344.466-.182.8-.398 1.15-.748.35-.35.566-.683.748-1.15.137-.353.3-.882.344-1.857.048-1.055.058-1.37.058-4.041v-.08c0-2.597-.01-2.917-.058-3.96-.045-.976-.207-1.505-.344-1.858a3.097 3.097 0 00-.748-1.15 3.098 3.098 0 00-1.15-.748c-.353-.137-.882-.3-1.857-.344-1.023-.047-1.351-.058-3.807-.058zM12 6.865a5.135 5.135 0 110 10.27 5.135 5.135 0 010-10.27zm0 1.802a3.333 3.333 0 100 6.666 3.333 3.333 0 000-6.666zm5.338-3.205a1.2 1.2 0 110 2.4 1.2 1.2 0 010-2.4z" clipRule="evenodd" />
                            </svg>
                        </a>
                        <a class="hover:opacity-75" href target="_blank" rel="noreferrer">
                            <span class="sr-only"> Twitter </span>
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path d="M8.29 20.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0022 5.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.072 4.072 0 012.8 9.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 012 18.407a11.616 11.616 0 006.29 1.84" />
                            </svg>
                        </a>
                        <a class="hover:opacity-75" href target="_blank" rel="noreferrer">
                            <span class="sr-only"> GitHub </span>
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path fillRule="evenodd" d="M12 2C6.477 2 2 6.484 2 12.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.531 1.032 1.531 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.202 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.943.359.309.678.92.678 1.855 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0022 12.017C22 6.484 17.522 2 12 2z" clipRule="evenodd" />
                            </svg>
                        </a>
                        <a class="hover:opacity-75" href target="_blank" rel="noreferrer">
                            <span class="sr-only"> Dribbble </span>
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path fillRule="evenodd" d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10c5.51 0 10-4.48 10-10S17.51 2 12 2zm6.605 4.61a8.502 8.502 0 011.93 5.314c-.281-.054-3.101-.629-5.943-.271-.065-.141-.12-.293-.184-.445a25.416 25.416 0 00-.564-1.236c3.145-1.28 4.577-3.124 4.761-3.362zM12 3.475c2.17 0 4.154.813 5.662 2.148-.152.216-1.443 1.941-4.48 3.08-1.399-2.57-2.95-4.675-3.189-5A8.687 8.687 0 0112 3.475zm-3.633.803a53.896 53.896 0 013.167 4.935c-3.992 1.063-7.517 1.04-7.896 1.04a8.581 8.581 0 014.729-5.975zM3.453 12.01v-.26c.37.01 4.512.065 8.775-1.215.25.477.477.965.694 1.453-.109.033-.228.065-.336.098-4.404 1.42-6.747 5.303-6.942 5.629a8.522 8.522 0 01-2.19-5.705zM12 20.547a8.482 8.482 0 01-5.239-1.8c.152-.315 1.888-3.656 6.703-5.337.022-.01.033-.01.054-.022a35.318 35.318 0 011.823 6.475 8.4 8.4 0 01-3.341.684zm4.761-1.465c-.086-.52-.542-3.015-1.659-6.084 2.679-.423 5.022.271 5.314.369a8.468 8.468 0 01-3.655 5.715z" clipRule="evenodd" />
                            </svg>
                        </a>
                    </div>
                </div>
                <div class="grid grid-cols-1 gap-8 lg:col-span-2 sm:grid-cols-2 lg:grid-cols-4">
                    <div>
                        <p class="font-semibold text-xs uppercase">
                            CUSTOMER SERVICE
                        </p>
                        <nav class="flex flex-col mt-4 space-y-2 text-xs text-[#333333]">
                            <a class="hover:text-gray-500" href> Help Centre </a>
                            <a class="hover:text-gray-500" href> Payment Methods </a>
                            <a class="hover:text-gray-500" href> Order Tracking </a>
                            <a class="hover:text-gray-500" href> Free Shipping </a>
                            <a class="hover:text-gray-500" href> Return & Refund </a>
                            <a class="hover:text-gray-500" href> Overseas Product </a>
                            <a class="hover:text-gray-500" href> International Product Policy </a>
                        </nav>
                    </div>
                    <div>
                        <p class="font-semibold text-xs uppercase">
                            AzureAvenue
                        </p>
                        <nav class="flex flex-col mt-4 space-y-2 text-xs text-[#333333]">
                            <a class="hover:text-gray-500" href> All Categories </a>
                            <a class="hover:text-gray-500" href> About AzureAvenue </a>
                            <a class="hover:text-gray-500" href> Affiliate Program </a>
                            <a class="hover:text-gray-500" href> Affiliate Academy </a>
                            <a class="hover:text-gray-500" href> Careers </a>
                            <a class="hover:text-gray-500" href> Contact Us </a>
                        </nav>
                    </div>
                    <div>
                        <p class="font-semibold text-xs uppercase">
                            Helpful Links
                        </p>
                        <nav class="flex flex-col mt-4 space-y-2 text-xs text-[#333333]">
                            <a class="hover:text-gray-500" href> Accounts Review </a>
                            <a class="hover:text-gray-500" href> HR Consulting </a>
                            <a class="hover:text-gray-500" href> SEO Optimisation </a>
                            <a class="hover:text-gray-500" href> FAQs </a>
                            <a class="hover:text-gray-500" href> Live Chat </a>
                        </nav>
                    </div>
                    <div>
                        <p class="font-semibold text-xs uppercase">
                            Legal
                        </p>
                        <nav class="flex flex-col mt-4 space-y-2 text-xs text-[#333333]">
                            <a class="hover:text-gray-500" href> Privacy Policy </a>
                            <a class="hover:text-gray-500" href> Terms &amp; Conditions </a>
                            <a class="hover:text-gray-500" href> Campaign Terms &amp; Conditions </a>
                            <a class="hover:text-gray-500" href> Returns Policy </a>
                            <a class="hover:text-gray-500" href> Press & Media </a>
                            <a class="hover:text-gray-500" href> Intellectual Property Protection </a>
                            <a class="hover:text-gray-500" href> Accessibility </a>
                        </nav>
                    </div>
                </div>
            </div>
            <p class="mt-8 text-xs text-[#333333] tracking-wider font-medium text-center">
                © 2023 <span class="text-[#e7493b]" style="font-weight: normal">Azure<span style="color: #4E73DF;">Avenue</span></span> - Manila, Philippines. All Rights Reserved.
            </p>
        </div>
    </footer>

@include('partials._footer')