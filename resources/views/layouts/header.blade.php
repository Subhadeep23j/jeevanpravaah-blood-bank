<header id="main-navbar" class="navbar-fixed">
    <div class="max-w-9xl px-4 py-1 md:px-6 md:py-2">
        <div class="flex justify-between items-center">

            <!-- Logo -->
            <a href="{{ Route::has('home') ? route('home') : '/' }}"
                class="cursor-pointer hover:opacity-80 transition-opacity">
                <div class="flex items-center space-x-3">
                    <div
                        class="w-7 h-7 md:w-8 md:h-8 bg-gradient-to-br from-red-500 to-red-600 rounded-full flex items-center justify-center">
                        <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z" />
                        </svg>
                    </div>
                    <h1 class="text-xl md:text-2xl font-bold text-gray-800">JeevanPravaah</h1>
                </div>
            </a>

            <!-- Desktop Menu -->
            <nav class="hidden md:flex space-x-8 items-center">

                @php
                    $links = [
                        '/' => 'Home',
                        'about' => 'About',
                        'donate' => 'Donate',
                        'request' => 'Request',
                        'contact' => 'Contact',
                    ];
                @endphp

                @foreach ($links as $url => $label)
                    <a href="/{{ $url === '/' ? '' : $url }}"
                        class="relative font-medium py-1 transition-colors
                        after:content-[''] after:absolute after:left-1/2 after:-translate-x-1/2
                        after:bottom-0 after:h-[2px] after:bg-red-500
                        after:w-0 after:transition-all after:duration-300
                        hover:text-red-500 hover:after:w-full
                        {{ request()->is($url) ? 'text-red-500 after:w-full' : 'text-gray-700' }}">
                        {{ $label }}
                    </a>
                @endforeach

                <!-- AUTH SECTION -->
                @auth
                    <a href="/profile" class="font-medium text-gray-700 hover:text-red-500 transition">
                        {{ auth()->user()->first_name ?? auth()->user()->name }}
                    </a>

                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit"
                            class="px-5 py-2 rounded-full bg-red-500 text-white hover:bg-red-600 transition">
                            Logout
                        </button>
                    </form>
                @else
                    <a href="/login" class="px-5 py-2 rounded-full bg-red-500 text-white hover:bg-red-600 transition">
                        Login
                    </a>
                @endauth
            </nav>

            <!-- Mobile Button -->
            <button id="mobile-menu-button" class="md:hidden text-gray-700 hover:text-red-500 transition">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-width="2" stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>
        </div>

        <!-- Mobile Menu (Animated) -->
        <div id="mobile-menu"
            class="md:hidden overflow-hidden max-h-0 opacity-0
            transition-all duration-300 ease-out">

            <nav class="flex flex-col pt-4 space-y-2 border-t border-gray-200">
                @foreach ($links as $url => $label)
                    <a href="/{{ $url === '/' ? '' : $url }}"
                        class="px-3 py-2 rounded-lg font-medium
                        {{ request()->is($url) ? 'text-red-500 bg-red-50' : 'text-gray-700 hover:bg-gray-50' }}">
                        {{ $label }}
                    </a>
                @endforeach

                @auth
                    <a href="/profile" class="px-3 py-2 rounded-lg text-gray-700 hover:bg-gray-50">
                        {{ auth()->user()->first_name ?? auth()->user()->name }}
                    </a>

                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="w-full text-left px-3 py-2 rounded-lg text-gray-700 hover:bg-gray-50">
                            Logout
                        </button>
                    </form>
                @else
                    <a href="/login"
                        class="mt-2 px-4 py-2 rounded-lg bg-red-500 text-white text-center hover:bg-red-600 transition">
                        Login
                    </a>
                @endauth
            </nav>
        </div>
    </div>
</header>

<!-- MOBILE MENU SCRIPT (WITH ANIMATION) -->
<script>
    const menuBtn = document.getElementById('mobile-menu-button');
    const mobileMenu = document.getElementById('mobile-menu');

    let isOpen = false;

    menuBtn.addEventListener('click', () => {
        isOpen = !isOpen;

        if (isOpen) {
            mobileMenu.classList.remove('max-h-0', 'opacity-0');
            mobileMenu.classList.add('max-h-[500px]', 'opacity-100');
        } else {
            mobileMenu.classList.add('max-h-0', 'opacity-0');
            mobileMenu.classList.remove('max-h-[500px]', 'opacity-100');
        }
    });
</script>
