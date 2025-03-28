<x-layouts.app :title="__('Dashboard')">

    @if (session('success'))
        <div class="p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg" role="alert">
            {{ session('success') }}
        </div>
    @endif

    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        @include('components.main')
        {{ $posts->links() }}
    </div>

</x-layouts.app>
