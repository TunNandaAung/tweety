<x-master>
    <section class="px-8">
        <main class="container mx-auto">
            <div class="lg:flex lg:justify-center">
                @auth
                <div class="lg:w-32 h-screen lg:fixed lg:left-0 lg:ml-56">
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
    
    <flash message="{{ session('flash') }}"></flash>
</x-master>