<x-master>
    <div class="w-full mx-auto p-6">
        <h2 class="font-semibold text-xl text-center">  
            Enter the email address associated with your account and we will send a link to reset your password.
        </h2>
    </div>

    <x-panel>
            
        <form class="bg-gray-200 shadow-md rounded-xl px-8 pt-6 pb-8 mb-4" 
            method="POST" action="{{ route('password.email') }}"
        >
            @csrf
            
            <div class="mb-6 text-xl font-bold">Reset password</div>
            
            
            <div class="mb-6">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="email">
                    Email Address
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

            <div class="flex items-center justify-end">
                <button type="submit"
                        class="shadow bg-blue-500 hover:bg-blue-400 focus:ring focus:outline-none text-white font-bold py-2 px-4 rounded-full"
                >
                    Send Reset Password Link
                </button>
            </div>
        </form>
            
    </x-panel>        
        @if (session('status'))
            <h2 class="font-semibold text-lg text-center text-green-400" role="alert">  
                {{ session('status') }}
            </h2>
        @endif
</x-master>
