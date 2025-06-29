@extends('layouts.app')

@section('title', 'Tambah Menu')

@section('content')
<div class="container mx-auto px-6 py-10">
    <h2 class="text-3xl font-bold text-red-700 mb-6">Tambah Menu Baru</h2>

    <form action="{{ route('admin.menu.store') }}" method="POST" enctype="multipart/form-data" class="bg-white p-6 rounded-xl shadow-md max-w-xl">
        @csrf

        {{-- Nama Menu --}}
        <div class="mb-4">
            <label for="name" class="block text-sm font-medium text-gray-700">Nama Menu</label>
            <input type="text" name="name" id="name" required value="{{ old('name') }}"
                class="mt-1 block w-full border border-gray-300 rounded-xl px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none">
            @error('name')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Kategori --}}
<div class="mb-4">
    <label for="category" class="block text-sm font-medium text-gray-700">Kategori</label>
    <select name="category" id="category" required
        class="mt-1 block w-full border border-gray-300 rounded-xl px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none">
        <option value="">-- Pilih Kategori --</option>
        <option value="Sangat Populer" {{ old('category') == 'Sangat Populer' ? 'selected' : '' }}>Sangat Populer</option>
        <option value="Cukup Populer" {{ old('category') == 'Cukup Populer' ? 'selected' : '' }}>Cukup Populer</option>
        <option value="Jarang Dikenal Wisatawan" {{ old('category') == 'Jarang Dikenal Wisatawan' ? 'selected' : '' }}>Jarang Dikenal Wisatawan</option>
        <option value="Minuman Khas Kepulauan Riau" {{ old('category') == 'Minuman Khas Kepulauan Riau' ? 'selected' : '' }}>Minuman Khas Kepulauan Riau</option>
    </select>
    @error('category')
        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
    @enderror
</div>


        {{-- Harga --}}
        <div class="mb-4">
            <label for="price" class="block text-sm font-medium text-gray-700">Harga</label>
            <input type="number" name="price" id="price" required value="{{ old('price') }}"
                class="mt-1 block w-full border border-gray-300 rounded-xl px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none">
            @error('price')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>
        {{-- Deskripsi --}}
 <div class="mb-4">
    <label for="description" class="block text-sm font-medium text-gray-700">Deskripsi</label>
    <textarea name="description" id="description" rows="3" required
        class="mt-1 block w-full border border-gray-300 rounded-xl px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none">{{ old('description') }}</textarea>
    @error('description')
        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
    @enderror
</div>



        {{-- Gambar Menu --}}
        <div class="mb-4">
            <label for="image_url" class="block text-sm font-medium text-gray-700">Gambar Menu</label>
            <input type="file" name="image_url" id="image_url" accept="image/*"
                class="mt-1 block w-full border border-gray-300 rounded-xl px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none">
            @error('image_url')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Tombol --}}
        <div class="flex justify-between items-center mt-6">
            <a href="{{ route('admin.menu.index') }}"
               class="text-blue-600 hover:underline">← Kembali</a>
            <button type="submit"
                class="bg-green-600 text-white px-6 py-2 rounded-xl hover:bg-green-700 transition">Simpan</button>
        </div>
    </form>
</div>
@endsection
