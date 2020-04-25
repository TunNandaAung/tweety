<div class="flex w-1/2">
    <div class="mr-3">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-blue-500">
            <path fill="currentColor" 
                d="M12 12a5 5 0 110-10 5 5 0 010 10zm0-2a3 3 0 100-6 3 3 0 000 6zm9 11a1 1 0 01-2 0v-2a3 3 0 00-3-3H8a3 3 0 00-3 3v2a1 1 0 01-2 0v-2a5 5 0 015-5h8a5 5 0 015 5v2z"
            />
        </svg>
    </div>

    <div class="flex-1 mb-1">
        <h2 class="text-normal font-semibold mb-3"> {{ $notification->data['message'] }}</h2>
        <div class="border border-gray-400 rounded-xl p-4 w-full">
            <div class="flex items-start">
                
                <div class="flex-1 ml-1">
                    <img src="{{ $notification->data['notifier']['avatar'] }}" alt="image" class="h-10 w-10 rounded-full mb-1" />

                    <div class="leading-tight tracking-tight">
                        <h3 class="font-semibold">{{ $notification->data['notifier']['name'] }} </h3>
                        <span class="text-gray-700 text-sm">{{ '@'.$notification->data['notifier']['username'] }}</span>
                    </div>
                </div>


                <div>
                    <a  href="{{ $notification->data['link'] }}"
                        class="bg-white rounded-full border border-gray-300 py-2 px-4 text-black text-xs mr-2 font-bold hover:bg-blue-500 hover:text-white">
                        Visit Profile
                    </a>
                </div>
            
            </div>

        </div>

    </div>
</div>
