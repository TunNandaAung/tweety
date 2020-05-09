<x-app>
    <tabs class="mb-4">
        <tab title="Followers">
            @if($followers->count())
                @include('_user-list',['users' => $followers])
            @else
                <h4 class="font-semibold text-lg text-left text-center">{{'@'.$username }} doesn't have any followers yet!</h4>
            @endif
        </tab>
       <tab title="Following" :active="{{ $viewFollowers ? 'false' : 'true'}}">
            @if($followings->count())
                @include('_user-list',['users' => $followings])
            @else
                <h4 class="font-semibold text-lg text-left text-center">{{'@'.$username }} isn't following anyone!</h4>
            @endif
        </tab>
    </tabs>      
</x-app>