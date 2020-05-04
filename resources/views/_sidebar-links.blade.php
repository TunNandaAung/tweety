<ul class="flex flex-col items-start">

    <li>
        <a class="font-bold text-lg mb-4 block rounded-full bg-transparent px-2 py-1 hover:bg-blue-500 hover:text-white text-center" href="{{ route('home') }}">
            Home
        </a>
    </li>

    <li>
        <a class="font-bold text-lg mb-4 block rounded-full bg-transparent px-2 py-1 hover:bg-blue-500 hover:text-white text-center" href="/explore">
            Explore
        </a>
    </li>

   <notification-link :count="{{ current_user()->unreadNotifications->count() }}"></notification-link>

    <li>
        <a class="font-bold text-lg mb-4 block rounded-full bg-transparent px-2 py-1 hover:bg-blue-500 hover:text-white text-center" href="#">
            Messages
        </a>
    </li>

    <li>
        <a class="font-bold text-lg mb-4 block rounded-full bg-transparent px-2 py-1 hover:bg-blue-500 hover:text-white text-center" href="#">
            Bookmarks
        </a>
    </li>

    <li>
        <a class="font-bold text-lg mb-4 block rounded-full bg-transparent px-2 py-1 hover:bg-blue-500 hover:text-white text-center" href="#">
            Lists
        </a>
    </li>

    <li>
        <a class="font-bold text-lg mb-4 block rounded-full bg-transparent px-2 py-1 hover:bg-blue-500 hover:text-white text-center" href="{{ route('profile',auth()->user()) }}">
            Profile
        </a>
    </li>

    <li>
        <a class="font-bold text-lg mb-4 block rounded-full bg-transparent px-2 py-1 hover:bg-blue-500 hover:text-white text-center" href="#">
            More
        </a>
    </li>

    {{-- <form method="POST" action="/logout">
        @csrf
        <li>
            <button
                class="font-bold text-lg mb-4 block rounded-full bg-transparent px-2 py-1 hover:bg-red-600 hover:text-white text-center"
                type="Submit"
            >
                Logout
            </button>
        </li>

    </form> --}}
    <footer>
    <dropdown align="right" width="200px" v-cloak>
        <template v-slot:trigger>
            <li class="flex items-center rounded-full bg-transparent px-1 py-1 hover:bg-gray-200 hover:text-black">
                <img
                    src="{{ current_user()->avatar }}"
                    alt=""
                    class="rounded-full mr-2"
                    width="30"
                    height="30"
                >

                <div class="flex flex-col mr-5">
                    <span class="text-sm font-bold"> {{ Str::limit(current_user()->name,12) }}</span>
                    <span class="text-xs text-gray-700 font-semibold">{{ Str::limit('@'. current_user()->username,12) }}</span>
                </div>

                <div>
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="h-6 w-6 text-gray-700">
                        <path fill="currentColor" d="M15.3 9.3a1 1 0 0 1 1.4 1.4l-4 4a1 1 0 0 1-1.4 0l-4-4a1 1 0 0 1 1.4-1.4l3.3 3.29 3.3-3.3z"/>
                    </svg>
                </div>

            </li>
        </template>
        
        <div class="rounded shadow w-full">

            <div class="px-3 py-3 flex items-center pb-4 border-b border-gray-400">
                <img
                src="{{ current_user()->avatar }}"
                alt=""
                class="rounded-full mr-2"
                width="40"
                height="40"
                >

                <div class="flex flex-col mr-5 items-start">
                    <span class="font-bold"> {{ current_user()->name }}</span>
                    <span class="text-sm text-gray-700 font-semibold">{{ '@'. current_user()->username }}</span>
                </div>

                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="h-6 w-6 text-gray-700">
                    <path fill="currentColor" d="M15.3 9.3a1 1 0 0 1 1.4 1.4l-4 4a1 1 0 0 1-1.4 0l-4-4a1 1 0 0 1 1.4-1.4l3.3 3.29 3.3-3.3z"/>
                </svg>

            </div>

            <div class="px-3 py-3 flex items-center hover:bg-gray-300">
                <form method="POST" action="/logout">
                    @csrf
                    
                    <button
                        class="text-sm text-red-600"
                        type="Submit"
                    >
                        Log out {{ '@'. current_user()->username }}
                    </button>
                    
                </form>
            </div>

        </div>
        
    </dropdown>
    </footer>
</ul>