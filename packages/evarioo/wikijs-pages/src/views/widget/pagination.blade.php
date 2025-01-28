@if ($paginator->hasPages())
<div role="navigation" aria-label="{{ __('Pagination Navigation') }}" class="mt-4 flex items-center justify-between">
    <div>
        <span class="relative z-0 inline-flex rtl:flex-row-reverse shadow-sm rounded-md">
            @foreach ($elements as $element)
            @if (is_array($element))
            @foreach ($element as $page => $url)
            @if ($page == $paginator->currentPage())
            <span aria-current="page">
                <span
                    class="relative inline-flex items-center px-4 py-2 -ml-px text-sm rounded-md font-medium text-red-500 bg-gray-700 border border-primarylight cursor-default leading-5">
                    {{ $page }}
                </span>
            </span>
            @else
            <a href="{{ $url }}"
                class="active:bg-red-500 relative inline-flex items-center px-4 py-2 rounded-md -ml-px text-sm font-medium text-white bg-gray-800 hover:bg-red-500 border border-primarylight leading-5 hover:text-white focus:z-10 focus:outline-none focus:none ring-gray-300 transition ease-in-out duration-150"
                aria-label="{{ __('Go to page :page', ['page' => $page]) }}">
                {{ $page }}
            </a>
            @endif
            @endforeach
            @endif
            @endforeach
        </span>
    </div>
</div>
@endif