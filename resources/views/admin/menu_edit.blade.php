@extends('layouts.app')

@section('title', 'Tambah Menu')

@section('content')
<div class="max-w-xl mx-auto px-4 py-10">
    <h2 class="text-2xl font-bold text-center text-red-700 mb-6">Form Menu</h2>
    <form method="POST" action="{{ isset($menu) ? route('admin.menu.update', $menu->id) : route('admin.menu.store') }}" enctype="multipart/form-data" class="bg-white p-6 rounded-xl shadow-md space-y-4">
        @csrf
        @if(isset($menu))
            @method('PUT')
        @endif

        <div>
            <label class="block font-medium text-gray-700">Nama Menu</label>
            <input type="text" name="nama" value="{{ old('nama', $menu->nama ?? '') }}" class="w-full px-4 py-2 border rounded-xl" required>
        </div>

        <div>
            <label class="block font-medium text-gray-700">Harga</label>
            <input type="number" name="harga" value="{{ old('harga', $menu->harga ?? '') }}" class="w-full px-4 py-2 border rounded-xl" required>
        </div>

        <div>
            <label class="block font-medium text-gray-700">Deskripsi</label>
            <textarea name="deskripsi" class="w-full px-4 py-2 border rounded-xl" required>{{ old('deskripsi', $menu->deskripsi ?? '') }}</textarea>
        </div>

        <div>
            <label class="block font-medium text-gray-700">Gambar</label>
            <input type="file" name="gambar" class="w-full px-4 py-2 border rounded-xl">
            @if(isset($menu) && $menu->gambar)
                <img src="{{ asset('storage/' . $menu->gambar) }}" class="w-24 mt-2 rounded-xl shadow">
            @endif
        </div>

        <div class="text-right">
            <button type="submit" class="bg-blue-600 text-white px-5 py-2 rounded-xl hover:bg-blue-700">
                {{ isset($menu) ? 'Update' : 'Simpan' }}
            </button>
        </div>
    </form>
</div>
@endsection
