@extends('layouts.app')
@section('title', 'Kontak User')
@section('content')
<div class="container mx-auto px-6 py-12">
    <div class="mb-6">
        <a href="{{ route('admin.dashboard') }}" class="inline-block bg-gray-200 hover:bg-gray-300 text-blue-900 font-bold px-6 py-2 rounded-lg shadow transition">
            ← Kembali ke Dashboard
        </a>
    </div>
    <h1 class="text-3xl font-bold text-blue-900 mb-8">Pesan dari User</h1>
    <div class="overflow-x-auto bg-white rounded-xl shadow p-6">
        <table class="min-w-full border border-blue-200">
            <thead class="bg-blue-100">
                <tr>
                    <th class="px-4 py-2">Nama User</th>
                    <th class="px-4 py-2">Email</th>
                    <th class="px-4 py-2">Pesan</th>
                    <th class="px-4 py-2">Tanggal</th>
                </tr>
            </thead>
            <tbody>
                @foreach($contacts as $contact)
                <tr class="border-t border-blue-100">
                    <td class="px-4 py-2">{{ $contact->user->name ?? '-' }}</td>
                    <td class="px-4 py-2">{{ $contact->user->email ?? '-' }}</td>
                    <td class="px-4 py-2">{{ $contact->message }}</td>
                    <td class="px-4 py-2">{{ $contact->created_at->format('d M Y H:i') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @if($contacts->isEmpty())
            <div class="text-gray-500 text-center py-8">Belum ada pesan dari user.</div>
        @endif
    </div>
</div>
@endsection
