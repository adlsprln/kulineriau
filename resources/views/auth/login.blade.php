@extends('layouts.app')
@section('title', 'Login')
@section('content')
<div class="flex justify-center items-center min-h-[60vh] bg-gradient-to-br from-blue-900 to-blue-400">
    <div class="w-full max-w-md bg-white p-10 rounded-2xl shadow-xl border border-blue-200">
        <h2 class="text-3xl font-extrabold mb-6 text-center text-blue-700">Login</h2>
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
                <label class="block text-blue-900 font-semibold mb-1">Email</label>
                <input type="email" name="email" class="border border-blue-200 rounded px-3 py-2 w-full focus:ring-2 focus:ring-blue-300" required autofocus>
            </div>
            <div>
                <label class="block text-blue-900 font-semibold mb-1">Password</label>
                <input type="password" name="password" class="border border-blue-200 rounded px-3 py-2 w-full focus:ring-2 focus:ring-blue-300" required>
            </div>
            <button type="submit" class="bg-gradient-to-r from-blue-700 to-blue-400 text-white px-6 py-2 rounded-lg shadow font-semibold w-full transition-all duration-200">Login</button>
        </form>
        <div class="mt-6 text-center">
            <span class="text-blue-900">Belum punya akun?</span>
            <a href="{{ route('register') }}" class="text-blue-700 underline font-semibold ml-1">Register</a>
        </div>
    </div>
</div>
@endsection
