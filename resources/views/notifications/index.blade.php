<x-app>
    @foreach ($notifications as $notification) 
    <div class="flex bg-white shadow p-4 rounded-xl mb-4 border border-gray-300">
        
        <div class="flex w-full">
           
            @include("notifications._".get_notification_view($notification->type))
                           
           
            <div class="flex-1 text-right tracking-tight">
                <h3 class="font-semibold broder border-r-4 {{ get_notification_color($notification->type) }} p-2">{{ $notification->created_at->format('M d') }} </h3>
                <span class="text-gray-700 text-sm font-bold">{{ $notification->created_at->diffForHumans() }}</span>
            </div>
                
        </div>
      
    </div>
        
    @endforeach
</x-app>