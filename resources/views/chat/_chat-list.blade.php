@foreach($chat->participants as $user)
    @unless ($user->is(current_user()))
        <div class="py-5 border-b border-gray-400">
            <div class="flex">
                <a href={{ route('show-chat',$user->username) }} class="flex flex-1 items-start ">
                    <img
                        src="{{ $user->avatar }}"
                        alt="{{ $user->username }}'s avatar"
                        width="50"
                        class="mr-4 rounded-full"
                    >
    
                    <div class="flex flex-col items-start">
                        <h4 class="font-bold rounded-full px-2 py-1 -ml-2 bg-transparent hover:bg-blue-500 hover:text-white text-center block">{{ $user->name }}</h4>
                        <span class="font-bold text-sm text-gray-600">{{ '@'. $user->username }}</span>
                            
                        <div class="flex">
                                @if($chat->messages->first()->user_id === auth()->id() )
                                    You:
                                @endif       
                                <p class="font-semibold">  {{ $chat->messages->first()->message }}</p>
                        </div>

                    </div>
                </a>

                <x-follow-button :user="$user"></x-follow-button>
            </div>
        </div>
    @endunless

@endforeach