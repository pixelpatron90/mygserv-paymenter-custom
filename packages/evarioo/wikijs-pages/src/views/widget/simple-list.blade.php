<div class="widget">
    <div class="title">
        <h1>
            <i class="fa-solid fa-angle-right me-2"></i>
            {{ __($data->widget_title) }}
        </h1>
    </div>
    <div class="content">
        <ul>
            @foreach ($data->pages as $page)
            <li
                class="mb-1 last:mb-0 text-white odd:bg-red-500 odd:hover:bg-red-600 bg-secondary-500 hover:bg-secondary-600 rounded-md">
                <a target="_blank" href="{{ $data->wiki_url }}/{{ $page['path'] }}"
                    class="px-2 py-2 flex items-center transition-all ease-in-out">
                    <i class="fa-solid fa-caret-right me-2"></i>
                    {{ $page['title'] }}
                </a>
            </li>
            @endforeach
        </ul>
    </div>
</div>