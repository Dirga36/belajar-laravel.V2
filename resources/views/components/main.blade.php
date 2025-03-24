<section class="antialiased py-8 md:py-16 text-black">
    <div class="mx-auto max-w-screen-xl px-4 lg:px-12 space-y-5">
        @foreach ($posts as $post)
            <div
                class="text-black bg-slate-100 dark:bg-slate-700 dark:text-white rounded-sm border border-slate-400 hover:border-none hover:drop-shadow-lg">
                <div class="flex flex-col p-5">
                    <div class="flex flex-row justify-between border-b-2 border-black">
                        <div class=" p-2">{{ $post->category->name }}</div>
                        <div class=" p-2">{{ $post->created_at->diffForHumans() }}</div>
                    </div>
                    <h1 class="p-2">
                        {{ $post->title }}
                    </h1>
                    @if (Auth::check() && Auth::user()->id == $post->user_id)
                        <p class=" p-2 italic text-gray-500">You</p>
                    @else
                        <p class=" p-2 text-gray-500">{{ $post->user->name }}</p>
                    @endif
                    <div class="p-0  flex justify-stretch lg:flex-row sm:flex-col">
                        @if ($post->image)
                            <div class="basis-1/4 p-0 content-center justify-center">
                                <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->title }}"
                                    class="object-cover w-full h-fit border border-slate-700 dark:border-slate-300">
                            </div>
                        @endif
                        <div class="basis-full p-2">
                            <p>{{ Str::limit($post->body, 150) }}</p>
                        </div>
                    </div>
                    <div class="flex flex-row justify-end">
                        @if (Auth::check() && Auth::user()->id == $post->user_id)
                            <a href='{{ route('post.edit', $post['id']) }}'
                                class="text-yellow-500 hover:underline">Edit</a>
                            <form action="{{ route('post.destroy', $post['id']) }}" method="POST" class="inline ml-4">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:underline">Delete</button>
                            </form>
                        @endif
                        <a href='{{ route('post.show', $post['id']) }}' class="ml-4 text-blue-600 hover:underline">Read more
                            &raquo;</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</section>
