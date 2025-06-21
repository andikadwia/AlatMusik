  <div class="bg-gray-200 w-full shadow-sm sticky top-0 z-30">
    <div class="navbar px-4">
      <div class="flex-1 items-center">
        <img src="https://c.animaapp.com/knqlfAnT/img/tak-berjudul1-20250312112214-1@2x.png" alt="Logo" class="h-20">
      </div>
      <div class="flex-none">
        <div class="form-control hidden sm:block">
          <form method="GET" action="{{ route('dashboard.produk.index.search') }}">
              <div class="input-group">
                  <input 
                      type="text" 
                      name="search" 
                      placeholder="Cari alat musik..." 
                      class="input input-bordered w-full"
                      value="{{ request('search') }}"
                  />
              </div>
              @if(request('search'))
                  <a href="{{ route('dashboard.produk.index.search') }}" class="btn btn-square">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                  </a>
              @endif
          </form>
        </div>
      </div>
    </div>
  </div>
  <button id="menu-button" class="btn btn-ghost ml-2">
    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7" />
    </svg>
  </button>