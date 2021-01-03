<x-app>
    <ais-instant-search
        :search-client="searchClient"
        :index-name="indexName"
    >
        <ais-configure
            query="{{ request('q') }}"
        />
        <div class="mb-3 -mt-26">
            
            <ais-search-box show-loading-indicator>
                
                <div slot-scope="{ currentRefinement, isSearchStalled, refine }" class="text-center p-4 relative">
                    <div class="absolute inset-y-0 left-0 pl-6 flex items-center pointer-events-none">
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 20 20"
                            class="text-gray-600 w-4 h-4"
                            fill="currentColor"
                        >
                            <path
                            d="M12.9 14.32a8 8 0 111.41-1.41l5.35 5.33-1.42 1.42-5.33-5.34zM8 14A6 6 0 108 2a6 6 0 000 12z"
                            />
                        </svg>
                        </div>
        
                    <input
                        placeholder="Search..."
                        type="search"
                        v-model="currentRefinement"
                        class="bg-gray-200 appearance-none border-2 pl-8 border-gray-200 w-full rounded-xl py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-blue-500"
                        @input="refine($event.currentTarget.value)"
                    >
                    <span :hidden="!isSearchStalled" class="-ml-6 loader"></span>

                </div>
                    
                
        
            </ais-search-box>

        </div>

        <ais-powered-by class="mb-3 flex justify-end mr-5"></ais-powered-by>        

        {{-- <tabs class="mb-4" :should-update-url="false" @updated="updateIndex">
            <tab title="Tweets">
                @include('search._tweet-hits')        
            </tab>
            
            <tab title="Users">
                @include('search._user-hits')
            </tab>
           
        </tabs>  --}}

        @include('search._tabs')

        
        <div v-if="showTweetHits">
            @include('search._tweet-hits') 
        </div>

        <div v-else>
            @include('search._user-hits')
        </div>
            
    </ais-instant-search>
</x-app>