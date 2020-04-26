
<div class="flex w-3/4">
    <div class="mr-3">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-teal-500">
            <path fill="currentColor" 
                d="M18 21H7a4 4 0 0 1-4-4V5c0-1.1.9-2 2-2h10a2 2 0 0 1 2 2h2a2 2 0 0 1 2 2v11a3 3 0 0 1-3 3zm-3-3V5H5v12c0 1.1.9 2 2 2h8.17a3 3 0 0 1-.17-1zm-7-3h4a1 1 0 0 1 0 2H8a1 1 0 0 1 0-2zm0-4h4a1 1 0 0 1 0 2H8a1 1 0 0 1 0-2zm0-4h4a1 1 0 0 1 0 2H8a1 1 0 1 1 0-2zm9 11a1 1 0 0 0 2 0V7h-2v11z"
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
            {{-- {{ str_limit($project->description, 100) }} --}}
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Maxime voluptates sequi adipisci quibusdam repellat ducimus. Laboriosam velit quaerat necessitatibus blanditiis!</p>
        </div>

    </div>
</div>
