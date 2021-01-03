<x-master>
    
    <x-panel>
        <form class="bg-gray-200 shadow-md rounded-xl px-8 pt-6 pb-8 mb-4" 
            method="POST" 
            action="{{ route('password.update') }}"
        >
            @csrf

            <input type="hidden" name="token" value="{{ $token }}">

            <div class="mb-6 text-xl font-bold">Reset Password</div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="email">
                    Email
                </label>

                <input
                    class="shadow appearance-none @error('email') border border-red-500  @enderror border rounded-xl w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring"
                    id="email"
                    type="email"
                    name="email"
                    placeholder="you@example.com"
                    value="{{ old('email') }}" required autocomplete="email" autofocus
                >

                @error('email')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="password">
                   New Password
                </label>

                <input
                    class="shadow appearance-none @error('password') border border-red-500  @enderror rounded-xl w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:ring"
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
                    class="shadow appearance-none @error('password') border border-red-500  @enderror rounded-xl w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:ring"
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
                    class="shadow bg-blue-500 hover:bg-blue-400 focus:ring focus:outline-none text-white font-bold py-2 px-4 rounded-full"
                    type="submit"
                >
                    Reset Password
                </button>

            </div>

        </form>
        
    </x-panel>
</x-master>
