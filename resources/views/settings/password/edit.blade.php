<x-app>
    <form action="{{ $user->path('password') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PATCH')
        <div class="mx-auto">
            <h2 class="text-xl font-bold mb-6 text-blue-500">Update Password</h2>

            <div class="mb-6">
                <div>
                    <label class="block text-gray-500 font-bold mb-2 pr-4" for="password">
                        Current Password
                    </label>
                </div>

                <div>
                    <input
                        class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-blue-500"
                        id="current_password"
                        name="current_password"
                        type="password"
                        required
                    >
                    @error('current_password')
                        <span class="text-red-500 text-xs mt-2">{{ $message }}</span>
                    @enderror
                </div>

            </div>
            <div class="mb-6">
                <label class="block text-gray-500 font-bold mb-2 pr-4" for="new_password">
                   New Password
                </label>


            <div>
                <input
                    class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-blue-500"
                    id="new_password"
                    name="new_password"
                    type="password"
                    required
                >
                @error('new_password')
                    <span class="text-red-500 text-xs mt-2">{{ $message }}</span>
                @enderror
            </div>

        </div>

            <div class="mb-6">
                    <label class="block text-gray-500 font-bold mb-2 pr-4" for="new_password_confirmation">
                       Confirm New Password
                    </label>


                <div>
                    <input
                        class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-blue-500"
                        id="new_password_confirmation"
                        name="new_password_confirmation"
                        type="password"
                        required
                    >
                    @error('new_password_confirmation')
                        <span class="text-red-500 text-xs mt-2">{{ $message }}</span>
                    @enderror
                </div>

            </div>

                <div>
                    <div class="md:text-right">
                        <button
                            class="shadow bg-blue-500 hover:bg-blue-600 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded-full"
                            type="submit"
                        >
                            Update
                        </button>

                        <a
                            class="ml-5 shadow bg-gray-700 hover:bg-gray-800 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded-full"
                            href="{{ $user->path() }}"
                        >
                            Cancel
                        </a>
                    </div>
                </div>
        </div>

    </form>
</x-app>    