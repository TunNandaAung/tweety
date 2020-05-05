
<div class="flex w-3/4">
    <div class="mr-3">
        <svg viewBox="0 0 24 24" class="h-6 w-6 text-blue-600" style="transform: scaleX(-1)">
            <path fill="currentColor" 
                d="M17.62 10H20a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H8.5c-1.2 0-2.3-.72-2.74-1.79l-3.5-7-.03-.06A3 3 0 0 1 5 9h5V4c0-1.1.9-2 2-2h1.62l4 8zM16 11.24L12.38 4H12v7H5a1 1 0 0 0-.93 1.36l3.5 7.02a1 1 0 0 0 .93.62H16v-8.76zm2 .76v8h2v-8h-2z"
            />
        </svg>
    </div>

    <div class="flex-1 mb-1">
        <h2 class="text-normal font-semibold mb-3"> {{ $notification->data['message'] }}</h2>
        <div class="border border-gray-400 rounded-xl p-4 w-full">
            <div class="flex items-start">
                
                <div class="flex items-start flex-1 ml-1 mb-4">
                    <img src="{{ current_user()->avatar }}" alt="image" class="h-6 w-6 rounded-full mb-1 mr-1" />

                    <div class="leading-tight tracking-tight font-bold">
                        <span class="text-gray-700 text-sm">{{ '@'.current_user()->username }}</span>
                    </div>
                </div>


                <div>
                    <a  href="{{ $notification->data['link'] }}"
                        class="bg-white rounded-full border border-gray-300 py-2 px-4 text-black text-xs mr-2 font-bold hover:bg-blue-500 hover:text-white">
                        View {{ Str::endsWith($notification->data['message'], 'tweet.') ? 'Tweet' : 'Reply'}}
                    </a>
                </div>

            </div>
            @if(isset($notification->data['description']))
                <p>{!! Str::limit($notification->data['description'],100) !!}</p>
            @endif
        </div>

    </div>
</div>
