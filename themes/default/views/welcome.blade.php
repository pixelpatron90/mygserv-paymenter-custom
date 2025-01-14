<x-app-layout title="home">
    <x-success class="mt-4" />
  
  @if ($categories->count() > 0)
        <div class="content">
            <h2 class="font-semibold text-2xl mb-2 text-secondary-900">{{ __('Categories') }}</h2>
            <div class="grid grid-cols-12 gap-4">

                @foreach ($categories as $category)
                    @if (($category->products()->where('hidden', false)->count() > 0 && !$category->category_id) || $category->children()->count() > 0)
                        <div class="lg:col-span-3 md:col-span-6 col-span-12">
                            <div class="content-box h-full flex flex-col">
                                <div class="flex gap-x-3 items-center mb-2">
                                    @if($category->image)
                                        <img src="/storage/categories/{{ $category->image }}" class="w-14 h-full rounded-md" onerror="removeElement(this);" />
                                    @endif
                                    <div>
                                        <h3 class="font-semibold text-lg">{{ $category->name }}</h3>
                                    </div>
                                </div>
                                <div class="prose dark:prose-invert">@markdownify($category->description)</div>
                                <div class="pt-3 mt-auto">
                                    <a href="{{ route('products', $category->slug) }}"
                                    class="button button-secondary w-full">{{ __('Browse Category') }}</a>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
    @endif

    @if ($announcements->count() > 0)
        <div class="content">
            <h2 class="font-semibold text-2xl mb-2 text-secondary-900">{{ __('Announcements') }}</h2>
            <div class="grid grid-cols-12 gap-4">
                @foreach ($announcements->sortByDesc('created_at') as $announcement)
                    <div class="lg:col-span-4 md:col-span-6 col-span-12">
                        <div class="content-box">
                            <h3 class="font-semibold text-lg">{{ $announcement->title }}</h3>
                            <div class="prose dark:prose-invert">@markdownify(strlen($announcement->announcement) > 100 ? substr($announcement->announcement, 0, 100) . '...' : $announcement->announcement)</div>
                            <div class="flex justify-between items-center mt-3">
                                <span class="text-sm text-secondary-600">{{ __('Published') }}
                                    {{ $announcement->created_at->diffForHumans() }}</span>
                                <a href="{{ route('announcements.view', $announcement->id) }}"
                                    class="button button-secondary">{{ __('Read More') }}</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif

    <div class="content ">
            <div class="content-box">
                <div class="prose dark:prose-invert min-w-full">
                  <header class="flex flex-row gap-4">
                    <x-microns-info class="w-6" />
                    <h2 class="font-semibold text-2xl mb-2 mt-2 text-secondary-900">Who or what is mygserv.de?</h2>
                  </header>
					
                  <p>
                  Lorem ipsum odor amet, consectetuer adipiscing elit. Quis cras nisi hendrerit finibus nostra luctus? Ullamcorper sagittis suscipit condimentum mauris lectus vehicula mollis nec fusce. Neque laoreet natoque potenti commodo diam velit. Per bibendum ante eu justo bibendum phasellus pharetra tellus. Nisi mi litora nulla vel natoque eros augue. Justo ultrices nibh tristique vivamus; molestie turpis.
					Hendrerit posuere iaculis litora placerat habitasse convallis. Netus mauris fusce dignissim; scelerisque a neque. Tempus viverra pretium laoreet sem arcu mollis natoque duis. Ex ligula parturient laoreet dolor hac parturient consequat. Nam himenaeos netus nec commodo amet curabitur potenti auctor. Arcu neque aenean facilisis, interdum congue enim! Aptent dictumst fames vulputate volutpat nascetur faucibus mauris volutpat? Faucibus non cras; porta interdum ridiculus interdum dictum.
                  </p>
                </div>
            </div>
          
          <div class="content-box mt-6">
                <div class="prose dark:prose-invert min-w-full">
                  <header class="flex flex-row gap-4">
                    <x-microns-info class="w-6" />
					<h2 class="font-semibold text-2xl mb-2 mt-2 text-secondary-900">What is your goal, your motivation?</h2>
                    </header>
                  <p>
                  Lorem ipsum odor amet, consectetuer adipiscing elit. Quis cras nisi hendrerit finibus nostra luctus? Ullamcorper sagittis suscipit condimentum mauris lectus vehicula mollis nec fusce. Neque laoreet natoque potenti commodo diam velit. Per bibendum ante eu justo bibendum phasellus pharetra tellus. Nisi mi litora nulla vel natoque eros augue. Justo ultrices nibh tristique vivamus; molestie turpis.
					Hendrerit posuere iaculis litora placerat habitasse convallis. Netus mauris fusce dignissim; scelerisque a neque. Tempus viverra pretium laoreet sem arcu mollis natoque duis. Ex ligula parturient laoreet dolor hac parturient consequat. Nam himenaeos netus nec commodo amet curabitur potenti auctor. Arcu neque aenean facilisis, interdum congue enim! Aptent dictumst fames vulputate volutpat nascetur faucibus mauris volutpat? Faucibus non cras; porta interdum ridiculus interdum dictum.
                  </p>
                </div>
            </div>
          
          <div class="content-box mt-6">
                <div class="prose dark:prose-invert min-w-full">
                  <header class="flex flex-row gap-4">
                    <x-microns-info class="w-6" />
					<h2 class="font-semibold text-2xl mb-2 mt-2 text-secondary-900">Is it really free?</h2>
                    </header>
                  <p>
                  Lorem ipsum odor amet, consectetuer adipiscing elit. Quis cras nisi hendrerit finibus nostra luctus? Ullamcorper sagittis suscipit condimentum mauris lectus vehicula mollis nec fusce. Neque laoreet natoque potenti commodo diam velit. Per bibendum ante eu justo bibendum phasellus pharetra tellus. Nisi mi litora nulla vel natoque eros augue. Justo ultrices nibh tristique vivamus; molestie turpis.
					Hendrerit posuere iaculis litora placerat habitasse convallis. Netus mauris fusce dignissim; scelerisque a neque. Tempus viverra pretium laoreet sem arcu mollis natoque duis. Ex ligula parturient laoreet dolor hac parturient consequat. Nam himenaeos netus nec commodo amet curabitur potenti auctor. Arcu neque aenean facilisis, interdum congue enim! Aptent dictumst fames vulputate volutpat nascetur faucibus mauris volutpat? Faucibus non cras; porta interdum ridiculus interdum dictum.
                  </p>
                </div>
            </div>
        </div>

</x-app-layout>