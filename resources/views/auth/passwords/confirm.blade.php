<x-master>
    <div class="container mx-auto flex justify-center">
        <x-panel>
            <x-slot name="heading">Confirm Password</x-slot>

                {{ __('Please confirm your password before continuing.') }}

                <form method="POST" class="bg-gray-200 shadow-md rounded px-8 pt-6 pb-8 mb-4 mt-6" action="{{ route('password.confirm') }}">
                    @csrf

                    <div class="mb-6">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="password">
                            Password
                        </label>

                        <input class="shadow appearance-none @error('password') border-red-500  @enderror border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                               type="password"
                               name="password"
                               id="password"
                               required
                               autocomplete="current-password"
                        >

                        @error('password')
                            <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-6">
                        <button type="submit"
                                class="shadow bg-blue-500 hover:bg-blue-400 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded-full"
                        >
                            Confirm Password
                        </button>
                    </div>

                    <div>
                        <button type="submit"
                                class="shadow bg-blue-500 hover:bg-blue-400 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded-full"
                        >
                            Submit
                        </button>

                        <a href="{{ route('password.request') }}" class="text-xs text-blue-500 hover:underline">Forgot Your Password?</a>
                    </div>
                </form>
        </x-panel>
    </div>
</x-master>