<x-app-layout title="{{ __('Media') }}">

    <div class="content">
        <div class="content-box">
            <div class="prose dark:prose-invert min-w-full">
                <header class="flex flex-row gap-4">
                    <h2 class="font-semibold text-2xl mb-2 mt-2 text-secondary-900">{{ __('Media') }}</h2>
                </header>

                <p>
                    Ihr habe Gefallen an dem was wir machen? Ihr habt einen Gameserver von mygserv.de oder einen
                    Webspace? Dann habt ihr hier die Möglichkeit
                    uns zu danken in dem ihr unseren Werbebanner auf eurer Homepage / Discord / Server platziert.
                </p>

                <div class="mt-6 grid grid-cols-12 gap-4">

                    <div class="lg:col-span-6 col-span-12 flex-col">
                        <div class="">
                            <textarea
                                class="resize-none rounded-md w-full bg-secondary-50 text-gray-400"><a title="mygserv.de" href="https://mygserv.de"><img src="https://media.mygserv.de/banner/banner-468-60-blue-black.png" alt="mygserv.de" /></a></textarea>
                        </div>
                    </div>
                    <div class="lg:col-span-6 col-span-12">
                        <div class="flex justify-center items-center">
                            <img class="inline-block align-middle mt-0 mb-0 center"
                                src="https://media.mygserv.de/banner/banner-468-60-blue-black.png" alt="mygserv.de" />
                        </div>
                    </div>

                    <div class="lg:col-span-6 col-span-12 flex-col">
                        <div class="">
                            <textarea
                                class="resize-none rounded-md w-full bg-secondary-50 text-gray-400"><a title="mygserv.de" href="https://mygserv.de"><img src="https://media.mygserv.de/banner/banner-468-60-blue-white.png" alt="mygserv.de" /></a></textarea>
                        </div>
                    </div>
                    <div class="lg:col-span-6 col-span-12">
                        <div class="flex justify-center items-center">
                            <img class="inline-block align-middle mt-0 mb-0 center"
                                src="https://media.mygserv.de/banner/banner-468-60-blue-white.png" alt="mygserv.de" />
                        </div>
                    </div>

                    <div class="lg:col-span-6 col-span-12 flex-col">
                        <div class="">
                            <textarea
                                class="resize-none rounded-md w-full bg-secondary-50 text-gray-400"><a title="mygserv.de" href="https://mygserv.de"><img src="https://media.mygserv.de/banner/banner-88-31-blue-white.png" alt="mygserv.de" /></a></textarea>
                        </div>
                    </div>
                    <div class="lg:col-span-6 col-span-12">
                        <div class="flex justify-center items-center">
                            <img class="inline-block align-middle mt-0 mb-0 center"
                                src="https://media.mygserv.de/banner/banner-88-31-blue-white.png" alt="mygserv.de" />
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>

</x-app-layout>