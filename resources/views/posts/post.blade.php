@extends('components.layouts.app.article')

@section('content')
    <article class="antialiased text-black">
        <div class="bg-slate-100 dark:bg-slate-700 dark:text-white">
            <div class="flex flex-col p-5">
                <div class="flex flex-row justify-between bg-slate-300">
                    <div class=" p-2">{{ $post->category->name }}</div>
                </div>
                <h1 class="p-2 ">
                    {{ $post->title }}
                </h1>
                <p class=" p-2 italic text-gray-500">{{ $post->created_at->format('Y-m-d') }}</p>
                <div class="p-0  flex justify-stretch lg:flex-row sm:flex-col">
                    <div class="basis-full p-2">
                        <p>{{ $post->body }}</p>
                    </div>
                </div>
                <div class="flex flex-row justify-end">
                    <p class="text-lg text-gray-500 p-2">-{{ $post->user->name }}</p>
                </div>
                <x-pagination />
            </div>
        </div>
    </article>
@endsection
