<x-app>
    <ais-instant-search
        :search-client="searchClient"
        index-name="tweets"
    >
    <ais-configure
        query="{{ request('q') }}"
    />
         <div class="mb-10">
                
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
                        class="bg-gray-200 appearance-none border-2 pl-8 border-gray-200 w-full rounded-lg py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-blue-500"
                        @input="refine($event.currentTarget.value)"
                    >
                    <span :hidden="!isSearchStalled" class="-ml-6 loader"></span>
                </div>
                  
               

            </ais-search-box>
                
                {{-- <div class="widget bg-grey-lightest border p-4">
                    <h4 class="widget-heading">
                        Filter By Channel
                    </h4>

                    <div class="panel-body">
                        <ais-refinement-list attribute-name="channel.name"></ais-refinement-list>
                    </div>
                </div> --}}
        </div>
     
            <div class="w-full">
                <ais-hits>
                    
                    <template slot="item" slot-scope="{ item }">
                        <div class="flex p-4 hover:bg-gray-200 rounded-lg">
                            
                            <div class="mr-2 flex-shrink-0">
                                <img
                                    :src="item.user.avatar | getAvatar"
                                    alt=""
                                    class="rounded-full mr-2"
                                    width="40"
                                    height="40"
                                >
                            </div>
                        
                            <div class="flex-1">
                                <div class="flex items-baseline mb-2">
                                    <a :href=`/profiles/${item.user.username}` class="mr-3">
                                        <h5 class="font-bold" v-text="item.user.name"></h5>
                                    </a>
                                    <span class="font-bold text-sm text-gray-600 mr-3" v-text="item.user.username"></span>
                                
                                    <span class="text-sm text-gray-600"> @{{ item.created_at | diffForHumans }}</span>
                                </div>
                                
                                <a class="mb-4" :href="item.path" v-html="item.body"></a>
                        
                        
                                <div class="flex items-center text-center -ml-2">
                                    
                                    <like-buttons :subject="item" name="tweets" class="mr-2"></like-buttons>
                                    <button
                                            class="focus:outline-none text-center hover:text-green-600 hover:bg-green-200 p-2 rounded-lg text-gray-600 flex items-center"
                                        >
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-1">
                                                <path
                                                    fill="currentColor"
                                                    d="M18,6v7c0,1.1-0.9,2-2,2h-4v3l-4-3H4c-1.101,0-2-0.9-2-2V6c0-1.1,0.899-2,2-2h12C17.1,4,18,4.9,18,6z"
                                                />
                                            </svg>
                                            <span class="text-xs">@{{ item.replies_count }}</span>
                                        </button>    
                                    
                                </div>
                            </div>
                        </div>
                    </template>
                    
                </ais-hits>
                
            </div>
        
    </ais-instant-search>
</x-app>