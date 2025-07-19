<header class="bg-white shadow-[0_0.125rem_0.25rem_rgba(0,0,0,0.1)] fixed w-full z-50">
    <div class="max-w-screen-xxl mx-auto px-4 sm:px-6 lg:px-8 2xl:px-10">
        <nav class="relative flex justify-between items-center py-2 sm:py-3">
            <!-- Logo dengan penyesuaian responsif -->
            <a href="{{ url('/') }}" class="flex items-center min-w-[5rem] xs:min-w-[6rem] sm:min-w-[7rem] md:min-w-[9rem]">
                <img src="/logo-insphony.png" 
                     alt="Insphony Logo" 
                     class="w-20 xs:w-24 sm:w-28 md:w-36 h-auto hover:opacity-80 transition-opacity duration-200" />
            </a>
            @unless(request()->is('products/*') || request()->is('products') || request()->is('penyewaan/form*') || request()->is('profile') || request()->is('riwayat'))
            <!-- Desktop Navigation - Centered -->
            <div class="hidden lg:flex items-center justify-center flex-1 mx-2 xl:mx-4">
                <ul class="flex gap-3 sm:gap-4 xl:gap-6 2xl:gap-8">
                    <li>
                        <a href="#home" class="text-xs sm:text-sm font-medium text-primary hover:text-primary transition-colors duration-200 relative group nav-link">
                            Beranda
                            <span class="absolute bottom-[-0.15rem] sm:bottom-[-0.2rem] left-0 w-1/2 h-[0.1rem] bg-primary transform scale-x-0 transition-transform duration-300 ease-in-out origin-left group-hover:scale-x-100"></span>
                        </a>
                    </li>
                    <li>
                        <a href="#produk" class="text-xs sm:text-sm font-medium text-gray-700 hover:text-primary transition-colors duration-200 relative group nav-link">
                            Produk
                            <span class="absolute bottom-[-0.15rem] sm:bottom-[-0.2rem] left-0 w-1/2 h-[0.1rem] bg-primary transform scale-x-0 transition-transform duration-300 ease-in-out origin-left group-hover:scale-x-100"></span>
                        </a>
                    </li>
                    <li>
                        <a href="#syarat" class="text-xs sm:text-sm font-medium text-gray-700 hover:text-primary transition-colors duration-200 relative group nav-link">
                            Syarat
                            <span class="absolute bottom-[-0.15rem] sm:bottom-[-0.2rem] left-0 w-1/2 h-[0.1rem] bg-primary transform scale-x-0 transition-transform duration-300 ease-in-out origin-left group-hover:scale-x-100"></span>
                        </a>
                    </li>
                    <li>
                        <a href="#ulasan" class="text-xs sm:text-sm font-medium text-gray-700 hover:text-primary transition-colors duration-200 relative group nav-link">
                            Ulasan
                            <span class="absolute bottom-[-0.15rem] sm:bottom-[-0.2rem] left-0 w-1/2 h-[0.1rem] bg-primary transform scale-x-0 transition-transform duration-300 ease-in-out origin-left group-hover:scale-x-100"></span>
                        </a>
                    </li>
                    <li>
                        <a href="#kontak" class="text-xs sm:text-sm font-medium text-gray-700 hover:text-primary transition-colors duration-200 relative group nav-link">
                            Kontak
                            <span class="absolute bottom-[-0.15rem] sm:bottom-[-0.2rem] left-0 w-1/2 h-[0.1rem] bg-primary transform scale-x-0 transition-transform duration-300 ease-in-out origin-left group-hover:scale-x-100"></span>
                        </a>
                    </li>
                </ul>
            </div>
            @endunless

            <!-- Desktop Buttons - Right Aligned dengan penyesuaian responsif -->
            <div class="hidden lg:flex gap-2 min-w-[10rem] sm:min-w-[12rem] justify-end">
                @auth
                    <div class="relative group">
                        <button id="user-menu-button" class="flex items-center gap-1.5 sm:gap-2 p-1 rounded-full hover:bg-gray-100 transition-colors duration-200">
                            <div class="w-7 h-7 sm:w-8 sm:h-8 rounded-full bg-gradient-to-br from-primary to-primary-dark flex items-center justify-center text-white overflow-hidden">
                                @if(Auth::user()->foto_profil)
                                    <img src="{{ asset(Auth::user()->foto_profil) }}" alt="Profile" class="w-full h-full object-cover">
                                @else
                                    <span class="text-xs sm:text-sm font-medium">
                                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                                    </span>
                                @endif
                            </div>
                            <span class="text-xs sm:text-sm font-medium text-gray-700">{{ Auth::user()->name }}</span>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5 sm:h-4 sm:w-4 text-gray-500 transition-transform duration-200 group-hover:rotate-180" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </button>
                        
                        <div id="user-dropdown" class="absolute hidden right-0 mt-2 w-48 sm:w-56 bg-white border border-gray-200 rounded-md shadow-lg z-50 divide-y divide-gray-100">
                            <div class="px-3 sm:px-4 py-2 sm:py-3">
                                <div class="text-sm font-medium text-gray-900 truncate">{{ Auth::user()->name }}</div>
                                <div class="text-xs text-gray-500 truncate">{{ Auth::user()->email }}</div>
                            </div>
                            
                            <div class="py-1">
                                <a href="{{ route('profile') }}" class="flex items-center px-3 sm:px-4 py-1.5 sm:py-2 text-xs sm:text-sm text-gray-700 hover:bg-gray-50 hover:text-gray-900 transition-colors duration-150">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5 sm:h-4 sm:w-4 mr-1.5 sm:mr-2 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                    Informasi Pribadi
                                </a>
                                <a href="{{ route('riwayat') }}" class="flex items-center px-3 sm:px-4 py-1.5 sm:py-2 text-xs sm:text-sm text-gray-700 hover:bg-gray-50 hover:text-gray-900 transition-colors duration-150">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5 sm:h-4 sm:w-4 mr-1.5 sm:mr-2 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                    </svg>
                                    Riwayat Sewa
                                </a>
                            </div>
                            
                            <div class="py-1">
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="flex items-center w-full px-3 sm:px-4 py-1.5 sm:py-2 text-xs sm:text-sm text-gray-700 hover:bg-gray-50 hover:text-gray-900 transition-colors duration-150 text-left">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5 sm:h-4 sm:w-4 mr-1.5 sm:mr-2 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                        </svg>
                                        Keluar
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @else
                    <a href="{{ route('login') }}" class="px-2.5 sm:px-3.5 py-1.5 sm:py-2 bg-primary text-white rounded-md hover:bg-primary-dark transition-colors duration-200 text-xs sm:text-sm flex items-center whitespace-nowrap">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5 sm:h-4 sm:w-4 mr-0.5 sm:mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
                        </svg>
                        Masuk
                    </a>
                    <a href="{{ route('register') }}" class="px-2.5 sm:px-3.5 py-1.5 sm:py-2 border border-primary text-primary bg-white rounded-md hover:bg-gray-50 transition-colors duration-200 text-xs sm:text-sm flex items-center whitespace-nowrap">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5 sm:h-4 sm:w-4 mr-0.5 sm:mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                        </svg>
                        Daftar
                    </a>
                @endauth
            </div>

            <!-- Mobile Menu Button -->
            <div class="lg:hidden flex items-center gap-1 sm:gap-2">
                @auth
                @else
                @endauth
                
                <button id="mobile-menu-button" class="text-gray-700 hover:text-primary focus:outline-none p-1 sm:p-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
            </div>
        </nav>
    </div>

    <!-- Mobile Menu -->
    <div id="mobile-menu" class="hidden lg:hidden fixed inset-0 bg-gray-800/75 z-40 transition-opacity duration-200 ease-in-out">
        <div class="fixed inset-y-0 right-0 w-full max-w-xs bg-white shadow-xl transform transition-transform duration-300 ease-in-out translate-x-full" id="mobile-menu-content">
            <div class="flex justify-between items-center px-4 py-3 border-b border-gray-200">
                <div class="text-base font-semibold text-gray-900">Menu</div>
                <button id="close-mobile-menu" class="text-gray-500 hover:text-gray-700 p-1 rounded-full hover:bg-gray-100 transition-colors duration-200">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <div class="px-2 py-2 overflow-y-auto h-[calc(100vh-3.5rem)]">
                @auth
                    <div class="px-3 py-3 border-b border-gray-200">
                        <div class="flex items-center gap-3">
                            <div class="w-9 h-9 sm:w-10 sm:h-10 rounded-full bg-gradient-to-br from-primary to-primary-dark flex items-center justify-center text-white overflow-hidden">
                               @if(Auth::user()->foto_profil)
                                    <img src="{{ asset(Auth::user()->foto_profil) }}" alt="Profile" class="w-full h-full object-cover">
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
                        <a href="#home" class="block px-3 py-2 text-sm sm:text-base text-gray-700 hover:text-primary hover:bg-gray-50 rounded-md mobile-nav-link transition-colors duration-200">Beranda</a>
                    </li>
                    <li>
                        <a href="#produk" class="block px-3 py-2 text-sm sm:text-base text-gray-700 hover:text-primary hover:bg-gray-50 rounded-md mobile-nav-link transition-colors duration-200">Produk</a>
                    </li>
                    <li>
                        <a href="#syarat" class="block px-3 py-2 text-sm sm:text-base text-gray-700 hover:text-primary hover:bg-gray-50 rounded-md mobile-nav-link transition-colors duration-200">Syarat</a>
                    </li>
                    <li>
                        <a href="#ulasan" class="block px-3 py-2 text-sm sm:text-base text-gray-700 hover:text-primary hover:bg-gray-50 rounded-md mobile-nav-link transition-colors duration-200">Ulasan</a>
                    </li>
                    <li>
                        <a href="#kontak" class="block px-3 py-2 text-sm sm:text-base text-gray-700 hover:text-primary hover:bg-gray-50 rounded-md mobile-nav-link transition-colors duration-200">Kontak</a>
                    </li>
                </ul>
                
                <div class="mt-2 pt-2 border-t border-gray-200">
                    @auth
                        <a href="{{ route('profile') }}" class="block px-3 py-2 text-sm sm:text-base text-gray-700 hover:text-primary hover:bg-gray-50 rounded-md flex items-center transition-colors duration-200">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 sm:h-5 sm:w-5 mr-2 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                            Informasi Pribadi
                        </a>
                        <a href="{{ route('riwayat') }}" class="block px-3 py-2 text-sm sm:text-base text-gray-700 hover:text-primary hover:bg-gray-50 rounded-md flex items-center transition-colors duration-200">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 sm:h-5 sm:w-5 mr-2 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                            </svg>
                            Riwayat sewa
                        </a>
                        <form action="{{ route('logout') }}" method="POST" class="px-3 py-2">
                            @csrf
                            <button type="submit" class="w-full text-left text-sm sm:text-base text-gray-700 hover:text-primary flex items-center transition-colors duration-200">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 sm:h-5 sm:w-5 mr-2 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                </svg>
                                Keluar
                            </button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="block px-3 py-2 mx-1 my-1 text-sm sm:text-base bg-primary text-white rounded-md hover:bg-primary-dark transition-colors duration-200 text-center flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 sm:h-5 sm:w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
                            </svg>
                            Masuk
                        </a>
                        <a href="{{ route('register') }}" class="block px-3 py-2 mx-1 my-1 text-sm sm:text-base border border-primary text-primary bg-white rounded-md hover:bg-gray-50 transition-colors duration-200 text-center flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 sm:h-5 sm:w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
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
        // Mobile menu toggle dengan animasi
        const mobileMenuButton = document.getElementById('mobile-menu-button');
        const mobileMenu = document.getElementById('mobile-menu');
        const mobileMenuContent = document.getElementById('mobile-menu-content');
        const closeMobileMenu = document.getElementById('close-mobile-menu');
        
        mobileMenuButton.addEventListener('click', function() {
            mobileMenu.classList.remove('hidden');
            document.body.style.overflow = 'hidden';
            // Trigger reflow untuk memastikan animasi berjalan
            void mobileMenuContent.offsetWidth;
            mobileMenuContent.classList.remove('translate-x-full');
        });
        
        closeMobileMenu.addEventListener('click', function() {
            mobileMenuContent.classList.add('translate-x-full');
            setTimeout(() => {
                mobileMenu.classList.add('hidden');
                document.body.style.overflow = '';
            }, 300);
        });
        
        // Close mobile menu when clicking on backdrop
        mobileMenu.addEventListener('click', function(e) {
            if (e.target === mobileMenu) {
                mobileMenuContent.classList.add('translate-x-full');
                setTimeout(() => {
                    mobileMenu.classList.add('hidden');
                    document.body.style.overflow = '';
                }, 300);
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
            
            // Tutup mobile menu dengan animasi
            if (!mobileMenu.classList.contains('hidden')) {
                mobileMenuContent.classList.add('translate-x-full');
                setTimeout(() => {
                    mobileMenu.classList.add('hidden');
                    document.body.style.overflow = '';
                }, 300);
            }
            
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

        // Handle resize events
        let resizeTimer;
        window.addEventListener('resize', function() {
            clearTimeout(resizeTimer);
            resizeTimer = setTimeout(function() {
                // Update active link on resize to account for position changes
                handleScroll();
            }, 250);
        });
    });
</script>

<style>
    /* Responsive adjustments */
    @media (max-width: 1536px) {
        .max-w-screen-xxl {
            max-width: 1280px;
        }
    }

    @media (max-width: 1280px) {
        .max-w-screen-xxl {
            max-width: 1024px;
        }
    }

    @media (max-width: 1024px) {
        .max-w-screen-xxl {
            max-width: 100%;
            padding-left: 1rem;
            padding-right: 1rem;
        }
    }

    /* Tablet styles (768px - 1023px) */
    @media (min-width: 768px) and (max-width: 1023px) {
        nav {
            padding-top: 0.75rem;
            padding-bottom: 0.75rem;
        }
        
        #mobile-menu-content {
            max-width: 20rem;
        }
    }

    /* Mobile styles (up to 767px) */
    @media (max-width: 767px) {
        nav {
            padding-top: 0.5rem;
            padding-bottom: 0.5rem;
        }
        
        #mobile-menu-content {
            max-width: 18rem;
        }
        
        .min-w-\[5rem\] {
            min-width: 4rem !important;
        }
    }

    /* Very small mobile devices (up to 375px) */
    @media (max-width: 375px) {
        #mobile-menu-content {
            max-width: 16rem;
        }
        
        .min-w-\[5rem\] {
            min-width: 3.5rem !important;
        }
    }

    /* Animation for mobile menu */
    #mobile-menu-content {
        transition: transform 0.3s ease-in-out;
    }
    
    #mobile-menu-content.translate-x-full {
        transform: translateX(100%);
    }
    
    #mobile-menu-content:not(.translate-x-full) {
        transform: translateX(0);
    }

    /* Improve performance for animations */
    .transition-colors, .transition-opacity, .transition-transform {
        will-change: transform, opacity, color;
    }
</style>