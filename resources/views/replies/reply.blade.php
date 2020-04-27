<div class="p-4 {{ $loop->last ? '' :  'border-b border-gray-400'}}">

    <div class="flex">
        <div class="mr-2 flex-shrink-0">
            <a href="{{ route('profile',$reply->owner) }}">
                <img
                    src="{{ $reply->owner->avatar }}"
                    alt=""
                    class="rounded-full mr-2"
                    width="50"
                    height="50"
                >
            </a>
        </div>
    
        <div class="flex-1">
            <a href="{{ route('profile',$reply->owner) }}">
                <h5 class="font-bold mb-4">{{ $reply->owner->name }}</h5>
            </a>
    
            <a class="text-sm mb-3" href="{{ route('show-tweet',$reply) }}">
                {!! $reply->body !!}
            </a>
    
            @if($reply->image !== null)
                <div class="mb-3">
                    <img
                        src="{{ asset($reply->image) }}"
                        alt="tweet-image"
                        class="rounded-lg mb-1 h-64 w-full object-cover"
                        width="50"
                        height="50"
                    >
                </div>
            @endif
            
            {{-- @include('replies.form',['parentID' => $reply->id]) --}}
        </div>
        
    </div>
    
    @if(isset($replies[$reply->id]))
    <div class="ml-6">
        @include('replies.list',['collection' => $replies[$reply->id]])
    </div>
    @endif
    
</div>
