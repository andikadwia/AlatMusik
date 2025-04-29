<header class="bg-white shadow-md fixed w-full z-50">
    <div class="container mx-auto px-4">
        <nav class="relative flex justify-between items-center py-2">
            <!-- Logo -->
            <a href="{{ url('/') }}" class="flex items-center">
                <img src="https://c.animaapp.com/knqlfAnT/img/tak-berjudul1-20250312112214-1@2x.png" alt="Insphony Logo" class="w-36 md:w-48 h-auto hover:opacity-80 transition-opacity duration-200" />
            </a>

            <!-- Desktop Navigation - Centered -->
            <div class="hidden lg:flex items-center justify-center flex-1">
                <ul class="flex gap-4 xl:gap-8">
                    <li>
                        <a href="#home" class="font-medium text-primary hover:text-primary transition-colors duration-200 relative group nav-link">
                            Beranda
                            <span class="absolute bottom-0 left-0 w-1/2 h-0.5 bg-primary transform scale-x-0 transition-transform duration-300 ease-in-out origin-left group-hover:scale-x-100"></span>
                        </a>
                    </li>
                    <li>
                        <a href="#produk" class="font-medium text-gray-700 hover:text-primary transition-colors duration-200 relative group nav-link">
                            Produk
                            <span class="absolute bottom-0 left-0 w-1/2 h-0.5 bg-primary transform scale-x-0 transition-transform duration-300 ease-in-out origin-left group-hover:scale-x-100"></span>
                        </a>
                    </li>
                    <li>
                        <a href="#syarat" class="font-medium text-gray-700 hover:text-primary transition-colors duration-200 relative group nav-link">
                            Syarat
                            <span class="absolute bottom-0 left-0 w-1/2 h-0.5 bg-primary transform scale-x-0 transition-transform duration-300 ease-in-out origin-left group-hover:scale-x-100"></span>
                        </a>
                    </li>
                    <li>
                        <a href="#ulasan" class="font-medium text-gray-700 hover:text-primary transition-colors duration-200 relative group nav-link">
                            Ulasan
                            <span class="absolute bottom-0 left-0 w-1/2 h-0.5 bg-primary transform scale-x-0 transition-transform duration-300 ease-in-out origin-left group-hover:scale-x-100"></span>
                        </a>
                    </li>
                    <li>
                        <a href="#kontak" class="font-medium text-gray-700 hover:text-primary transition-colors duration-200 relative group nav-link">
                            Kontak
                            <span class="absolute bottom-0 left-0 w-1/2 h-0.5 bg-primary transform scale-x-0 transition-transform duration-300 ease-in-out origin-left group-hover:scale-x-100"></span>
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Desktop Buttons - Right Aligned -->
<div class="hidden lg:flex gap-2">
    @auth
        <!-- Jika sudah login -->
        <div data-tooltip-target="tooltip-keranjang" data-tooltip-placement="bottom">
            <a href="/keranjang" class="p-2 rounded-lg transition-colors duration-200 hover:scale-105 transform inline-flex items-center justify-center">
                <svg class="w-10 h-11 text-primary" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M5 4h1.5L9 16m0 0h8m-8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm-8.5-3h9.25L19 7H7.312"/>
                </svg>
            </a>
        </div>

        <div class="relative group">
    <button id="user-menu-button" class="p-2 text-primary hover:text-primary-dark transition-colors duration-200 flex items-center gap-1">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-9 h-11" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
        </svg>
        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
        </svg>
    </button>
    <!-- Dropdown Profil -->
    <div id="user-dropdown" class="absolute hidden right-0 mt-2 w-48 bg-white border border-gray-200 rounded-lg shadow-lg z-50">
        <div class="px-4 py-2 text-gray-700 font-medium border-b border-gray-200">{{ Auth::user()->name }}</div>
        <a href="/profil" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Profil Saya</a>
        <a href="/pesanan" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Pesanan Saya</a>
        <form action="{{ route('logout') }}" method="POST" class="border-t border-gray-200">
            @csrf
            <button type="submit" class="w-full text-left px-4 py-2 text-gray-700 hover:bg-gray-100">Logout</button>
        </form>
    </div>
</div>
    @else
        <!-- Jika belum login -->
        <a href="{{ route('login') }}" class="px-3 py-2 xl:px-4 xl:py-2 bg-primary text-white rounded-lg hover:bg-primary-dark transition-colors duration-200 hover:scale-105 transform text-sm xl:text-base">Masuk</a>
        <a href="{{ route('register') }}" class="px-3 py-2 xl:px-4 xl:py-2 border border-primary text-primary bg-white rounded-lg hover:bg-gray-50 transition-colors duration-200 hover:scale-105 transform text-sm xl:text-base">Daftar</a>
    @endauth
</div>

            <!-- Mobile Menu Button -->
            <div class="lg:hidden flex items-center gap-2">
                @auth
                    <div data-tooltip-target="tooltip-keranjang-mobile" data-tooltip-placement="bottom">
                        <a href="/keranjang" class="p-2 rounded-lg transition-colors duration-200 hover:scale-105 transform inline-flex items-center justify-center">
                            <svg class="w-6 h-6 text-primary" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M5 4h1.5L9 16m0 0h8m-8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm-8.5-3h9.25L19 7H7.312"/>
                            </svg>
                        </a>
                        <div id="tooltip-keranjang-mobile" role="tooltip" class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip">
                            Keranjang
                            <div class="tooltip-arrow" data-popper-arrow></div>
                        </div>
                    </div>
                @else
                    <a href="{{ route('login') }}" class="p-2 text-gray-700 hover:text-primary">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                    </a>
                @endauth
                
                <button id="mobile-menu-button" class="text-gray-700 hover:text-primary focus:outline-none p-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
            </div>
        </nav>
    </div>

    <!-- Mobile Menu -->
    <div id="mobile-menu" class="hidden lg:hidden fixed inset-0 bg-gray-800 bg-opacity-75 z-50 transition-opacity duration-300">
        <div class="fixed inset-y-0 right-0 max-w-xs w-full bg-white shadow-lg transform transition-transform duration-300 ease-in-out">
            <div class="flex justify-between items-center px-4 py-3 border-b border-gray-200">
                <div class="text-lg font-semibold text-gray-900">Menu</div>
                <button id="close-mobile-menu" class="text-gray-500 hover:text-gray-700 p-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <div class="px-2 py-3 overflow-y-auto max-h-[calc(100vh-60px)]">
                <ul class="space-y-1">
                    <li>
                        <a href="#home" class="block px-3 py-3 text-gray-700 hover:text-primary hover:bg-gray-100 rounded mobile-nav-link">Beranda</a>
                    </li>
                    <li>
                        <a href="#produk" class="block px-3 py-3 text-gray-700 hover:text-primary hover:bg-gray-100 rounded mobile-nav-link">Produk</a>
                    </li>
                    <li>
                        <a href="#syarat" class="block px-3 py-3 text-gray-700 hover:text-primary hover:bg-gray-100 rounded mobile-nav-link">Syarat</a>
                    </li>
                    <li>
                        <a href="#ulasan" class="block px-3 py-3 text-gray-700 hover:text-primary hover:bg-gray-100 rounded mobile-nav-link">Ulasan</a>
                    </li>
                    <li>
                        <a href="#kontak" class="block px-3 py-3 text-gray-700 hover:text-primary hover:bg-gray-100 rounded mobile-nav-link">Kontak</a>
                    </li>
                </ul>
                
                <div class="mt-4 pt-4 border-t border-gray-200">
                    @auth
                        <div class="px-3 py-2 text-gray-700 font-medium truncate">{{ Auth::user()->name }}</div>
                        <a href="/profil" class="block px-3 py-3 text-gray-700 hover:text-primary hover:bg-gray-100 rounded">Profil Saya</a>
                        <a href="/pesanan" class="block px-3 py-3 text-gray-700 hover:text-primary hover:bg-gray-100 rounded">Pesanan Saya</a>
                        <form action="{{ route('logout') }}" method="POST" class="px-3 py-3">
                            @csrf
                            <button type="submit" class="w-full text-left text-gray-700 hover:text-primary">Logout</button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="block px-3 py-3 bg-primary text-white rounded-lg hover:bg-primary-dark transition-colors duration-200 mx-2 text-center">Masuk</a>
                        <a href="{{ route('register') }}" class="block px-3 py-3 border border-primary text-primary bg-white rounded-lg hover:bg-gray-50 transition-colors duration-200 mx-2 mt-2 text-center">Daftar</a>
                    @endauth
                </div>
            </div>
        </div>
    </div>
</header>

<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
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

        // Smooth scroll and active link management
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
            // Desktop links
            document.querySelectorAll('.nav-link').forEach(link => {
                link.classList.remove('text-primary');
                link.classList.add('text-gray-700');
                const span = link.querySelector('span');
                if (span) span.classList.remove('scale-x-100');
            });
            
            const activeDesktopLink = document.querySelector(`.nav-link[href="${target}"]`);
            if (activeDesktopLink) {
                activeDesktopLink.classList.add('text-primary');
                activeDesktopLink.classList.remove('text-gray-700');
                const span = activeDesktopLink.querySelector('span');
                if (span) span.classList.add('scale-x-100');
            }

            // Mobile links
            document.querySelectorAll('.mobile-nav-link').forEach(link => {
                link.classList.remove('text-primary', 'bg-gray-100');
                link.classList.add('text-gray-700');
            });
            
            const activeMobileLink = document.querySelector(`.mobile-nav-link[href="${target}"]`);
            if (activeMobileLink) {
                activeMobileLink.classList.add('text-primary', 'bg-gray-100');
                activeMobileLink.classList.remove('text-gray-700');
            }
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
        // Tambahkan kode baru ini untuk user dropdown (click behavior)
    const userMenuButton = document.getElementById('user-menu-button');
    const userDropdown = document.getElementById('user-dropdown');
    let isDropdownOpen = false;

    // Toggle dropdown saat tombol diklik
    if (userMenuButton && userDropdown) {
        userMenuButton.addEventListener('click', function(e) {
            e.stopPropagation();
            isDropdownOpen = !isDropdownOpen;
            userDropdown.classList.toggle('hidden', !isDropdownOpen);
        });

        // Tutup dropdown saat klik di luar
        document.addEventListener('click', function(e) {
            if (isDropdownOpen && !userDropdown.contains(e.target) && e.target !== userMenuButton) {
                userDropdown.classList.add('hidden');
                isDropdownOpen = false;
            }
        });
    }
    });
</script>