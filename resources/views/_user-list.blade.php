    @foreach($users as $user)
        <div class="py-5 {{ $loop->last ? '' :  'border-b border-gray-400'}}">
            <div class="flex">
                <a href={{ $user->path() }} class="flex flex-1 items-start ">
                    <img
                        src="{{ $user->avatar }}"
                        alt="{{ $user->username }}'s avatar"
                        width="50"
                        class="mr-4 rounded-full"
                    >
    
                    <div class="flex flex-col items-start">
                        <h4 class="font-bold rounded-full px-2 py-1 -ml-2 bg-transparent hover:bg-blue-500 hover:text-white text-center block">{{ $user->name }}</h4>
                        <span class="font-bold text-sm text-gray-600">{{ '@'. $user->username }}</span>
                        @if(isset($user->description))
                            <p class="mt-3">{{ $user->description }}</p>
                        @endif
                    </div>
                </a>

                <x-follow-button :user="$user"></x-follow-button>
            </div>
        </div>

    @endforeach
