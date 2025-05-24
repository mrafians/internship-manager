@if (Auth::check() && Auth::user()->roles === 'admin')
<x-layouts.app.sidebar :title="$title ?? null">
    <flux:main>
        {{ $slot }}
    </flux:main>
</x-layouts.app.sidebar>
@elseif (Auth::check() && (Auth::user()->roles === 'siswa' || Auth::user()->roles === 'guru'))
<x-layouts.app.header :title="$title ?? null">
    <flux:main>
        {{ $slot }}
    </flux:main>
</x-layouts.app.header>
@endif