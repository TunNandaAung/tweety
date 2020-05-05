<div class="flex w-3/4">
    <div class="mr-3">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-purple-500">
            <path fill="currentColor" 
                d="M13 16v5a1 1 0 01-1 1H9l-3-6a2 2 0 01-2-2 2 2 0 01-2-2v-2c0-1.1.9-2 2-2 0-1.1.9-2 2-2h7.59l4-4H20a2 2 0 012 2v14a2 2 0 01-2 2h-2.41l-4-4H13zm0-2h1.41l4 4H20V4h-1.59l-4 4H13v6zm-2 0V8H6v2H4v2h2v2h5zm0 2H8.24l2 4H11v-4z"
            />
        </svg>
    </div>

    <div class="flex-1 mb-1">
        <h2 class="text-normal font-semibold mb-3"> {{ $notification->data['message'] }}</h2>
        <div class="border border-gray-400 rounded-xl p-4 w-full">
            <div class="flex items-start">
                
                <div class="flex items-start flex-1 ml-1 mb-4">
                    <img src="{{ $notification->data['notifier']['avatar'] }}" alt="image" class="h-6 w-6 rounded-full mb-1 mr-1" />

                    <div class="leading-tight tracking-tight font-bold">
                        <span class="text-gray-700 text-sm">{{ '@'.$notification->data['notifier']['username'] }}</span>
                    </div>
                </div>


                <div>
                    <a  href="{{ $notification->data['link'] }}"
                        class="bg-white rounded-full border border-gray-300 py-2 px-4 text-black text-xs mr-2 font-bold hover:bg-blue-500 hover:text-white">
                        View Tweet
                    </a>
                </div>

            </div>
            @if(isset($notification->data['description']))
                <p>{!! Str::limit($notification->data['description'],100) !!}</p>
            @endif
        </div>

    </div>
</div>
