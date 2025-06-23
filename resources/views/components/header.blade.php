<header class="bg-white shadow-[0_0.125rem_0.25rem_rgba(0,0,0,0.1)] fixed w-full z-[50]">
    <div class="container mx-auto px-4">
        <nav class="relative flex justify-between items-center py-3">
            <!-- Logo -->
            <a href="{{ url('/') }}" class="flex items-center">
                <img src="https://c.animaapp.com/knqlfAnT/img/tak-berjudul1-20250312112214-1@2x.png" alt="Insphony Logo" class="w-28 md:w-36 h-auto hover:opacity-80 transition-opacity duration-200" />
            </a>

            <!-- Desktop Navigation - Centered -->
            <div class="hidden lg:flex items-center justify-center flex-1">
                <ul class="flex gap-5 xl:gap-7">
                    <li>
                        <a href="#home" class="text-sm font-medium text-primary hover:text-primary transition-colors duration-200 relative group nav-link">
                            Beranda
                            <span class="absolute bottom-[-0.2rem] left-0 w-1/2 h-[0.1rem] bg-primary transform scale-x-0 transition-transform duration-300 ease-in-out origin-left group-hover:scale-x-100"></span>
                        </a>
                    </li>
                    <li>
                        <a href="#produk" class="text-sm font-medium text-gray-700 hover:text-primary transition-colors duration-200 relative group nav-link">
                            Produk
                            <span class="absolute bottom-[-0.2rem] left-0 w-1/2 h-[0.1rem] bg-primary transform scale-x-0 transition-transform duration-300 ease-in-out origin-left group-hover:scale-x-100"></span>
                        </a>
                    </li>
                    <li>
                        <a href="#syarat" class="text-sm font-medium text-gray-700 hover:text-primary transition-colors duration-200 relative group nav-link">
                            Syarat
                            <span class="absolute bottom-[-0.2rem] left-0 w-1/2 h-[0.1rem] bg-primary transform scale-x-0 transition-transform duration-300 ease-in-out origin-left group-hover:scale-x-100"></span>
                        </a>
                    </li>
                    <li>
                        <a href="#ulasan" class="text-sm font-medium text-gray-700 hover:text-primary transition-colors duration-200 relative group nav-link">
                            Ulasan
                            <span class="absolute bottom-[-0.2rem] left-0 w-1/2 h-[0.1rem] bg-primary transform scale-x-0 transition-transform duration-300 ease-in-out origin-left group-hover:scale-x-100"></span>
                        </a>
                    </li>
                    <li>
                        <a href="#kontak" class="text-sm font-medium text-gray-700 hover:text-primary transition-colors duration-200 relative group nav-link">
                            Kontak
                            <span class="absolute bottom-[-0.2rem] left-0 w-1/2 h-[0.1rem] bg-primary transform scale-x-0 transition-transform duration-300 ease-in-out origin-left group-hover:scale-x-100"></span>
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Desktop Buttons - Right Aligned -->
            <div class="hidden lg:flex gap-2">
                @auth
                    <!-- Enhanced Profile Dropdown -->
                    <div class="relative group">
                        <button id="user-menu-button" class="flex items-center gap-2 p-1 rounded-full hover:bg-gray-100 transition-colors duration-200">
                            <!-- Profile picture or icon -->
                            <div class="w-8 h-8 rounded-full bg-gradient-to-br from-primary to-primary-dark flex items-center justify-center text-white">
                                @if(Auth::user()->profile_photo_path)
                                    <img src="{{ Auth::user()->profile_photo_path }}" alt="Profile" class="w-full h-full rounded-full object-cover">
                                @else
                                    <span class="text-sm font-medium">
                                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                                    </span>
                                @endif
                            </div>
                            <!-- User name with chevron -->
                            <span class="text-sm font-medium text-gray-700">{{ Auth::user()->name }}</span>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-500 transition-transform duration-200 group-hover:rotate-180" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </button>
                        
                        <!-- Enhanced Dropdown Menu -->
                        <div id="user-dropdown" class="absolute hidden right-0 mt-2 w-56 bg-white border border-gray-200 rounded-md shadow-lg z-50 divide-y divide-gray-100">
                            <!-- User info section -->
                            <div class="px-4 py-3">
                                <div class="text-sm font-medium text-gray-900 truncate">{{ Auth::user()->name }}</div>
                                <div class="text-xs text-gray-500 truncate">{{ Auth::user()->email }}</div>
                            </div>
                            
                            <!-- Menu items -->
                            <div class="py-1">
                                <a href="{{ route('profile') }}" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 hover:text-gray-900 transition-colors duration-150">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                    Profil Saya
                                </a>
                                <a href="{{ route('riwayat') }}" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 hover:text-gray-900 transition-colors duration-150">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                    </svg>
                                    Pesanan Saya
                                </a>
                            </div>
                            
                            <!-- Logout section -->
                            <div class="py-1">
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="flex items-center w-full px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 hover:text-gray-900 transition-colors duration-150 text-left">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                        </svg>
                                        Keluar
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @else
                    <!-- Jika belum login -->
                    <a href="{{ route('login') }}" class="px-3.5 py-2 bg-primary text-white rounded-md hover:bg-primary-dark transition-colors duration-200 text-sm flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
                        </svg>
                        Masuk
                    </a>
                    <a href="{{ route('register') }}" class="px-3.5 py-2 border border-primary text-primary bg-white rounded-md hover:bg-gray-50 transition-colors duration-200 text-sm flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                        </svg>
                        Daftar
                    </a>
                @endauth
            </div>

            <!-- Mobile Menu Button -->
            <div class="lg:hidden flex items-center gap-2">
                @auth
                @else
                @endauth
                
                <button id="mobile-menu-button" class="text-gray-700 hover:text-primary focus:outline-none p-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
            </div>
        </nav>
    </div>

    <!-- Mobile Menu -->
    <div id="mobile-menu" class="hidden lg:hidden fixed inset-0 bg-gray-800/75 z-40 transition-opacity duration-200">
        <div class="fixed inset-y-0 right-0 w-full max-w-xs bg-white shadow-xl transform transition-transform duration-200 ease-in-out">
            <div class="flex justify-between items-center px-4 py-3 border-b border-gray-200">
                <div class="text-base font-semibold text-gray-900">Menu</div>
                <button id="close-mobile-menu" class="text-gray-500 hover:text-gray-700 p-1.5 rounded-full hover:bg-gray-100">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <div class="px-2 py-2 overflow-y-auto h-[calc(100vh-3.5rem)]">
                @auth
                    <div class="px-3 py-4 border-b border-gray-200">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-full bg-gradient-to-br from-primary to-primary-dark flex items-center justify-center text-white">
                                @if(Auth::user()->profile_photo_path)
                                    <img src="{{ Auth::user()->profile_photo_path }}" alt="Profile" class="w-full h-full rounded-full object-cover">
                                @else
                                    <span class="text-sm font-medium">
                                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                                    </span>
                                @endif
                            </div>
                            <div>
                                <div class="text-sm font-medium text-gray-900">{{ Auth::user()->name }}</div>
                                <div class="text-xs text-gray-500">{{ Auth::user()->email }}</div>
                            </div>
                        </div>
                    </div>
                @endauth
                
                <ul class="space-y-1 mt-2">
                    <li>
                        <a href="#home" class="block px-3 py-2.5 text-base text-gray-700 hover:text-primary hover:bg-gray-50 rounded-md mobile-nav-link">Beranda</a>
                    </li>
                    <li>
                        <a href="#produk" class="block px-3 py-2.5 text-base text-gray-700 hover:text-primary hover:bg-gray-50 rounded-md mobile-nav-link">Produk</a>
                    </li>
                    <li>
                        <a href="#syarat" class="block px-3 py-2.5 text-base text-gray-700 hover:text-primary hover:bg-gray-50 rounded-md mobile-nav-link">Syarat</a>
                    </li>
                    <li>
                        <a href="#ulasan" class="block px-3 py-2.5 text-base text-gray-700 hover:text-primary hover:bg-gray-50 rounded-md mobile-nav-link">Ulasan</a>
                    </li>
                    <li>
                        <a href="#kontak" class="block px-3 py-2.5 text-base text-gray-700 hover:text-primary hover:bg-gray-50 rounded-md mobile-nav-link">Kontak</a>
                    </li>
                </ul>
                
                <div class="mt-2 pt-2 border-t border-gray-200">
                    @auth
                        <a href="{{ route('profile') }}" class="block px-3 py-2.5 text-base text-gray-700 hover:text-primary hover:bg-gray-50 rounded-md flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                            Profil Saya
                        </a>
                        <a href="{{ route('riwayat') }}" class="block px-3 py-2.5 text-base text-gray-700 hover:text-primary hover:bg-gray-50 rounded-md flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                            </svg>
                            Pesanan Saya
                        </a>
                        <form action="{{ route('logout') }}" method="POST" class="px-3 py-2.5">
                            @csrf
                            <button type="submit" class="w-full text-left text-base text-gray-700 hover:text-primary flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                </svg>
                                Keluar
                            </button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="block px-3 py-2.5 mx-1 my-1 text-base bg-primary text-white rounded-md hover:bg-primary-dark transition-colors duration-200 text-center flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
                            </svg>
                            Masuk
                        </a>
                        <a href="{{ route('register') }}" class="block px-3 py-2.5 mx-1 my-1 text-base border border-primary text-primary bg-white rounded-md hover:bg-gray-50 transition-colors duration-200 text-center flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                            </svg>
                            Daftar
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </div>
</header>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Mobile menu toggle
        const mobileMenuButton = document.getElementById('mobile-menu-button');
        const mobileMenu = document.getElementById('mobile-menu');
        const closeMobileMenu = document.getElementById('close-mobile-menu');
        
        mobileMenuButton.addEventListener('click', function() {
            mobileMenu.classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        });
        
        closeMobileMenu.addEventListener('click', function() {
            mobileMenu.classList.add('hidden');
            document.body.style.overflow = '';
        });
        
        // Close mobile menu when clicking on backdrop
        mobileMenu.addEventListener('click', function(e) {
            if (e.target === mobileMenu) {
                mobileMenu.classList.add('hidden');
                document.body.style.overflow = '';
            }
        });

        // User dropdown toggle
        const userMenuButton = document.getElementById('user-menu-button');
        const userDropdown = document.getElementById('user-dropdown');
        let isDropdownOpen = false;

        if (userMenuButton && userDropdown) {
            userMenuButton.addEventListener('click', function(e) {
                e.stopPropagation();
                isDropdownOpen = !isDropdownOpen;
                userDropdown.classList.toggle('hidden', !isDropdownOpen);
            });

            document.addEventListener('click', function(e) {
                if (isDropdownOpen && !userDropdown.contains(e.target) && e.target !== userMenuButton) {
                    userDropdown.classList.add('hidden');
                    isDropdownOpen = false;
                }
            });
        }

        // Navigation functions
        function smoothScroll(target) {
            if (target === '#home') {
                window.scrollTo({ top: 0, behavior: 'smooth' });
                return;
            }

            const element = document.querySelector(target);
            if (element) {
                const headerHeight = document.querySelector('header').offsetHeight;
                const elementPosition = element.getBoundingClientRect().top;
                const offsetPosition = elementPosition + window.pageYOffset - headerHeight;
                
                window.scrollTo({ top: offsetPosition, behavior: 'smooth' });
            }
        }

        function updateActiveLink(target) {
            // Update desktop links
            document.querySelectorAll('.nav-link').forEach(link => {
                const isActive = link.getAttribute('href') === target;
                link.classList.toggle('text-primary', isActive);
                link.classList.toggle('text-gray-700', !isActive);
                const span = link.querySelector('span');
                if (span) span.classList.toggle('scale-x-100', isActive);
            });

            // Update mobile links
            document.querySelectorAll('.mobile-nav-link').forEach(link => {
                const isActive = link.getAttribute('href') === target;
                link.classList.toggle('text-primary', isActive);
                link.classList.toggle('bg-gray-50', isActive);
                link.classList.toggle('text-gray-700', !isActive);
            });
        }

        // Handle navigation clicks
        function handleNavClick(e) {
            e.preventDefault();
            const target = this.getAttribute('href');
            
            mobileMenu.classList.add('hidden');
            document.body.style.overflow = '';
            
            smoothScroll(target);
            updateActiveLink(target);
            
            if (history.pushState) {
                history.pushState(null, null, target);
            } else {
                window.location.hash = target;
            }
        }

        document.querySelectorAll('.nav-link, .mobile-nav-link').forEach(link => {
            link.addEventListener('click', handleNavClick);
        });

        // Handle scroll to update active link
        function handleScroll() {
            const scrollPosition = window.scrollY;
            const headerHeight = document.querySelector('header').offsetHeight;
            
            if (scrollPosition < 10) {
                updateActiveLink('#home');
                return;
            }
            
            let foundActive = false;
            document.querySelectorAll('section[id]').forEach(section => {
                const sectionId = section.getAttribute('id');
                const sectionTop = section.offsetTop - headerHeight;
                const sectionHeight = section.offsetHeight;
                
                if (scrollPosition >= sectionTop && scrollPosition < sectionTop + sectionHeight) {
                    updateActiveLink(`#${sectionId}`);
                    foundActive = true;
                }
            });
            
            if (!foundActive) {
                let closestSection = null;
                let smallestDistance = Infinity;
                
                document.querySelectorAll('section[id]').forEach(section => {
                    const sectionId = section.getAttribute('id');
                    const sectionTop = section.offsetTop - headerHeight;
                    const distance = Math.abs(scrollPosition - sectionTop);
                    
                    if (distance < smallestDistance) {
                        smallestDistance = distance;
                        closestSection = `#${sectionId}`;
                    }
                });
                
                if (closestSection) {
                    updateActiveLink(closestSection);
                }
            }
        }

        // Debounce scroll handler
        let isScrolling;
        window.addEventListener('scroll', function() {
            window.clearTimeout(isScrolling);
            isScrolling = setTimeout(handleScroll, 100);
        }, false);

        // Initialize active link
        if (window.location.hash) {
            updateActiveLink(window.location.hash);
            setTimeout(() => {
                smoothScroll(window.location.hash);
            }, 100);
        } else {
            updateActiveLink('#home');
        }
    });
</script>