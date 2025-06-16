@extends('layouts.app')
@section('content')
<h1 class="text-2xl font-bold mb-4">Edit Menu</h1>
@if($errors->any())
    <div class="bg-red-100 text-red-800 p-2 rounded mb-4">
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<form action="{{ route('menu.update', $menu) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
    @csrf
    @method('PUT')
    <div>
        <label class="block">Nama Menu</label>
        <input type="text" name="name" class="border rounded px-3 py-2 w-full" value="{{ old('name', $menu->name) }}" required>
    </div>
    <div>
        <label class="block">Deskripsi</label>
        <textarea name="description" class="border rounded px-3 py-2 w-full">{{ old('description', $menu->description) }}</textarea>
    </div>
    <div>
        <label class="block">Harga</label>
        <input type="number" name="price" class="border rounded px-3 py-2 w-full" value="{{ old('price', $menu->price) }}" required>
    </div>
    <div>
        <label class="block">Foto/Gambar Menu</label>
        <input type="file" name="image" accept="image/*" class="border rounded px-3 py-2 w-full">
        @if($menu->image_url)
            <img src="/images/{{ $menu->image_url }}" alt="{{ $menu->name }}" class="w-24 h-24 mt-2 object-cover rounded">
        @endif
    </div>
    <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded">Update</button>
    <a href="{{ route('menu.index') }}" class="ml-2 text-gray-600">Batal</a>
</form>
@endsection
