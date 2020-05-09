<x-app>
    <div>
        @include('_user-list')
        
        {{ $users->links() }}
    </div>
</x-app>