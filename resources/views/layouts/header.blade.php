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
                <a href="#"
                    class="nav-link text-gray-700 hover:text-red-500 font-medium transition-all">Contact</a>
                <a href="/login"
                    class="inline-flex items-center gap-2 rounded-full px-5 py-2.5 text-sm font-semibold shadow-sm transition-all
                    {{ request()->is('login') ? 'bg-red-500 text-white shadow-red-200' : 'bg-red-500 text-white hover:bg-red-600' }}">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M15 3h4a2 2 0 012 2v4M15 21h4a2 2 0 002-2v-4M3 9V5a2 2 0 012-2h4M3 15v4a2 2 0 002 2h4" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10 9l2 2-2 2m2-2H3" />
                    </svg>
                    Login
                </a>
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
                <a href="#"
                    class="nav-link text-gray-700 hover:text-red-500 font-medium transition-all px-3 py-2 rounded-lg hover:bg-gray-50 flex items-center gap-2">
                    <svg class="w-5 h-5 nav-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                    </svg>
                    Contact
                </a>
                <a href="/login"
                    class="font-medium transition-all px-3 py-2 rounded-lg flex items-center gap-2 {{ request()->is('login') ? 'bg-red-500 text-white shadow-red-200' : 'bg-red-500 text-white hover:bg-red-600' }}">
                    <svg class="w-5 h-5 nav-icon" fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 3h4a2 2 0 012 2v4" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 21h4a2 2 0 002-2v-4" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 9V5a2 2 0 012-2h4" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 15v4a2 2 0 002 2h4" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10 9l2 2-2 2m2-2H3" />
                    </svg>
                    Login
                </a>
            </nav>
        </div>
    </div>
</header>
