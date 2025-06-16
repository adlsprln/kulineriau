@extends('layouts.app')
@section('content')
<h1 class="text-2xl font-bold mb-4">Tambah Menu</h1>
@if($errors->any())
    <div class="bg-red-100 text-red-800 p-2 rounded mb-4">
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<form action="{{ route('menu.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
    @csrf
    <div>
        <label class="block">Nama Menu</label>
        <input type="text" name="name" class="border rounded px-3 py-2 w-full" value="{{ old('name') }}" required>
    </div>
    <div>
        <label class="block">Deskripsi</label>
        <textarea name="description" class="border rounded px-3 py-2 w-full">{{ old('description') }}</textarea>
    </div>
    <div>
        <label class="block">Harga</label>
        <input type="number" name="price" class="border rounded px-3 py-2 w-full" value="{{ old('price') }}" required>
    </div>
    <div>
        <label class="block">Foto/Gambar Menu</label>
        <input type="file" name="image" accept="image/*" class="border rounded px-3 py-2 w-full">
    </div>
    <div>
        <label class="block">Kategori</label>
        <select name="category" class="border rounded px-3 py-2 w-full" required>
            <option value="">Pilih Kategori</option>
            <option value="sangat_populer">Sangat Populer (Ikonik & Sering Dicari)</option>
            <option value="cukup_populer">Cukup Populer (Khas tapi Tidak Selalu Ada)</option>
            <option value="jarang_dikenal">Jarang Dikenal Wisatawan tapi Autentik</option>
            <option value="minuman_khas">Minuman Khas Kepulauan Riau</option>
        </select>
    </div>
    <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded">Simpan</button>
    <a href="{{ route('menu.index') }}" class="ml-2 text-gray-600">Batal</a>
</form>
@endsection
