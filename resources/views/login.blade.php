@extends('layouts.app')
@section('title', 'Login')
@section('content')
<div class="flex justify-center items-center min-h-[60vh] bg-gradient-to-br from-red-50 to-pink-50">
    <div class="w-full max-w-md bg-white p-10 rounded-2xl shadow-xl border border-red-100">
        <h2 class="text-3xl font-extrabold mb-6 text-center text-red-600">Login</h2>
        @if(session('status'))
            <div class="bg-green-100 text-green-800 p-2 rounded mb-4">{{ session('status') }}</div>
        @endif
        @if($errors->any())
            <div class="bg-red-100 text-red-800 p-2 rounded mb-4">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form method="POST" action="{{ route('login') }}" class="space-y-5">
            @csrf
            <div>
                <label class="block text-gray-700 font-semibold mb-1">Email</label>
                <input type="email" name="email" class="border border-red-200 rounded px-3 py-2 w-full focus:ring-2 focus:ring-red-300" required autofocus>
            </div>
            <div>
                <label class="block text-gray-700 font-semibold mb-1">Password</label>
                <input type="password" name="password" class="border border-red-200 rounded px-3 py-2 w-full focus:ring-2 focus:ring-red-300" required>
            </div>
            <button type="submit" class="bg-gradient-to-r from-red-500 to-pink-500 text-white px-6 py-2 rounded-lg shadow font-semibold w-full transition-all duration-200">Login</button>
        </form>
        <div class="mt-6 text-center">
            <span class="text-gray-600">Belum punya akun?</span>
            <a href="{{ route('register') }}" class="text-red-600 underline font-semibold ml-1">Register</a>
        </div>
    </div>
</div>
@endsection
