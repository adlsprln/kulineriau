@extends('layouts.app')
@section('title', 'Edit Profil')
@section('content')
<div class="container mx-auto px-6 py-12">
    <h1 class="text-3xl font-bold text-blue-900 mb-8 text-center">Edit Profil</h1>
    <form action="{{ route('profile.update') }}" method="POST" class="bg-white rounded-xl shadow p-6 max-w-lg mx-auto">
        @csrf
        @method('PUT')
        <div class="mb-4">
            <label class="block mb-2 font-semibold">Nama</label>
            <input type="text" name="name" value="{{ old('name', Auth::user()->name) }}" class="w-full border rounded px-3 py-2" required>
        </div>
        <div class="mb-4">
            <label class="block mb-2 font-semibold">Email</label>
            <input type="email" name="email" value="{{ old('email', Auth::user()->email) }}" class="w-full border rounded px-3 py-2" required>
        </div>
        <div class="mb-4">
            <label class="block mb-2 font-semibold">No. Telepon</label>
            <input type="text" name="phone" value="{{ old('phone', Auth::user()->phone) }}" class="w-full border rounded px-3 py-2">
        </div>
        <div class="mb-4">
            <label class="block mb-2 font-semibold">Jenis Kelamin</label>
            <select name="gender" class="w-full border rounded px-3 py-2">
                <option value="" disabled selected>Pilih Jenis Kelamin</option>
                <option value="Laki-laki" {{ old('gender', Auth::user()->gender) == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                <option value="Perempuan" {{ old('gender', Auth::user()->gender) == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
            </select>
        </div>
        <div class="mb-4">
            <label class="block mb-2 font-semibold">Alamat</label>
            <textarea name="address" class="w-full border rounded px-3 py-2">{{ old('address', Auth::user()->address) }}</textarea>
        </div>
        <button type="submit" class="bg-blue-700 text-white px-4 py-2 rounded">Simpan</button>
    </form>
</div>
@endsection
