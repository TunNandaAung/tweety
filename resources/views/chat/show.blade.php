<x-app>
    <chat :initial-messages="{{ $chat->messages }}" 
        :user="{{ auth()->user() }}"
        :recipient="{{ $recipient }}"
        :chat-id="'{{ $chat->id }}'"></chat>
</x-app>