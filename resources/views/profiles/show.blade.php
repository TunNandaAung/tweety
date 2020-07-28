<x-app>
    <header class="mb-6 relative">

        <div class="relative">
            <img
                src="{{ $user->banner }}"
                alt="profile banner"
                class="rounded-lg mb-2 h-56 w-full object-cover"
            >

            <img
                src="{{ $user->avatar }}"
                alt=""
                class="rounded-full mr-2 absolute bottom-0 transform -translate-x-1/2 translate-y-1/2"
                width="150"
                style="left: 50%"
            >

        </div>

        <div class="flex justify-between items-center mb-6">
            <div style="max-width: 270px">
                <h2 class="font-bold text-2xl mb-1">{{ $user->name }}</h2>
                <h3 class="font-bold text-sm mb-1 text-gray-600">{{ '@'. $user->username }}</h3>
                <p class="text-sm">Joined {{ $user->created_at->diffForHumans() }}</p>
            </div>

            <div class="flex">

                @can('edit',$user)
                    <a  href="{{ $user->path('edit') }}"
                        class="bg-white rounded-full border border-gray-300 py-2 px-4 text-black text-xs mr-2 font-bold hover:bg-blue-500 hover:text-white">
                        Edit Profile
                    </a>
                    
                    <a href="{{ $user->path('settings')}}"
                        class="bg-white rounded-full border border-gray-300 py-2 px-4 text-black text-xs mr-2 font-bold hover:bg-blue-500 hover:text-white cursor-pointer"
                    >
                        <svg viewBox="0 0 20 20" class="fill-current w-4 h-4">
                            <path fill-rule="evenodd" 
                                class="fill-current"
                                d="M11.49 3.17c-.38-1.56-2.6-1.56-2.98 0a1.532 1.532 0 01-2.286.948c-1.372-.836-2.942.734-2.106 2.106.54.886.061 2.042-.947 2.287-1.561.379-1.561 2.6 0 2.978a1.532 1.532 0 01.947 2.287c-.836 1.372.734 2.942 2.106 2.106a1.532 1.532 0 012.287.947c.379 1.561 2.6 1.561 2.978 0a1.533 1.533 0 012.287-.947c1.372.836 2.942-.734 2.106-2.106a1.533 1.533 0 01.947-2.287c1.561-.379 1.561-2.6 0-2.978a1.532 1.532 0 01-.947-2.287c.836-1.372-.734-2.942-2.106-2.106a1.532 1.532 0 01-2.287-.947zM10 13a3 3 0 100-6 3 3 0 000 6z" 
                                clip-rule="evenodd"
                            >
                            </path>
                        </svg>
                    </a>

                @endcan

                <x-follow-button :user="$user"></x-follow-button>

            </div>
        </div>

        <div class="flex justify-between">
            @if(isset($user->description))
                <p class="text-sm font-semibold">{{ $user->description }}</p>
            @endif
            
            <div class="flex justify right">
            <a class="mr-3 hover:underline hover:text-blue-500 cursor-pointer" href="{{ $user->path('following') }}">
                    <span class="font-semibold">{{ $followings }} </span>
                    <span class="text-gray-700">{{ $followings > 0 ? 'Followings' : 'Following' }}</span>
                </a>
                <a class="hover:underline hover:text-blue-500 cursor-pointer" href="{{ $user->path('followers') }}">
                    <span class="font-semibold">{{ $followers }} </span>
                    <span class="text-gray-700">{{ $followers > 0 ? 'Followers' : 'Follower' }} </span>
                </a>
            </div>
        </div>

    </header>

    <div class="border border-gray-300 rounded-lg mb-6">

        @include('_timeline',[
            'tweets' => $tweets
        ])
    </div>
</x-app>