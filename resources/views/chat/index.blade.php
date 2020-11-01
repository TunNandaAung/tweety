<x-app>
    @foreach ($chats as $chat)
        @include('chat._chat-list',$chat)
    @endforeach
</x-app>