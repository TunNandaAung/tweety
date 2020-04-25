<x-app>
    @foreach ($notifications as $notification) 
    <div class="flex bg-white shadow p-4 rounded-xl mb-4 border border-gray-300">
        
        <div class="flex w-full">
           
            @include("notifications._".Str::of($notification->type)->substr(18, Str::of($notification->type)->length())->lower())
                           
           
            <div class="flex-1 text-right tracking-tight">
                <h3 class="font-semibold broder border-r-4 border-blue-400 p-2 rounded">{{ $notification->created_at->format('M d') }} </h3>
                <span class="text-gray-700 text-sm font-bold">{{ $notification->created_at->diffForHumans() }}</span>
            </div>
                
        </div>
      
    </div>
        
    @endforeach
</x-app>