<nav class="bg-white border-b border-gray-200 fixed z-30 w-full">
  <div class="bg-red-500 text-white px-6 md:px-12 lg:px-20 py-3 flex flex-col md:flex-row justify-between">
    <div class="flex items-center pb-2 md:pb-0">
      <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-phone mr-2" width="22" height="20" viewBox="0 4 24 20" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
          <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
          <path d="M5 4h4l2 5l-2.5 1.5a11 11 0 0 0 5 5l1.5 -2.5l5 2v4a2 2 0 0 1 -2 2a16 16 0 0 1 -15 -15a2 2 0 0 1 2 -2"></path>
      </svg>
      <a href="https://wa.me/62895422559255">+62 8954-2255-9255</a>
    </div>

    <div class="flex items-center">
      <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-mail mr-2" width="22" height="20" viewBox="0 4 24 20" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
        <path d="M3 5m0 2a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v10a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2z"></path>
        <path d="M3 7l9 6l9 -6"></path>
     </svg>
      <a href="mailto:dinas_arpus@semarangkota.go.id">dinas_arpus@semarangkota.go.id</a>
    </div>
  </div>

  <div class="px-6 md:px-12 lg:px-20 "> 
    <div class="py-3">
      <div class="flex items-center justify-between">
          <button data-collapse-toggle="navbar-default" type="button" class="flex-0 inline-flex items-center p-2 text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600" aria-controls="navbar-default" aria-expanded="false">
            <span class="sr-only">Open main menu</span>
            <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"></path></svg>
          </button>

          <div class="flex-0 flex items-center md:shrink md:justify-center">
            <img src="{{ asset('images/semarangkota.png') }}" alt="logo" class="hidden md:block h-12 w-12 mr-3">
            <img src="{{ asset('images/sipeta.png') }}" alt="logo" class="h-12 w-12 mr-3">
            <div class="text-[10px]">Si Peta<br>Perpustakaan Intranet Kota Semarang</div>
          </div>

          <form action="{{ route('user.books.search') }}" method="GET" class="w-full shrink hidden md:block md:px-8">
            <label for="topbar-search" class="sr-only">Search</label>
            <div class="mt-1 relative lg:w-64">
              <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <svg class="w-5 h-5 text-gray-500" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path></svg>
              </div>
              <input type="text" name="q" placeholder="Search books..." value="{{ request()->query('q') }}" id="topbar-search" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-cyan-600 focus:border-cyan-600 block w-full pl-10 p-2.5">
              <input type="hidden" name="based_on" value="{{ request()->query('based_on') }}">
            </div>
          </form>

          <div class="flex">
            @if(!Auth::user())
              <a href="{{ route('login') }}"> 
                <button class="w-full text-white bg-red-500 hover:bg-red-700 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm p-2.5 text-center">Login</button>
              </a>
            @else
              {{-- DROPDOWN PROFILE --}}
              <div class="flex-0 flex items-center">
                <div class="dropdown relative">
                  <a
                    class="dropdown-toggle flex items-center hidden-arrow"
                    href="#"
                    id="dropdownMenuButton2"
                    role="button"
                    data-bs-toggle="dropdown"
                    aria-expanded="false"
                  >
                    <img
                      src="{{ Auth::user()->photo ? route("content.uprofile", ['id'=>Auth::user()->photo ]) : asset("images/icon/biografi.png") }}"
                      {{-- src="{{ route('content.uprofile', ['id'=> Auth::user()->id]) }}" --}}
                      class="rounded-full h-8 w-8 border"
                      alt=""
                      loading="lazy"
                    />
                  </a>
                  <ul
                    class="dropdown-menu min-w-max absolute hidden bg-white text-base z-50 float-left py-2 list-none text-left rounded-lg shadow-lg mt-1 hidden m-0 bg-clip-padding border-none left-auto right-0"
                    aria-labelledby="dropdownMenuButton2"
                  >
                    <li>
                      <a
                        class="w-32 min-w-full dropdown-item text-sm py-2 px-4 font-normal block w-full whitespace-nowrap bg-transparent text-gray-700 hover:text-red-500"
                        href="{{ route('user.books.favorites.index') }}"
                        >Favorit Saya</a
                      >
                    </li>
                    <li>
                      <a
                        class="w-32 min-w-full dropdown-item text-sm py-2 px-4 font-normal block w-full whitespace-nowrap bg-transparent text-gray-700 hover:text-red-500"
                        href="{{ route('user.profile.index') }}"
                        >Profile</a
                      >
                    </li>
                    <li>
                      <a
                        class="dropdown-item text-sm py-2 px-4 font-normal block w-full whitespace-nowrap bg-transparent text-gray-700 hover:bg-gray-100"
                        href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                                  document.getElementById('logout-form').submit();"
                      >
                        {{ __('Logout') }}
                      </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </li>
                  </ul>
                </div>
              </div>
            @endif

          </div>
      </div>
    </div>

    <div class="md:pb-1 md:pt md:flex md:justify-between">
      <div class="hidden w-full md:block md:w-auto" id="navbar-default">
        <ul class="flex flex-col md:flex-row md:space-x-8 md:mt-0 md:text-sm md:font-medium md:border-0 md:bg-white">
          <li>
            <a href="{{ route('user.dashboard') }}" class="block py-2 pl-3 pr-4 text-black rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-red-500 md:p-0" aria-current="page">Home</a>
          </li>
          <li>
            <a href="#footer" class="block py-2 pl-3 pr-4 text-black rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-red-500 md:p-0">Kontak</a>
          </li>
          <li>
            <a href="{{ route('user.about-us') }}" class="block py-2 pl-3 pr-4 text-black rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-red-500 md:p-0">Tentang Kami</a>
          </li>
        </ul>
      </div>
      {{-- <p class="hidden md:block">Kontak Admin: <u>+62 8954-2255-9255</u></p> --}}
    </div>

    <div class="md:pb-0 pb-6">
      <div class="w-full md:w-auto md:hidden">
        <form action="{{ route('user.books.search') }}" method="GET" class="w-full">
            <label for="topbar-search" class="sr-only">Search</label>
            <div class="mt-1 relative lg:w-64">
              <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <svg class="w-5 h-5 text-gray-500" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path></svg>
              </div>
              <input type="text" name="q" placeholder="Search books..." value="{{ request()->query('q') }}" id="topbar-search" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-cyan-600 focus:border-cyan-600 block w-full pl-10 p-2.5">
              <input type="hidden" name="based_on" value="{{ request()->query('based_on') }}">
            </div>
          </form>
      </div>
    </div>
  </div>
</nav>