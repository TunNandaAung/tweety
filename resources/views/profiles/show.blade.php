@extends('layouts.app')

@section('content')

    <header class="mb-6 relative">

        <img
            src="/images/default-profile-banner.jpg"
            alt="profile banner"
            class="rounded-lg mb-2"
        >

        <div class="flex justify-between items-center mb-4">
            <div>
                <h2 class="font-bold text-2xl mb-0">{{ $user->name }}</h2>
                <p class="text-sm">Joined {{ $user->created_at->diffForHumans() }}</p>
            </div>

            <div>
                <a class="bg-white rounded-full border border-gray-300 py-2 px-4 text-black text-xs mr-2">Edit Profile</a>

                <a class="bg-blue-400 rounded-full shadow py-2 px-4 text-white text-xs">Follow Me</a>

            </div>
        </div>

        <p class="text-sm">Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit.</p>

        <img
            src="{{ auth()->user()->avatar }}"
            alt=""
            class="rounded-full mr-2 absolute"
            style="width: 150px;left: calc(50% - 75px);top: 138px"
        >

    </header>

    @include('_timeline',[
        'tweets' => $user->tweets
    ])

@endsection
