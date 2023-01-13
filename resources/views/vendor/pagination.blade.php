{{-- @if ($paginator->hasPages()) --}}
<div class="flex items-center mb-4 sm:mb-0">
    <a href="{{ $paginator->onFirstPage() ? '#' : $paginator->previousPageUrl() }}" class="{{ $paginator->onFirstPage() ? 'disabled' : '' }}text-gray-500 hover:text-gray-900 cursor-pointer p-1 hover:bg-gray-100 rounded inline-flex justify-center">
        <svg class="w-7 h-7" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd"></path></svg>
    </a>
    <a href="{{ $paginator->hasMorePages() ? $paginator->nextPageUrl() : '#' }}" class="{{ !($paginator->hasMorePages()) ? 'disabled' : '' }}text-gray-500 hover:text-gray-900 cursor-pointer p-1 hover:bg-gray-100 rounded inline-flex justify-center">
        <svg class="w-7 h-7" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
    </a>
    <span class="text-sm font-normal text-gray-500">Showing <span class="text-gray-900 font-semibold">{{ $paginator->perPage() * ($paginator->currentPage() - 1) + 1  . '-' . $paginator->perPage() * $paginator->currentPage()}}</span> of <span class="text-gray-900 font-semibold">{{ $paginator->total() }}</span></span>
    
</div>
{{-- @if ($paginator->hasPages()) --}}