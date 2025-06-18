@extends('layouts.app')
@section('title', 'Profil Saya')
@section('content')
<div class="max-w-xl mx-auto bg-white rounded-xl shadow-lg p-8 mt-10">
    <h1 class="text-2xl font-bold text-center text-blue-900 mb-6">Profil Saya</h1>
    @if(session('success'))
        <div class="bg-green-100 text-green-800 p-2 rounded mb-4 text-center">{{ session('success') }}</div>
    @endif
    <form action="{{ route('profile.update') }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-4">
            <label class="block font-semibold mb-1">Nama</label>
            <input type="text" name="name" value="{{ old('name', auth()->user()->name) }}" class="border rounded px-3 py-2 w-full" required>
        </div>
        <div class="mb-4">
            <label class="block font-semibold mb-1">Email</label>
            <input type="email" name="email" value="{{ old('email', auth()->user()->email) }}" class="border rounded px-3 py-2 w-full" required>
        </div>
        <div class="mb-4">
            <label class="block font-semibold mb-1">Alamat Rumah</label>
            <input type="text" name="address" value="{{ old('address', auth()->user()->address) }}" class="border rounded px-3 py-2 w-full">
        </div>
        <div class="mb-4">
            <label class="block font-semibold mb-1">Jenis Kelamin</label>
            <select name="gender" class="border rounded px-3 py-2 w-full">
                <option value="">Pilih</option>
                <option value="Laki-laki" @if(old('gender', auth()->user()->gender)=='Laki-laki') selected @endif>Laki-laki</option>
                <option value="Perempuan" @if(old('gender', auth()->user()->gender)=='Perempuan') selected @endif>Perempuan</option>
            </select>
        </div>
        <div class="mb-4">
            <label class="block font-semibold mb-1">No. Telepon</label>
            <input type="text" name="phone" value="{{ old('phone', auth()->user()->phone) }}" class="border rounded px-3 py-2 w-full">
        </div>
        <div class="mb-4">
            <label class="block font-semibold mb-1">Kota</label>
            <input type="text" name="city" value="{{ old('city', auth()->user()->city) }}" class="border rounded px-3 py-2 w-full">
        </div>
        <div class="mb-4">
            <label class="block font-semibold mb-1">Kode Pos</label>
            <input type="text" name="postal_code" value="{{ old('postal_code', auth()->user()->postal_code) }}" class="border rounded px-3 py-2 w-full">
        </div>
        <div class="text-center mt-6">
            <button type="submit" class="bg-blue-600 hover:bg-blue-800 text-white px-6 py-2 rounded font-bold shadow">Simpan Profil</button>
        </div>
    </form>
</div>
@endsection
