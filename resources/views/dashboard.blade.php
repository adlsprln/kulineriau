@extends('layouts.app')
@section('title', 'Dashboard')
@section('content')
<div class="mb-8">
    <h1 class="text-4xl font-extrabold text-red-700 mb-2">Dashboard Admin</h1>
    <p class="text-gray-600 text-lg">Kelola data menu makanan & minuman dengan mudah dan cepat.</p>
</div>
<div class="flex justify-between items-center mb-6">
    <div>
        <span class="text-xl font-semibold text-gray-700">Total Menu: <span class="text-red-600">{{ $menus->count() }}</span></span>
    </div>
    <a href="{{ route('menu.create') }}" class="bg-gradient-to-r from-red-500 to-pink-500 hover:from-pink-500 hover:to-red-500 text-white px-6 py-2 rounded-lg shadow font-semibold transition-all duration-200">+ Tambah Menu</a>
</div>
<div class="overflow-x-auto rounded-lg shadow-lg bg-white">
    <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gradient-to-r from-red-600 to-pink-500 text-white">
            <tr>
                <th class="py-3 px-6 text-left text-xs font-bold uppercase tracking-wider">Nama</th>
                <th class="py-3 px-6 text-left text-xs font-bold uppercase tracking-wider">Deskripsi</th>
                <th class="py-3 px-6 text-left text-xs font-bold uppercase tracking-wider">Harga</th>
                <th class="py-3 px-6 text-center text-xs font-bold uppercase tracking-wider">Aksi</th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
            @forelse($menus as $menu)
            <tr class="hover:bg-gray-50 transition-all">
                <td class="py-4 px-6 font-medium text-gray-900">{{ $menu->name }}</td>
                <td class="py-4 px-6 text-gray-700">{{ $menu->description }}</td>
                <td class="py-4 px-6 text-red-600 font-bold">Rp {{ number_format($menu->price,0,',','.') }}</td>
                <td class="py-4 px-6 text-center">
                    <a href="{{ route('menu.edit', $menu) }}" class="inline-block bg-blue-500 hover:bg-blue-700 text-white px-4 py-2 rounded mr-2 transition-all duration-150">Edit</a>
                    <form action="{{ route('menu.destroy', $menu) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="inline-block bg-red-500 hover:bg-red-700 text-white px-4 py-2 rounded transition-all duration-150" onclick="return confirm('Yakin hapus menu?')">Hapus</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="4" class="py-6 px-6 text-center text-gray-500">Belum ada menu yang tersedia.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
