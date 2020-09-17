<x-master>
    <x-panel>

        <form
            class="bg-gray-200 shadow-md rounded px-8 pt-6 pb-8 mb-4 -mt-16"
            method="POST" action="{{ route('register') }}"
        >
            @csrf

            <div class="mb-6 text-xl font-bold">{{ __('Register') }}</div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="name">
                    Name
                </label>

                <input
                    class="shadow appearance-none @error('name') border border-red-500  @enderror border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                    id="name"
                    type="name"
                    name="name"
                    placeholder="John Doe"
                    value="{{ old('name') }}" required autocomplete="name" autofocus
                >

                @error('name')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>

            
            <div class="mb-6">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="username">
                    Username
                </label>

                <input
                    class="shadow appearance-none @error('username') border-red-500  @enderror border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                    id="username"
                    type="username"
                    name="username"
                    placeholder="JohnDoe"
                    value="{{ old('username') }}" required autocomplete="username" autofocus
                >

                @error('username')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="email">
                    Email Address
                </label>

                <input
                    class="shadow appearance-none @error('email')  border-red-500  @enderror border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                    id="email"
                    type="email"
                    name="email"
                    placeholder="john@example.com"
                    value="{{ old('email') }}" required autocomplete="email" autofocus
                >

                @error('email')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="password">
                    Password
                </label>

                <input
                    class="shadow appearance-none @error('password') border border-red-500  @enderror rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline"
                    id="password"
                    type="password"
                    placeholder="******************"
                    name="password" required autocomplete="new-password"
                >

                @error('password')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>

           <div class="mb-6">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="password_confirmation">
                    Confirm Password
                </label>

                <input
                    class="shadow appearance-none @error('password') border border-red-500  @enderror rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline"
                    id="password_confirmation"
                    type="password"
                    placeholder="******************"
                    name="password_confirmation" required autocomplete="new-password"
                >

                @error('password_confirmation')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror

            </div>

            <div class="flex items-center justify-end">

                <button
                    class="shadow bg-blue-500 hover:bg-blue-400 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded-full"
                    type="submit"
                >
                    Register
                </button>

            </div>

        
        </form>

    </x-panel>

</x-master>