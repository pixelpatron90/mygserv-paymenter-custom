<div class="widget">
    <div class="title">
        <h1><i class="fa-solid fa-angle-right me-2"></i> {{ __('Authentication') }}</h1>
    </div>
    <div class="content">
        @auth
        <h1 class="w-full p-2 mb-1.5 bg-red-500 text-white rounded-md">
            {{ __('Welcome back,') }}
            {{ Auth::user()->username }}
        </h1>
        <a href="{{ route('clients.profile') }}"
            class="px-2 py-2 hover:bg-secondary-300 flex items-center gap-x-2 rounded-md transition-all ease-in-out">
            <i class="fa-solid fa-caret-right me-2"></i> {{__('Profile')}}
        </a>
        @if (Auth::user()->has('ADMINISTRATOR'))
        <a target="_blank" href="{{ route('admin.index') }}"
            class="px-2 py-2 hover:bg-secondary-300 flex items-center gap-x-2 rounded-md transition-all ease-in-out">
            <i class="fa-solid fa-caret-right me-2"></i> {{ __('Admin area') }}
        </a>
        <a href="{{ route('clients.api.index') }}"
            class="px-2 py-2 hover:bg-secondary-300 flex items-center gap-x-2 rounded-md transition-all ease-in-out">
            <i class="fa-solid fa-caret-right me-2"></i> {{ __('API') }}
        </a>
        @endif
        <a type="button" href="{{ route('logout') }}"
            onclick="event.preventDefault();document.getElementById('logout-form').submit();"
            class="px-2 py-2 hover:bg-secondary-300 flex items-center gap-x-2 rounded-md transition-all ease-in-out">
            <i class="fa-solid fa-caret-right me-2"></i> {{ __('Log Out') }}
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
            @csrf
        </form>
        @else
        <a href="{{ route('login') }}" class="button bg-red-500 w-full hover:bg-red-600 text-white md:flex-none flex-1">
            <i class="fa-solid fa-caret-right me-2"></i> {{ __('Login') }}
        </a>
        <div class="flex items-center my-2">
            <div class="w-full h-0.5 bg-secondary-200"></div>
            <div class="px-5 text-center text-secondary-500">{{ __('or') }}</div>
            <div class="w-full h-0.5 bg-secondary-200"></div>
        </div>
        <a href="{{ route('register') }}"
            class="button bg-red-500 w-full hover:bg-red-600 text-white md:flex-none flex-1">
            <i class="fa-solid fa-caret-right me-2"></i> {{ __('Register') }}
        </a>
        @endauth
    </div>
</div>