@extends('layouts.app')
@section('content')
<div class="flex justify-between mb-4">
    <h1 class="text-2xl font-bold">Daftar Menu</h1>
    @if(Auth::check() && Auth::user()->isAdmin())
        <a href="{{ route('menu.create') }}" class="bg-red-600 text-white px-4 py-2 rounded">Tambah Menu</a>
    @endif
</div>
@if(session('success'))
    <div class="bg-green-100 text-green-800 p-2 rounded mb-4">{{ session('success') }}</div>
@endif
<table class="min-w-full bg-white rounded shadow">
    <thead>
        <tr>
            <th class="py-2 px-4 border-b">Nama</th>
            <th class="py-2 px-4 border-b">Deskripsi</th>
            <th class="py-2 px-4 border-b">Harga</th>
            @if(Auth::check() && Auth::user()->isAdmin())
                <th class="py-2 px-4 border-b">Aksi</th>
            @endif
        </tr>
    </thead>
    <tbody>
        @foreach($menus as $menu)
        <tr>
            <td class="py-2 px-4 border-b">{{ $menu->name }}</td>
            <td class="py-2 px-4 border-b">{{ $menu->description }}</td>
            <td class="py-2 px-4 border-b">Rp {{ number_format($menu->price,0,',','.') }}</td>
            @if(Auth::check() && Auth::user()->isAdmin())
            <td class="py-2 px-4 border-b">
                <a href="{{ route('menu.edit', $menu) }}" class="text-blue-600 mr-2">Edit</a>
                <form action="{{ route('menu.destroy', $menu) }}" method="POST" class="inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="text-red-600" onclick="return confirm('Yakin hapus menu?')">Hapus</button>
                </form>
            </td>
            @endif
        </tr>
        @endforeach
    </tbody>
</table>
@if(Auth::guest())
    <div class="mt-8 text-center">
        <a href="{{ route('login') }}" class="text-blue-600 underline">Login</a> atau
        <a href="{{ route('register') }}" class="text-blue-600 underline">Register</a> untuk akses lebih lanjut.
    </div>
@endif
@endsection
