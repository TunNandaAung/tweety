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
            <div class="flex items-baseline mb-2">
                <a href="{{ route('profile',$reply->owner) }}" class="mr-3">
                    <h5 class="font-bold">{{ $reply->owner->name }}</h5>
                </a>
                <span class="font-bold text-sm text-gray-600 mr-3">{{ '@'. $reply->owner->username }}</span>
               
                <span class="text-sm text-gray-600">{{ '. '.$reply->created_at->diffForHumans() }}</span>
            </div>
    
            <a class="text-sm mb-4">
                {!! $reply->body !!}
            </a>
    
            @if($reply->image !== null)
                <div class="mb-6">
                    <img
                        src="{{ asset($reply->image) }}"
                        alt="tweet-image"
                        class="rounded-xl mb-1 h-64 w-full object-cover"
                    >
                </div>
            @endif
            
            <div class="flex items-center pt-2 -ml-2">
                <button class="focus:outline-none text-center hover:text-green-500 hover:bg-green-200 p-2 rounded-xl text-gray-600" 
                    @click.prevent="$modal.show('add-reply',{'tweetID':{{$reply->tweet->id }},'parentID':{{$reply->id }},'owner':{{ $reply->owner }},'parentBody':'{{ $reply->body}}' })"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5">
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
