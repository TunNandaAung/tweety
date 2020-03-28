<h3 class="font-bold text-xl mb-4">Following</h3>

<ul>

    @foreach(auth()->user()->follows as $user)
        <li class="mb-4">
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
    @endforeach

</ul>