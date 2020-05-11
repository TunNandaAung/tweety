<div class="w-full">
    <app-infinite-hits>
        
        <template slot="item" slot-scope="{ item }">
            <div class="p-4 hover:bg-gray-200 rounded-lg">
                <div class="flex">
                    <a :href=`/profiles/${item.username}` class="flex flex-1 items-start ">
                        <img
                            :src="item.avatar | getAvatar"
                            width="60"
                            class="mr-4 rounded-full"
                        >
        
                        <div class="flex flex-col items-start">
                            <h4 class="font-bold rounded-full px-2 py-1 -ml-2 bg-transparent hover:bg-blue-500 hover:text-white text-center block" v-text="'@'+item.name"></h4>
                            <span class="font-bold text-sm text-gray-600" v-text="item.username"></span>
                            
                             <p class="mt-3" v-if="item.description">@{{ item.description }}</p>
                            
                        </div>
                    </a>
    
                </div>
            </div>
        </template>
        
    </app-infinite-hits>
    
</div>
        
  