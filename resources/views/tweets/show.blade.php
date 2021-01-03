<x-app>
    <div class="flex p-4 border border-gray-300 rounded-xl">

        @include("_tweet")
    </div>

    <hr class="mb-6 mt-6">

    <h3 class="text-lg font-bold mb-6"> Replies</h3>

    {{-- @if($replies->count())
        <div class="border border-gray-300 rounded-xl">
            @include('replies.list',['collection' => $replies])
        </div>
    @else
        No comments yet!
    @endif --}}
    <div>
        @include('replies.list')
    </div>
    {{-- @include('replies.form') --}}
    
    <x-slot name="extra">
        <portal-target name="add-reply" slim>  </portal-target>
    </x-slot>
</x-app>