<div class="p-4 {{ $loop->last  ? '' :  'border-b border-gray-400'}}">

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
    
            <a class="text-sm mb-4">
                {!! $reply->body !!}
            </a>
    
            @if($reply->image !== null)
                <div class="mb-6">
                    <img
                        src="{{ asset($reply->image) }}"
                        alt="tweet-image"
                        class="rounded-lg mb-1 h-64 w-full object-cover"
                    >
                </div>
            @endif
            
            <div class="flex items-center pt-2">
                <button class="focus:outline-none" 
                    @click.prevent="$modal.show('add-reply',{'tweetID':{{$reply->tweet->id }},'parentID':{{$reply->id }},'owner':{{ $reply->owner }},'parentBody':'{{ $reply->body}}' })"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-gray-600">
                        <path fill="currentColor" 
                            d="M18,6v7c0,1.1-0.9,2-2,2h-4v3l-4-3H4c-1.101,0-2-0.9-2-2V6c0-1.1,0.899-2,2-2h12C17.1,4,18,4.9,18,6z"
                        />
                    </svg>
                </button>
            </div>
            {{-- @include('replies.form',['parentID' => $reply->id]) --}}
        </div>
        
    </div>
    
    @if(isset($replies[$reply->id]))
        <div class="ml-6 -mb-4">
            @include('replies.list',['collection' => $replies[$reply->id]])
        </div>
    @endif

    <add-reply-modal></add-reply-modal>
    
</div>
