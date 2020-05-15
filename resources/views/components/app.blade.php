<x-master>
    <x-slot name="script">
        <script>
            window.App = {!! json_encode([
                'csrfToken' => csrf_token(),
                'user' => Auth::user(),
                'signedIn' => Auth::check()
            ]) !!};
        </script>
    </x-slot>

    @if(Illuminate\Support\Facades\Route::currentRouteName() != 'show-search')
    <x-slot name="search">
        <form class="search-box" method="GET" action="/search">

            <input class="search-input"
                type="text" 
                name="q" 
                placeholder="Search Tweety..."
            >
            <button class="search-button" href="#" type="button">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18">
                    <g fill="none" fill-rule="evenodd">
                        <path d="M-3-3h24v24H-3z"/>
                        <path fill="#FFF" d="M12.5 11h-.79l-.28-.27A6.471 6.471 0 0 0 13 6.5 6.5 6.5 0 1 0 6.5 13c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L17.49 16l-4.99-5zm-6 0C4.01 11 2 8.99 2 6.5S4.01 2 6.5 2 11 4.01 11 6.5 8.99 11 6.5 11z"/>
                    </g>
                </svg>
            </button>
        </form>

    </x-slot>
    @endif

    <section class="px-8">
        <main class="container mx-auto">
            <div class="lg:flex lg:justify-center">
                @auth
                <div class="lg:w-48 lg:h-screen lg:fixed lg:left-0 lg:ml-48">
                        @include ('_sidebar-links')
                    </div>
                @endauth

                <div class="lg:flex-1 lg:mx-auto lg:mr-12 lg:mb-12" style="max-width: 700px;">
                    {{ $slot }}
                </div>
               
                @auth
                    <div class="lg:w-64">
                        @include ('_friends-list')
                    </div>
                @endauth
                
            </div>
            
        </main>
    </section>

    @if (isset($extra))
       {{ $extra }}
    @endif
    
    <flash message="{{ session('flash') }}"></flash>
</x-master>