<x-layouts.app.sidebar :title="__('Admin Dashboard')">
    <flux:main>
        @if (session('success'))
            <div class="p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg" role="alert">
                {{ session('success') }}
            </div>
        @endif
        <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
            @include('components.main')
        </div>
    </flux:main>
</x-layouts.app.sidebar>
