<div class="flex text-center mb-4 border-b border-gray-400" role="tablist">
    <button 
        class="px-4 py-2 bg-white flex-1 cursor-pointer focus:outline-none"   
        :class="{ 'border-b-2 border-blue-600': showTweetHits }"
        :style="showTweetHits ? 'margin-bottom: -1px' : ''" 
        @click.prevent="searchTweets" 
        type="button"
    >
        <span
            class="focus:outline-none text-lg text-gray-700"
            role="tab"
            :class="{ 'font-bold text-blue-600': showTweetHits }"
            :aria-selected="showTweetHits"
        >
            Tweets
        </span>
    </button>
    
    <button 
        class="px-4 py-2 bg-white flex-1 cursor-pointer focus:outline-none"    
        @click.prevent="searchUsers" 
        :class="{ 'border-b-2 border-blue-600': showUserHits }"
        :style="showUserHits ? 'margin-bottom: -1px' : ''"
        type="button"
    >
        <span
            class="focus:outline-none text-lg text-gray-700"
            role="tab"
            :class="{ 'font-bold text-blue-600': showUserHits }"
            :aria-selected="showUserHits"
        >
            Users
        </span>
    </button>
    
</div>