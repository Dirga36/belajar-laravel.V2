@extends('layouts.master')

@section('header')
    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
        {{ __('UTAMA page') }}
    </h2>
@endsection

@section('content')
    <section class="antialiased py-8 md:py-16 text-black">
        <div class="mx-auto max-w-screen-xl px-4 lg:px-12 space-y-5">
            @foreach ($posts as $post)
            @endforeach
        </div>
    </section>
@endsection
