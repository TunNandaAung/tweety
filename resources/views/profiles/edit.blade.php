<x-app>
    <form action="{{ $user->path() }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PATCH')
        <div class="mx-auto">
            <div class="mb-6">
                <div>
                    <label class="block text-gray-500 font-bold mb-2 pr-4" for="name">
                        Name
                    </label>
                </div>

                <div>
                    <input
                        class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-blue-500"
                        id="name"
                        name="name"
                        type="text"
                        required
                        value="{{ $user->name }}"
                    >
                    @error('name')
                        <span class="text-red-500 text-xs mt-2">{{ $message }}</span>
                    @enderror
                </div>

            </div>

            <div class="mb-6">
                <div>
                    <label class="block text-gray-500 font-bold mb-2 pr-4" for="username">
                        Username
                    </label>
                </div>

                <div>
                    <input
                        class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-blue-500"
                        id="username"
                        name="username"
                        type="text"
                        required
                        value="{{ $user->username }}"
                    >
                    @error('username')
                        <span class="text-red-500 text-xs mt-2">{{ $message }}</span>
                    @enderror

                </div>

            </div>

            <div class="mb-6">
                <div>
                    <label class="block text-gray-500 font-bold mb-2 pr-4" for="username">
                        Avatar
                    </label>
                </div>
                <avatar-form :user="{{ $user }}"></avatar-form>
            </div>

            <div class="mb-6">
                <div>
                    <label class="block text-gray-500 font-bold mb-2 pr-4" for="email">
                        Email
                    </label>
                </div>

                <div>
                    <input
                        class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-blue-500"
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

            <div class="mb-6">
                <div>
                    <label class="block text-gray-500 font-bold mb-2 pr-4" for="password">
                        Password
                    </label>
                </div>

                <div>
                    <input
                        class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-blue-500"
                        id="password"
                        name="password"
                        type="password"
                        required
                    >
                    @error('password')
                     <span class="text-red-500 text-xs mt-2">{{ $message }}</span>
                    @enderror
                </div>

            </div>

            <div class="mb-6">
                    <label class="block text-gray-500 font-bold mb-2 pr-4" for="password_confirmation">
                        Password Confirmation
                    </label>


                <div>
                    <input
                        class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-blue-500"
                        id="password_confirmation"
                        name="password_confirmation"
                        type="password"
                        required
                    >
                    @error('password_confirmation')
                        <span class="text-red-500 text-xs mt-2">{{ $message }}</span>
                    @enderror
                </div>

            </div>



                <div>
                    <div class="md:text-right">
                        <button
                            class="shadow bg-blue-500 hover:bg-blue-400 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded-full"
                            type="submit"
                        >
                            Submit
                        </button>

                        <a
                            class="ml-5     shadow bg-gray-500 hover:bg-gray-400 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded-full"
                            href="{{ $user->path() }}"
                        >
                            Cancel
                        </a>
                    </div>
                </div>
        </div>

    </form>
</x-app>