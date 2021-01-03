   <div class="mr-2 flex-shrink-0">
        <a href="{{ route('profile',$tweet->user) }}">
            <img
                src="{{ $tweet->user->avatar }}"
                alt=""
                class="rounded-full mr-2"
                width="40"
                height="40"
            >
        </a>
    </div>

    <div class="flex-1">
        <div class="flex items-baseline lg:items-center mb-2">
          <div class="lg:flex flex-1">
            <a href="{{ route('profile',$tweet->user) }}" class="mr-3">
                <h5 class="text-sm md:text-base font-bold">{{ $tweet->user->name }}</h5>
            </a>
            <span class="font-bold text-xs md:text-sm text-gray-600 mr-3">{{ '@'. $tweet->user->username }}</span>
          </div>
           
            <span class="text-xs md:text-sm text-gray-600 ">{{ '. '.$tweet->created_at->diffForHumans() }}</span>
        </div>
        
        <h3 class="mb-2">
            {!! $tweet->body !!}
        </h3>

        @if($tweet->image !== null)
            <div class="mt-2 mb-3">
                <img
                    src="{{ asset($tweet->image) }}"
                    alt="tweet-image"
                    class="rounded-xl mb-1 h-64 w-full object-cover shadow-xl"
                    width="50"
                    height="50"
                >
            </div>
        @endif

        {{-- <x-like-buttons :tweet="$tweet"></x-like-buttons> --}}
        <div class="flex items-center text-center -ml-2">
            
            <like-buttons :subject="{{ $tweet }}" name="tweets" class="mr-2"></like-buttons>
            @if(isset($bladeCount))
                <button
                    class="focus:outline-none text-center hover:text-green-600 hover:bg-green-200 p-2 rounded-xl text-gray-600 flex items-center"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-1">
                        <path
                            fill="currentColor"
                            d="M18,6v7c0,1.1-0.9,2-2,2h-4v3l-4-3H4c-1.101,0-2-0.9-2-2V6c0-1.1,0.899-2,2-2h12C17.1,4,18,4.9,18,6z"
                        />
                    </svg>
                    <span class="text-xs">{{ $tweet->replies_count }}</span>
                </button>    
            @else            
                <reply-button :count="{{ $tweet->replies_count }}"></reply-button>
            @endif

        </div>
    </div>
    <div>

       @can('edit',$tweet->user)
            <dropdown align="right" width="200px" v-cloak>
                <template v-slot:trigger>
                    <button
                        class="flex items-center text-default no-underline text-sm focus:outline-none"
                        v-pre
                        
                    >
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="h-6 w-6 text-gray-700">
                            <path fill="currentColor" d="M15.3 9.3a1 1 0 0 1 1.4 1.4l-4 4a1 1 0 0 1-1.4 0l-4-4a1 1 0 0 1 1.4-1.4l3.3 3.29 3.3-3.3z"/>
                        </svg>
                    
                    </button>
                </template>


                <button type="submit" class="px-2 py-2 w-full text-left class text-red-500 rounded-xlhover:bg-red-600 hover:text-white"  @click.prevent="$modal.show('confirm-delete-tweet',{'id':{{$tweet->id }}})">
                    Delete
                </button>

            </dropdown>
       @endcan
    </div>

    @can('edit',$tweet->user)
     <delete-tweet-modal></delete-tweet-modal>
    @endcan