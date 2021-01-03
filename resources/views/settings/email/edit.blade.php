<x-app>
    <form action="{{ $user->path('email') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PATCH')
        <div class="mx-auto">
            <h2 class="text-xl font-bold mb-6 text-blue-500">Account</h2>
            
            <div class="mb-6">
                <div>
                    <label class="block text-gray-500 font-bold mb-2 pr-4" for="email">
                        Email
                    </label>
                </div>

                <div>
                    <input
                        class="bg-gray-200 appearance-none border-2 border-gray-200 rounded-xlw-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-blue-500"
                        id="email"
                        name="email"
                        type="email"
                        required
                        value="{{ $user->email }}"
                    >
                    @error('email')
                        <span class="text-red-500 text-xs mt-2">{{ $message }}</span>
                    @enderror
                </div>

            </div>

            <div>
                <div class="md:text-right">
                    <button
                        class="shadow bg-blue-500 hover:bg-blue-600 focus:ring focus:outline-none text-white font-bold py-2 px-4 rounded-full"
                        type="submit"
                    >
                        Update
                    </button>

                    <a
                        class="ml-5 shadow bg-gray-700 hover:bg-gray-800 focus:ring focus:outline-none text-white font-bold py-2 px-4 rounded-full"
                        href="{{ $user->path() }}"
                    >
                        Cancel
                    </a>
                </div>
            </div>
        </div>

    </form>
</x-app>