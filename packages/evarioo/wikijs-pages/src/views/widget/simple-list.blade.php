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
            <li>
                <a href="{{ $data->wiki_url }}/{{ $page['path'] }}"
                    class="px-2 py-2 hover:bg-secondary-300 flex items-center gap-x-2 rounded-md transition-all ease-in-out">
                    <i class="fa-solid fa-caret-right me-2"></i>
                    {{ $page['title'] }}
                </a>
            </li>
            @endforeach
        </ul>
    </div>
</div>