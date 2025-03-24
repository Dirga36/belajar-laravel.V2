<x-layouts.app :title="__('Dashboard')">
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        <div class="relative h-full flex-1 overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Add a post') }}
            </h2>
            <section class="antialiased py-8 md:py-16 text-black">
                <div class="mx-auto max-w-screen-xl px-4 lg:px-12 space-y-5">
                    <form action="{{ route('posts.store') }}" method="POST" class="space-y-4"
                        enctype="multipart/form-data">
                        @csrf
                        <div>
                            <!-- Title input field -->
                            <label for="title"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300">Title</label>
                            <input type="text" name="title" id="title"
                                class="mt-1 block w-full bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white"
                                placeholder="Title" required>
                        </div>
                        <div>
                            <!-- Body textarea field -->
                            <label for="body"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300">Body</label>
                            <textarea name="body" id="body"
                                class="mt-1 block w-full bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white"
                                placeholder="Body" required></textarea>
                        </div>
                        <div>
                            <!-- Category select field -->
                            <label for="category_id"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300">Category</label>
                            <select name="category_id" id="category_id"
                                class="mt-1 block w-full bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-slate-600 focus:border-blue-600 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white"
                                required>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" class="bg-gray-50">{{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <!-- Image file input field -->
                            <label for="image"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300">Image</label>
                            <input type="file" name="image" id="image"
                                class="mt-1 block w-full bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white">
                        </div>
                        <div class="flex justify-end">
                            <!-- Submit button -->
                            <button type="submit"
                                class="px-4 py-2 bg-primary-700 text-black dark:text-white rounded-lg hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                                Add Post
                            </button>
                        </div>
                    </form>
                </div>
            </section>
        </div>
    </div>
</x-layouts.app>
