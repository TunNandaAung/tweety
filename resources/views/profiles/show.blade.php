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

    @include('_timeline',[
        'tweets' => $tweets
    ])

</x-app>