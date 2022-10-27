@auth
    @if (current_user()->isNot($user))
        <follow-button :user="@js($user)" :following="{{ current_user()->following($user) ? 1 : 0}} "></follow-button>
    @endif
@endauth