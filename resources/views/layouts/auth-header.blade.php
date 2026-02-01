<header id="main-navbar" class="navbar-fixed">
    <div class="max-w-9xl px-4 py-1 md:px-6 md:py-2 shadow-[0_0_50px_0_rgb(231, 0, 11)]">
        <div class="flex justify-between items-center">
            <div class="flex items-center space-x-3">
                <div
                    class="w-7 h-7 md:w-8 md:h-8 bg-gradient-to-br from-red-500 to-red-600 rounded-full flex items-center justify-center pulse-glow">
                    <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 24 24">
                        <path
                            d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z" />
                    </svg>
                </div>
                <h1 class="text-xl md:text-2xl font-bold text-gray-800">JeevanPravaah</h1>
            </div>
            <nav class="hidden md:flex space-x-8 items-center">
                <a href="/"
                    class="nav-link {{ request()->is('/') ? 'text-red-500' : 'text-gray-700 hover:text-red-500' }} font-medium transition-all">Home</a>
                <a href="/about"
                    class="nav-link {{ request()->is('about') ? 'text-red-500' : 'text-gray-700 hover:text-red-500' }} font-medium transition-all">About</a>
                <a href="/donate"
                    class="nav-link {{ request()->is('donate') ? 'text-red-500' : 'text-gray-700 hover:text-red-500' }} font-medium transition-all">Donate</a>
                <a href="/request"
                    class="nav-link {{ request()->is('request') ? 'text-red-500' : 'text-gray-700 hover:text-red-500' }} font-medium transition-all">Request</a>
                <a href="/contact"
                    class="nav-link {{ request()->is('contact') ? 'text-red-500' : 'text-gray-700 hover:text-red-500' }} font-medium transition-all">Contact</a>

                <!-- User Profile Dropdown -->
                <div class="relative" x-data="{ open: false }">
                    <button @click="open = !open" @click.away="open = false"
                        class="inline-flex items-center gap-2 p-1 rounded-3xl text-sm font-semibold shadow-sm transition-all bg-gradient-to-r from-red-500 to-red-600 text-white hover:from-red-600 hover:to-red-700 hover:shadow-lg">
                        <!-- User Profile Image -->
                        <div
                            class="w-8 h-8 rounded-full bg-white/20 backdrop-blur-sm flex items-center justify-center overflow-hidden border-2 border-white/30">
                            @if (Auth::user()->profile_image_path)
                                <img src="{{ asset('storage/' . Auth::user()->profile_image_path) }}"
                                    alt="{{ Auth::user()->name }}" class="w-full h-full object-cover">
                            @else
                                <img src="{{ asset('assets/profile.svg') }}" alt="Default Profile"
                                    class="w-5 h-5 text-white opacity-90">
                            @endif
                        </div>
                        <span class="hidden sm:inline">{{ Auth::user()->name ?? 'User' }}</span>
                        <svg class="w-4 h-4 transition-transform" :class="{ 'rotate-180': open }" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>

                    <!-- Dropdown Menu -->
                    <div x-show="open" x-transition:enter="transition ease-out duration-200"
                        x-transition:enter-start="opacity-0 transform scale-95"
                        x-transition:enter-end="opacity-100 transform scale-100"
                        x-transition:leave="transition ease-in duration-150"
                        x-transition:leave-start="opacity-100 transform scale-100"
                        x-transition:leave-end="opacity-0 transform scale-95"
                        class="absolute right-0 mt-2 w-56 rounded-xl bg-white shadow-xl border border-gray-100 py-2 z-50">

                        <!-- User Info -->
                        <a href="{{ route('profile.show') }}">
                            <div class="px-4 py-3 border-b border-gray-100 flex items-center gap-3">
                                <!-- User Profile Image -->
                                <div
                                    class="w-10 h-10 rounded-full bg-gradient-to-br from-red-100 to-orange-100 flex items-center justify-center overflow-hidden border-2 border-red-200">
                                    @if (Auth::user()->profile_image_path)
                                        <img src="{{ asset('storage/' . Auth::user()->profile_image_path) }}"
                                            alt="{{ Auth::user()->name }}" class="w-full h-full object-cover">
                                    @else
                                        <img src="{{ asset('assets/profile.svg') }}" alt="Default Profile"
                                            class="w-6 h-6 text-red-500">
                                    @endif
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-sm font-semibold text-gray-900 truncate">
                                        {{ Auth::user()->name ?? 'User' }}</p>
                                    <p class="text-xs text-gray-500 truncate">
                                        {{ Auth::user()->email ?? 'user@example.com' }}</p>
                                </div>
                            </div>
                        </a>

                        {{-- <!-- Menu Items -->
                        <a href="{{ route('profile.show') }}"
                            class="flex items-center gap-3 px-4 py-2.5 text-sm text-gray-700 hover:bg-red-50 hover:text-red-600 transition-colors">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                            My Profile
                        </a> --}}
                        <a href="{{ route('donation.history') }}"
                            class="flex items-center gap-3 px-4 py-2.5 text-sm text-gray-700 hover:bg-red-50 hover:text-red-600 transition-colors">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            Donation History
                        </a>
                        {{-- <a href="#"
                            class="flex items-center gap-3 px-4 py-2.5 text-sm text-gray-700 hover:bg-red-50 hover:text-red-600 transition-colors">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            Settings
                        </a> --}}
                        {{-- <hr class="color-red-100 my-2"> --}}
                        <div class="border-t border-red-500"></div>

                        <!-- Logout -->
                        <form action="{{ route('logout') }}" method="POST" class="px-4 py-2">
                            @csrf
                            <button type="submit"
                                class="flex items-center gap-3 w-full text-left text-sm text-red-600 hover:bg-red-50 px-0 py-1.5 rounded-lg transition-colors cursor-pointer">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                </svg>
                                Logout
                            </button>
                        </form>
                    </div>
                </div>
            </nav>
            <div class="md:hidden flex items-center gap-3">
                <button id="mobile-menu-button"
                    class="text-gray-700 hover:text-red-500 transition-colors cursor-pointer">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div id="mobile-menu" class="md:hidden mt-4 border-t border-gray-200">
            <nav class="flex flex-col space-y-2 md:space-y-3">
                <!-- User Info Mobile -->
                <a href="{{ route('profile.show') }}">
                    <div
                        class="px-3 py-3 bg-gradient-to-r from-red-50 to-orange-50 rounded-lg mb-2 flex items-center gap-3">
                        <!-- User Profile Image -->
                        <div
                            class="w-12 h-12 rounded-full bg-white flex items-center justify-center overflow-hidden border-2 border-red-200 shadow-sm flex-shrink-0">
                            @if (Auth::user()->profile_image_path)
                                <img src="{{ asset('storage/' . Auth::user()->profile_image_path) }}"
                                    alt="{{ Auth::user()->name }}" class="w-full h-full object-cover">
                            @else
                                <img src="{{ asset('assets/profile.svg') }}" alt="Default Profile"
                                    class="w-7 h-7 text-red-500">
                            @endif
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-semibold text-gray-900 truncate">{{ Auth::user()->name ?? 'User' }}
                            </p>
                            <p class="text-xs text-gray-500 truncate">{{ Auth::user()->email ?? 'user@example.com' }}
                            </p>
                        </div>
                    </div>
                </a>

                <a href="/"
                    class="nav-link {{ request()->is('/') ? 'text-red-500' : 'text-gray-700 hover:text-red-500' }} font-medium transition-all px-3 py-2 rounded-lg hover:bg-gray-50 flex items-center gap-2">
                    <svg class="w-5 h-5 nav-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                    </svg>
                    Home
                </a>
                <a href="/about"
                    class="nav-link {{ request()->is('about') ? 'text-red-500' : 'text-gray-700 hover:text-red-500' }} font-medium transition-all px-3 py-2 rounded-lg hover:bg-gray-50 flex items-center gap-2">
                    <svg class="w-5 h-5 nav-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    About
                </a>
                <a href="/donate"
                    class="nav-link {{ request()->is('donate') ? 'text-red-500' : 'text-gray-700 hover:text-red-500' }} font-medium transition-all px-3 py-2 rounded-lg hover:bg-gray-50 flex items-center gap-2">
                    <svg class="w-5 h-5 nav-icon" fill="currentColor" viewBox="0 0 24 24">
                        <path
                            d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z" />
                    </svg>
                    Donate
                </a>
                <a href="/request"
                    class="nav-link {{ request()->is('request') ? 'text-red-500' : 'text-gray-700 hover:text-red-500' }} font-medium transition-all px-3 py-2 rounded-lg hover:bg-gray-50 flex items-center gap-2">
                    <svg class="w-5 h-5 nav-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                    </svg>
                    Request
                </a>
                <a href="/contact"
                    class="nav-link {{ request()->is('contact') ? 'text-red-500' : 'text-gray-700 hover:text-red-500' }} font-medium transition-all px-3 py-2 rounded-lg hover:bg-gray-50 flex items-center gap-2">
                    <svg class="w-5 h-5 nav-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                    </svg>
                    Contact
                </a>

                <!-- Divider -->
                <div class="border-t border-gray-200 my-2"></div>

                <!-- Profile Links -->
                {{-- <a href="{{ route('profile.show') }}"
                    class="nav-link text-gray-700 hover:text-red-500 font-medium transition-all px-3 py-2 rounded-lg hover:bg-gray-50 flex items-center gap-2">
                    <svg class="w-5 h-5 nav-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                    My Profile
                </a> --}}
                <!-- Logout Button Mobile -->
                <form action="{{ route('logout') }}" method="POST" class="m-2">
                    @csrf
                    <button type="submit"
                        class="w-full text-left font-medium transition-all p-2 my-2 rounded-full flex items-center gap-2 bg-red-500 text-white hover:bg-red-600">
                        <svg class="w-5 h-5 nav-icon" fill="none" stroke="currentColor" stroke-width="2"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                        </svg>
                        Logout
                    </button>
                </form>
            </nav>
        </div>
    </div>
</header>
