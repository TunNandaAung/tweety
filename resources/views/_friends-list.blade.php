{{-- <div class="bg-gray-200 border border-gray-400 rounded-xl py-4 px-4">
    <h3 class="font-bold text-xl mb-4">Following</h3>

    <ul>

        @forelse(auth()->user()->follows as $user)
            <li class="{{ $loop->last ? '' : 'mb-4' }}">
                <div>
                    <a href="{{ route('profile',$user) }}" class="text-sm font-semibold flex items-center ">
                        <img
                                src="{{ $user->avatar }}"
                                alt=""
                                class="rounded-full mr-2"
                                width="40"
                                height="40"
                        >

                        {{ $user->name }}
                    </a>
                </div>
            </li>

        @empty
            <li>No friends yet!</li>
        @endforelse

    </ul>
</div> --}}
<friends-list></friends-list>