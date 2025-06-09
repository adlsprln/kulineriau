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
<form action="{{ route('menu.store') }}" method="POST" class="space-y-4">
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
    <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded">Simpan</button>
    <a href="{{ route('menu.index') }}" class="ml-2 text-gray-600">Batal</a>
</form>
@endsection
