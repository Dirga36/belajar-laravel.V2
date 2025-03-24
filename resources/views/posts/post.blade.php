<x-layouts.app :title="__('Edit Post')">
    <section class="antialiased py-8 md:py-16 text-black">
        <div class="mx-auto max-w-screen-xl px-4 lg:px-12 space-y-5">
            <div
                class="text-black bg-slate-100 dark:bg-slate-700 dark:text-white rounded-lg border border-slate-400 hover:border-none hover:drop-shadow-lg dark:hover:drop-shadow-none">
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
        </div>
    </section>
</x-layouts.app>
