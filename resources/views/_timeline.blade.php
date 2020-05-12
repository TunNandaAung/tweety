<div>

    @forelse($tweets as $tweet)
        <div class="flex p-4 hover:bg-gray-200 
            {{ $loop->first ? 'rounded-t-lg' : '' }} 
            {{ $loop->last ? '' :  'border-b border-gray-400'}}"
        >
        
            @include('_tweet',['bladeCount' => true])
        
        </div>
    @empty
        <p class="p-4 font-normal">No tweets yet!</p>
    @endforelse

    {{ $tweets->links() }}
</div>