<div class="w-full">
    <app-infinite-hits>
        
        <template slot="item" slot-scope="{ item }">
            <div class="flex p-4 hover:bg-gray-200 rounded-xl">
                
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
                        <span class="font-bold text-sm text-gray-600 mr-3" v-text="'@'+item.user.username"></span>
                    
                        <span class="text-sm text-gray-600"> @{{ item.created_at | diffForHumans }}</span>
                    </div>
                    
                    <a class="mb-4" :href="item.path" v-html="item.body"></a>
            
            
                    <div class="flex items-center text-center -ml-2">
                        
                        <like-buttons :subject="item" name="tweets" class="mr-2"></like-buttons>
                        <button
                                class="focus:outline-none text-center hover:text-green-600 hover:bg-green-200 p-2 rounded-xl text-gray-600 flex items-center"
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
        
    </app-infinite-hits>
    
</div>
        
  