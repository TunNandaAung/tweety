@foreach($collection as $reply)
   {{-- @include('replies.reply')  --}}
   <reply :reply="{{ $reply }}" :tweet="{{ $tweet}}" :last="{{ $loop->last == 1 ? 'true' : 'false'}}">
      
      @if(isset($reply->children))
        <div class="ml-6 -mb-4">
            @include('replies.list',['collection' => $reply->children])
        </div>
    @endif
   </reply>
@endforeach
