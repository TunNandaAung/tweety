<x-app>
    <div class="flex p-4 border border-gray-300 rounded-xl hover:bg-gray-200">
            @include("_tweet")
    </div>

    <hr class="mb-6 mt-6">

    <h3 class="text-lg font-bold mb-6"> Replies <span class="text-sm text-gray-600">(Only relevant replies are shown.)</span></h3>

    <div>

    </div>
    
    <div class="border border-gray-300 rounded-xl">
        <reply
            :reply="{{ $reply }}"
            :tweet="{{ $tweet}}"
            :last="true"
            :index="1"
        ></reply>
    </div>
</x-app>