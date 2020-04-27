<x-app>

    @if ($unreadNotifications->count())
        <h1 class="text-blue-800 font-bold text-xl mb-4">New Notifications</h1>

        @foreach ($unreadNotifications as $date => $unreadNotifications)
            <div class="mb-6 text-right">
                <span class="px-5 py-3 rounded-xl border border-blue-500 text-blue-700 shadow-lg font-semibold text-lg">{{ $date }}</span>
            </div>

            @foreach ($unreadNotifications as $unreadNotification) 
            <div class="flex bg-white shadow p-4 rounded-xl mb-4 border border-gray-300">
                
                <div class="flex w-full">
                
                    @include("notifications._".get_notification_view($unreadNotification->type),['notification' => $unreadNotification])
                                
                
                    <div class="flex-1 text-right tracking-tight">
                        {{-- <h3 class="font-semibold broder border-r-4 {{ get_notification_color($unreadNotification->type) }} p-2">{{ $unreadNotification->created_at->format('M d') }} </h3> --}}
                        <span class="text-gray-700 font-bold broder border-r-4 {{ get_notification_color($unreadNotification->type) }} p-2">{{ $unreadNotification->created_at->diffForHumans() }}</span>
                    </div>
                        
                </div>
            
            </div>
                
            @endforeach

            <hr class="mb-6 mt-6 text-gray-800 h-1">
        @endforeach
    @endif

    @if ($readNotifications->count())
        <h1 class="text-gray-800 font-bold text-xl mb-4">Older</h1>
        
        @foreach ($readNotifications as $date => $readNotifications)
            <div class="mb-6 text-right">
                <span class="px-5 py-3 rounded-xl border border-blue-500 text-blue-700 shadow-lg font-semibold text-lg">{{ $date }}</span>
            </div>
        
            @foreach ($readNotifications as $readNotification) 
            
            <div class="flex bg-white shadow p-4 rounded-xl mb-4 border border-gray-300">
                
                <div class="flex w-full">
                
                    @include("notifications._".get_notification_view($readNotification->type),['notification' => $readNotification])
                                
                
                    <div class="flex-1 text-right tracking-tight">
                        {{-- <h3 class="font-semibold broder border-r-4 {{ get_notification_color($readNotification->type) }} p-2">{{ $readNotification->created_at->format('M d') }} </h3> --}}
                        <span class="text-gray-700 font-bold broder border-r-4 {{ get_notification_color($readNotification->type) }} p-2">{{ $readNotification->created_at->diffForHumans() }}</span>
                    </div>
                        
                </div>
            
            </div>
            @endforeach

            <hr class="mb-6 mt-6 text-gray-800 h-1">
        @endforeach
    @endif

    
</x-app>