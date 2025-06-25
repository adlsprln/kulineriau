@extends('layouts.app')

@section('title', 'Kelola Menu')

@section('content')
<div class="container mx-auto px-6 py-10">
    <h2 class="text-3xl font-bold text-red-700 mb-6">Kelola Menu</h2>

    {{-- Tombol Tambah + Form Cari --}}
    <div class="flex justify-between items-center mb-6 flex-wrap gap-4">
        <a href="{{ route('admin.menu.create') }}" class="px-5 py-2 bg-green-600 text-white rounded-xl hover:bg-green-700 transition">
            + Tambah Menu
        </a>

        <form method="GET" action="{{ route('admin.menu.index') }}" class="flex items-center gap-2">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari menu..."
                class="px-4 py-2 border rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500">
            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-xl hover:bg-blue-700">Cari</button>
        </form>
    </div>

    {{-- Tampilkan daftar menu --}}
    @if($menus->isEmpty())
        <div class="text-center text-gray-500">Belum ada menu yang tersedia.</div>
    @else
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($menus as $menu)
            <div class="bg-white rounded-xl shadow hover:shadow-lg transition overflow-hidden">
                
                {{-- Gambar Menu --}}
                @if($menu->image_url)
                    <img src="{{ asset('images/' . $menu->image_url) }}" alt="{{ $menu->name }}"
                         class="w-full h-48 object-cover">
                @else
                    <div class="w-full h-48 bg-gray-200 flex items-center justify-center text-gray-400">
                        Tidak ada gambar
                    </div>
                @endif

                {{-- Konten Menu --}}
                <div class="p-4">
                    <h3 class="text-xl font-bold text-red-700">{{ $menu->name }}</h3>
                    <p class="text-sm text-gray-600 mb-2">Rp{{ number_format($menu->price, 0, ',', '.') }}</p>

                    {{-- Tombol Aksi --}}
                    <div class="flex gap-2">
                        <a href="{{ route('admin.menu.edit', $menu->id) }}"
                            class="px-3 py-1 bg-yellow-500 text-white text-sm rounded hover:bg-yellow-600">Edit</a>
                        <form action="{{ route('admin.menu.destroy', $menu->id) }}" method="POST"
                              onsubmit="return confirm('Yakin ingin menghapus menu ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="px-3 py-1 bg-red-600 text-white text-sm rounded hover:bg-red-700">Hapus</button>
                        </form>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
