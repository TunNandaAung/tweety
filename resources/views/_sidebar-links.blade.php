<ul class="flex flex-col items-start">

    <li>
        <a class="font-bold text-lg mb-4 block rounded-full bg-transparent px-2 py-1 hover:bg-blue-500 hover:text-white text-center" href="{{ route('home') }}">
            Home
        </a>
    </li>

    <li>
        <a class="font-bold text-lg mb-4 block rounded-full bg-transparent px-2 py-1 hover:bg-blue-500 hover:text-white text-center" href="/explore">
            Explore
        </a>
    </li>

    <li>
        <a class="font-bold text-lg mb-4 block rounded-full bg-transparent px-2 py-1 hover:bg-blue-500 hover:text-white text-center" href="#">
            Notifications
        </a>
    </li>

    <li>
        <a class="font-bold text-lg mb-4 block rounded-full bg-transparent px-2 py-1 hover:bg-blue-500 hover:text-white text-center" href="#">
            Messages
        </a>
    </li>

    <li>
        <a class="font-bold text-lg mb-4 block rounded-full bg-transparent px-2 py-1 hover:bg-blue-500 hover:text-white text-center" href="#">
            Bookmarks
        </a>
    </li>

    <li>
        <a class="font-bold text-lg mb-4 block rounded-full bg-transparent px-2 py-1 hover:bg-blue-500 hover:text-white text-center" href="#">
            Lists
        </a>
    </li>

    <li>
        <a class="font-bold text-lg mb-4 block rounded-full bg-transparent px-2 py-1 hover:bg-blue-500 hover:text-white text-center" href="{{ route('profile',auth()->user()) }}">
            Profile
        </a>
    </li>

    <li>
        <a class="font-bold text-lg mb-4 block rounded-full bg-transparent px-2 py-1 hover:bg-blue-500 hover:text-white text-center" href="#">
            More
        </a>
    </li>

    <form method="POST" action="/logout">
        @csrf
        <li>
            <button
                class="font-bold text-lg mb-4 block rounded-full bg-transparent px-2 py-1 hover:bg-red-600 hover:text-white text-center"
                type="Submit"
            >
                Logout
            </button>
        </li>

    </form>
</ul>