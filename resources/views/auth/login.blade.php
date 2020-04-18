<x-master>

    <div class="w-full max-w-sm mx-auto">

        <form
            class="bg-gray-200 shadow-md rounded px-8 pt-6 pb-8 mb-4"
            method="POST" action="{{ route('login') }}"
        >
            @csrf

            <div class="mb-6 text-xl font-bold">{{ __('Login') }}</div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="email">
                    Email Address
                </label>

                <input
                    class="shadow appearance-none @error('email') border border-red-500  @enderror border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
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
                    Password
                </label>

                <input
                    class="shadow appearance-none @error('password') border border-red-500  @enderror rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline"
                    id="password"
                    type="password"
                    placeholder="******************"
                    name="password" required autocomplete="current-password"
                >

                @error('password')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                <label class="form-check-label" for="remember">
                    {{ __('Remember Me') }}
                </label>
            </div>

            <div class="flex items-center justify-between mb-6">

                <button
                    class="shadow bg-blue-500 hover:bg-blue-400 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded-full"
                    type="submit"
                >
                    Login
                </button>

                @if (Route::has('password.request'))
                    <a class="inline-block align-baseline font-bold text-sm text-blue-500 hover:text-blue-800" href="{{ route('password.request') }}">
                        {{ __('Forgot Your Password?') }}
                    </a>
                @endif

            </div>

            
            <p class="text-center text-gray-700 text-sm">
                Don't have an account? <a href="/register" class="text-blue-500 hover:underline">Register now!</a>.
            </p>

        </form>

        <p class="text-center text-gray-500 text-xs">
            &copy;2020 Tweety. All rights reserved.
        </p>

    </div>

</x-master>
