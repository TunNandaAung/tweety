<x-app>
    <ais-instant-search
        :search-client="searchClient"
        index-name="tweets"
    >
    <ais-configure
        query="{{ request('q') }}"
    />
        <div class="flex py-6">
            <div class="mr-10">
                <div class="widget bg-grey-700 border p-4">
                    <h4 class="widget-heading">Search</h4>

                    <ais-search-box>
                        <div slot-scope="{ currentRefinement, isSearchStalled, refine }">
                            <input
                              type="search"
                              v-model="currentRefinement"
                              @input="refine($event.currentTarget.value)"
                            >
                            <span :hidden="!isSearchStalled">Loading...</span>
                          </div>
                    </ais-search-box>
                </div>

                {{-- <div class="widget bg-grey-lightest border p-4">
                    <h4 class="widget-heading">
                        Filter By Channel
                    </h4>

                    <div class="panel-body">
                        <ais-refinement-list attribute-name="channel.name"></ais-refinement-list>
                    </div>
                </div> --}}
            </div>

            <div class="w-3/4">
                <ais-hits>
                    <template slot="item" slot-scope="{ item }">
                        <a :href="item.path" class="text-blue-500 link">
                            <h1><ais-highlight :hit="item" attribute="body" /></h1>
                            <p><ais-highlight :hit="item" attribute="user.username" /></p>
                        </a>
                    </template>
                  </ais-hits>
            </div>
        </div>
    </ais-instant-search>
</x-app>