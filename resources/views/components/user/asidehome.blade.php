<aside id="sidebar-default" class="text-white mr-12 relative hidden left-0 flex lg:flex flex-shrink-0 flex-col w-64 transition-width duration-75" aria-label="Sidebar">
    <div class="py-3 bg-red-700 flex items-center text-base border-b">
        <svg class="w-6 h-6 ml-6 mr-3" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"></path></svg>
        Semua Kategori
    </div>
    <div class="relative flex-1 flex flex-col min-h-0 pt-1 border-gray-200 bg-red-700">
        <div class="flex flex-col overflow-y-auto">
            <div class="flex-1 divide-y space-y-1">
            <ul class="space-y-2 pb-2">
                @foreach($categories as $category)
                    <li class="pl-6 flex-1 hover:bg-white hover:text-red-700 ">
                        <a href="{{ route('user.books.search', ['category' => $category->id, 'based_on' => request()->query('based_on')]) }}" class="text-base font-normal flex items-center py-2 group hover:text-red-700">
                        <img src="{{ asset('images/icon') . '/' . strtolower(str_replace(' ', '_', str_replace(' & ', '_', $category->name))) . '.' . substr( strrchr($category->img_icon, '.'), 1) }}" alt="icon" class="w-6 h-6">
                            <span class="ml-3">{{ $category->name }}</span>
                        </a>
                    </li>
                @endforeach
            </ul>
            </div>
        </div>
    </div>
</aside>