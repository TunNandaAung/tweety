<div class="border border-blue-400 rounded-lg py-6 px-8 mb-8">
    <form method="POST" action="/tweets">
        @csrf

        <textarea
            name="body"
            class="w-full focus:outline-none focus:placeholder-gray-700"
            placeholder="What's up doc?"
            autofocus
        ></textarea>

        @error('body')
            <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
        @enderror

        <hr class="mb-4">

        <footer class="flex items-center justify-between">
            <img
                src="{{ auth()->user()->avatar }}"
                alt="Your Avatar"
                class="rounded-full mr-2"
                width="50"
                height="50"
            >
            <button type="submit" class="bg-blue-500 rounded-full shadow text-sm px-10 text-white hover:bg-blue-600 h-10">
                Publish
            </button>

        </footer>

    </form>
</div>