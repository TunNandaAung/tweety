<x-app>
    <div class="flex p-4 border border-gray-300 rounded-lg">

        @include("_tweet")
    </div>

    <hr class="mb-6 mt-6">

    <h3 class="text-lg font-bold mb-6"> Comments</h3>

    {{-- @if($replies->count())
        <div class="border border-gray-300 rounded-lg">
            @include('replies.list',['collection' => $replies])
        </div>
    @else
        No comments yet!
    @endif --}}
    <div>
        @include('replies.list')
    </div>
    @include('replies.form')
</x-app>