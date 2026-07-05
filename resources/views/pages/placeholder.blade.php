@extends('layouts.app')

@section('content')
<div class="min-h-[calc(100vh-16rem)] flex items-center justify-center bg-gradient-to-br from-indigo-500 via-purple-500 to-pink-500">
    <div class="text-center text-white px-4 sm:px-6 lg:px-8">
        <h1 class="text-4xl sm:text-5xl lg:text-6xl font-bold mb-4">
            {{ __('Crafted interiors, coming soon.') }}
        </h1>
        <p class="text-xl sm:text-2xl mb-2 opacity-90">
            {{ __('Our new website is on its way.') }}
        </p>
        <p class="text-sm sm:text-base opacity-80 mt-8">
            {{ __('Call us: +962 6 553 1177 · info@pid-jo.com') }}
        </p>
    </div>
</div>
@endsection
