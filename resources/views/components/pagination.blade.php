@if ($paginator instanceof \Illuminate\Contracts\Pagination\Paginator && $paginator->hasPages())
    <nav class="flex justify-between items-center mt-4">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <span class="text-gray-500">Previous</span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" rel="prev" class="text-blue-500 hover:underline">Previous</a>
        @endif

        {{-- Page Links --}}
        <div>
            @foreach ($elements as $element)
                @if (is_string($element))
                    <span class="px-2 text-gray-500">{{ $element }}</span>
                @endif

                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <span class="px-2 text-blue-700 font-bold">{{ $page }}</span>
                        @else
                            <a href="{{ $url }}" class="px-2 text-blue-500 hover:underline">{{ $page }}</a>
                        @endif
                    @endforeach
                @endif
            @endforeach
        </div>

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" rel="next" class="text-blue-500 hover:underline">Next</a>
        @else
            <span class="text-gray-500">Next</span>
        @endif
    </nav>
@endif
