@if (current_user()->isNot($user))
    <form method="POST" action="/profiles/{{ $user->username }}/follow">
        @csrf
        <button type="submit"
                class="bg-blue-400 rounded-full shadow py-2 px-4 text-white text-xs"
        >
            {{ current_user()->following($user) ? 'Unfollow Me' : 'Follow Me'}}
        </button>
    </form>
@endif