<header class="bg-white shadow-[0_0.125rem_0.25rem_rgba(0,0,0,0.1)] fixed w-full z-[50]">
    <div class="container mx-auto px-[0.75rem]">
        <nav class="relative flex justify-between items-center py-[0.5rem]">
            <!-- Logo -->
            <a href="{{ url('/') }}" class="flex items-center ml-8">
                <img src="https://c.animaapp.com/knqlfAnT/img/tak-berjudul1-20250312112214-1@2x.png" alt="Insphony Logo" class="w-[7rem] md:w-[9rem] h-auto hover:opacity-80 transition-opacity duration-200" />
            </a>

            <!-- Desktop Navigation - Centered -->
            <div class="hidden lg:flex items-center justify-center flex-1">
                <ul class="flex gap-[1.25rem] xl:gap-[1.75rem]">
                    <li>
                        <a href="#home" class="text-[0.875rem] font-medium text-primary hover:text-primary transition-colors duration-200 relative group nav-link">
                            Beranda
                            <span class="absolute bottom-[-0.2rem] left-0 w-1/2 h-[0.1rem] bg-primary transform scale-x-0 transition-transform duration-300 ease-in-out origin-left group-hover:scale-x-100"></span>
                        </a>
                    </li>
                    <li>
                        <a href="#produk" class="text-[0.875rem] font-medium text-gray-700 hover:text-primary transition-colors duration-200 relative group nav-link">
                            Produk
                            <span class="absolute bottom-[-0.2rem] left-0 w-1/2 h-[0.1rem] bg-primary transform scale-x-0 transition-transform duration-300 ease-in-out origin-left group-hover:scale-x-100"></span>
                        </a>
                    </li>
                    <li>
                        <a href="#syarat" class="text-[0.875rem] font-medium text-gray-700 hover:text-primary transition-colors duration-200 relative group nav-link">
                            Syarat
                            <span class="absolute bottom-[-0.2rem] left-0 w-1/2 h-[0.1rem] bg-primary transform scale-x-0 transition-transform duration-300 ease-in-out origin-left group-hover:scale-x-100"></span>
                        </a>
                    </li>
                    <li>
                        <a href="#ulasan" class="text-[0.875rem] font-medium text-gray-700 hover:text-primary transition-colors duration-200 relative group nav-link">
                            Ulasan
                            <span class="absolute bottom-[-0.2rem] left-0 w-1/2 h-[0.1rem] bg-primary transform scale-x-0 transition-transform duration-300 ease-in-out origin-left group-hover:scale-x-100"></span>
                        </a>
                    </li>
                    <li>
                        <a href="#kontak" class="text-[0.875rem] font-medium text-gray-700 hover:text-primary transition-colors duration-200 relative group nav-link">
                            Kontak
                            <span class="absolute bottom-[-0.2rem] left-0 w-1/2 h-[0.1rem] bg-primary transform scale-x-0 transition-transform duration-300 ease-in-out origin-left group-hover:scale-x-100"></span>
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Desktop Buttons - Right Aligned -->
            <div class="hidden lg:flex gap-[0.5rem]">
                @auth
                    <!-- Jika sudah login -->
                    <div data-tooltip-target="tooltip-keranjang" data-tooltip-placement="bottom">
                        <a href="/keranjang" class="p-[0.5rem] rounded-[0.375rem] transition-colors duration-200 hover:scale-[1.05] transform inline-flex items-center justify-center">
                            <svg class="w-[2.2rem] h-[2.2rem] text-primary" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M5 4h1.5L9 16m0 0h8m-8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm-8.5-3h9.25L19 7H7.312"/>
                            </svg>
                        </a>
                    </div>
                    <div class="relative group">
                        <button id="user-menu-button" class="p-[0.5rem] text-primary hover:text-primary-dark transition-colors duration-200 flex items-center gap-[0.2rem]">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-[2rem] h-[2rem]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                        </button>
                        <!-- Dropdown Profil -->
                        <div id="user-dropdown" class="absolute hidden right-0 mt-[0.5rem] w-[11rem] bg-white border border-gray-200 rounded-[0.375rem] shadow-[0_0.25rem_0.75rem_rgba(0,0,0,0.1)] z-[50]">
                            <div class="px-[0.875rem] py-[0.5rem] text-gray-700 font-medium border-b border-gray-200">{{ Auth::user()->name }}</div>
                            <a href="/profil" class="block px-[0.875rem] py-[0.5rem] text-gray-700 hover:bg-gray-50">Profil Saya</a>
                            <a href="/pesanan" class="block px-[0.875rem] py-[0.5rem] text-gray-700 hover:bg-gray-50">Pesanan Saya</a>
                            <form action="{{ route('logout') }}" method="POST" class="border-t border-gray-200">
                                @csrf
                                <button type="submit" class="w-full text-left px-[0.875rem] py-[0.5rem] text-gray-700 hover:bg-gray-50">Logout</button>
                            </form>
                        </div>
                    </div>
                @else
                    <!-- Jika belum login -->
                    <a href="{{ route('login') }}" class="px-[0.875rem] py-[0.5rem] bg-primary text-white rounded-[0.375rem] hover:bg-primary-dark transition-colors duration-200 text-[0.875rem]">Masuk</a>
                    <a href="{{ route('register') }}" class="px-[0.875rem] py-[0.5rem] border border-primary text-primary bg-white rounded-[0.375rem] hover:bg-gray-50 transition-colors duration-200 text-[0.875rem]">Daftar</a>
                @endauth
            </div>

            <!-- Mobile Menu Button -->
            <div class="lg:hidden flex items-center gap-[0.5rem]">
                @auth
                    <div data-tooltip-target="tooltip-keranjang-mobile" data-tooltip-placement="bottom">
                        <a href="/keranjang" class="p-[0.5rem] rounded-[0.375rem] transition-colors duration-200 hover:scale-[1.05] transform inline-flex items-center justify-center">
                            <svg class="w-[1.5rem] h-[1.5rem] text-primary" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M5 4h1.5L9 16m0 0h8m-8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm-8.5-3h9.25L19 7H7.312"/>
                            </svg>
                        </a>
                    </div>
                @else
                    <a href="{{ route('login') }}" class="p-[0.5rem] text-gray-700 hover:text-primary">
                        <svg xmlns="http://www.w3.org/2000/svg " class="w-[1.25rem] h-[1.25rem]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                    </a>
                @endauth
                
                <button id="mobile-menu-button" class="text-gray-700 hover:text-primary focus:outline-none p-[0.5rem]">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-[1.25rem] h-[1.25rem] text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
            </div>
        </nav>
    </div>

    <!-- Mobile Menu -->
    <div id="mobile-menu" class="hidden lg:hidden fixed inset-0 bg-gray-800/75 z-[40] transition-opacity duration-200">
        <div class="fixed inset-y-0 right-0 max-w-[16rem] w-full bg-white shadow-[0_0.25rem_0.75rem_rgba(0,0,0,0.1)] transform transition-transform duration-200 ease-in-out">
            <div class="flex justify-between items-center px-[0.875rem] py-[0.5rem] border-b border-gray-200">
                <div class="text-[1rem] font-semibold text-gray-900">Menu</div>
                <button id="close-mobile-menu" class="text-gray-500 hover:text-gray-700 p-[0.375rem]">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-[1.125rem] h-[1.125rem]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <div class="px-[0.5rem] py-[0.5rem] overflow-y-auto max-h-[calc(100vh-3rem)]">
                <ul class="space-y-[0.2rem]">
                    <li>
                        <a href="#home" class="block px-[0.625rem] py-[0.625rem] text-[0.875rem] text-gray-700 hover:text-primary hover:bg-gray-50 rounded-[0.25rem] mobile-nav-link">Beranda</a>
                    </li>
                    <li>
                        <a href="#produk" class="block px-[0.625rem] py-[0.625rem] text-[0.875rem] text-gray-700 hover:text-primary hover:bg-gray-50 rounded-[0.25rem] mobile-nav-link">Produk</a>
                    </li>
                    <li>
                        <a href="#syarat" class="block px-[0.625rem] py-[0.625rem] text-[0.875rem] text-gray-700 hover:text-primary hover:bg-gray-50 rounded-[0.25rem] mobile-nav-link">Syarat</a>
                    </li>
                    <li>
                        <a href="#ulasan" class="block px-[0.625rem] py-[0.625rem] text-[0.875rem] text-gray-700 hover:text-primary hover:bg-gray-50 rounded-[0.25rem] mobile-nav-link">Ulasan</a>
                    </li>
                    <li>
                        <a href="#kontak" class="block px-[0.625rem] py-[0.625rem] text-[0.875rem] text-gray-700 hover:text-primary hover:bg-gray-50 rounded-[0.25rem] mobile-nav-link">Kontak</a>
                    </li>
                </ul>
                
                <div class="mt-[0.5rem] pt-[0.5rem] border-t border-gray-200">
                    @auth
                        <div class="px-[0.625rem] py-[0.375rem] text-[0.875rem] text-gray-700 font-medium truncate">{{ Auth::user()->name }}</div>
                        <a href="/profil" class="block px-[0.625rem] py-[0.5rem] text-[0.875rem] text-gray-700 hover:text-primary hover:bg-gray-50 rounded-[0.25rem]">Profil Saya</a>
                        <a href="/pesanan" class="block px-[0.625rem] py-[0.5rem] text-[0.875rem] text-gray-700 hover:text-primary hover:bg-gray-50 rounded-[0.25rem]">Pesanan Saya</a>
                        <form action="{{ route('logout') }}" method="POST" class="px-[0.625rem] py-[0.5rem]">
                            @csrf
                            <button type="submit" class="w-full text-left text-[0.875rem] text-gray-700 hover:text-primary">Logout</button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="block px-[0.625rem] py-[0.5rem] text-[0.875rem] bg-primary text-white rounded-[0.375rem] hover:bg-primary-dark transition-colors duration-200 mx-[0.125rem] text-center">Masuk</a>
                        <a href="{{ route('register') }}" class="block px-[0.625rem] py-[0.5rem] text-[0.875rem] border border-primary text-primary bg-white rounded-[0.375rem] hover:bg-gray-50 transition-colors duration-200 mx-[0.125rem] mt-[0.375rem] text-center">Daftar</a>
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