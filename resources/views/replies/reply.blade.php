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
    
            <a class="text-sm mb-4">
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
            
            <div class="flex mb-4 py-3">
                <button @click.prevent="$modal.show('add-reply',{'tweetID':{{$reply->tweet->id }},'parentID':{{$reply->id }}})">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-gray-600">
                        <path fill="currentColor" 
                        d="M2 15V5c0-1.1.9-2 2-2h16a2 2 0 012 2v15a1 1 0 01-1.7.7L16.58 17H4a2 2 0 01-2-2zM20 5H4v10h13a1 1 0 01.7.3l2.3 2.29V5z"
                        />
                    </svg>
                </button>
            </div>
            {{-- @include('replies.form',['parentID' => $reply->id]) --}}
        </div>
        
    </div>
    
    @if(isset($replies[$reply->id]))
    <div class="ml-6">
        @include('replies.list',['collection' => $replies[$reply->id]])
    </div>
    @endif

    <add-reply-modal></add-reply-modal>
    
</div>
