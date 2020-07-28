<x-app>
    <div class="mx-auto">
        <h2 class="text-xl font-bold mb-6 text-blue-500">Account Settings</h2>

        <a class="px-5 py-3 rounded-lg border border-blue-500 
                text-blue-500 shadow font-semibold text-lg flex justify-between 
                items-center hover:bg-blue-400 hover:text-white hover:border-transparent
                cursor-pointer"
            href="{{ $user->path('password/edit') }}"
        >
            Update password
            <svg fill="currentColor" viewBox="0 0 20 20" class="w-8">
                <path fill-rule="evenodd" 
                    d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" 
                    clip-rule="evenodd"
                >
                </path>
            </svg>
        </a>
    </div>
</x-app>