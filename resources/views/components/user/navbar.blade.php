<nav class="px-12 lg:px-24 bg-white border-b border-gray-200 fixed z-30 w-full">
    <div class="py-3">
      <div class="flex items-center justify-between">
          <button data-collapse-toggle="navbar-default" type="button" class="flex-0 inline-flex items-center p-2 text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600" aria-controls="navbar-default" aria-expanded="false">
            <span class="sr-only">Open main menu</span>
            <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"></path></svg>
          </button>

          <div class="flex-0 flex items-center md:shrink md:justify-center">
            <img src="{{ asset('images/sipeta.png') }}" alt="logo" class="h-12 w-12">
            {{-- SI-PETA --}}
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
            {{-- FAVORITES --}}
            {{-- <button type="button" class="rounded-full p-1 text-gray-400 hover:text-white focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800">
              <span class="sr-only">View notifications</span>
              <!-- Heroicon name: outline/bell -->
              <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
              </svg>
            </button> --}}

            {{-- NOTIFICATION --}}
            {{-- <button type="button" class="rounded-full p-1 text-gray-400 hover:text-white focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800">
              <span class="sr-only">View notifications</span>
              <!-- Heroicon name: outline/bell -->
              <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75v-.7V9A6 6 0 006 9v.75a8.967 8.967 0 01-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 01-5.714 0m5.714 0a3 3 0 11-5.714 0" />
              </svg>
            </button> --}}

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
                    src="{{ Auth::user()->photo ? route("content.uprofile", ['id'=>Auth::user()->id, 'ext'=>substr( strrchr(Auth::user()->photo, '.'), 1)]) : asset("images/icon/biografi.png") }}"
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
                  {{-- <li>
                    <a
                      class="w-32 min-w-full dropdown-item text-sm py-2 px-4 font-normal block w-full whitespace-nowrap bg-transparent text-gray-700 hover:text-red-500"
                      href="#"
                      >Notifications</a
                    >
                  </li> --}}
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

          </div>
          
      </div>
      </div>
    </div>

    <div class="md:pb-1 md:pt">
      <div class="hidden w-full md:block md:w-auto" id="navbar-default">
        <ul class="flex flex-col md:flex-row md:space-x-8 md:mt-0 md:text-sm md:font-medium md:border-0 md:bg-white">
          <li>
            <a href="{{ route('user.home') }}" class="block py-2 pl-3 pr-4 text-black rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-red-500 md:p-0" aria-current="page">Home</a>
          </li>
          <li>
            <a href="#footer" class="block py-2 pl-3 pr-4 text-black rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-red-500 md:p-0">Kontak</a>
          </li>
          <li>
            <a href="{{ route('user.about-us') }}" class="block py-2 pl-3 pr-4 text-black rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-red-500 md:p-0">Tentang Kami</a>
          </li>
        </ul>
      </div>
    </div>

    <div class="md:pb-0 pb-6">
      <div class="w-full md:w-auto md:hidden">
        <form action="#" method="GET" class="w-full">
          <label for="topbar-search" class="sr-only">Search</label>
          <div class="mt-1 relative lg:w-64">
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
              <svg class="w-5 h-5 text-gray-500" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path></svg>
            </div>
            <input type="text" name="email" id="topbar-search" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-cyan-600 focus:border-cyan-600 block w-full pl-10 p-2.5" placeholder="Search">
          </div>
        </form>
      </div>
    </div>
  </nav>