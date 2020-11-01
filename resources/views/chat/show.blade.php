<x-app>
    <div class="w-full mx-auto rounded-lg">
        <div class="w-full lg:-mt-8 mb-4 lg:mb-0">
            <div class=" bg-blue-500 py-4 px-2 text-white font-bold text-xl rounded-t-xl text-center">{{'@'.$recipient->username }}</div>
                    
                <chat :initial-messages="{{ $chat->messages }}" 
                    :user="{{ auth()->user() }}"
                    :recipient="{{ $recipient }}"
                    :chat-id="'{{ $chat->id }}'"></chat>
                    
            </div> 
    </div>
</x-app>