@extends('layouts.app')

@section('title', 'Dashboard Owner')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-8">
    <h1 class="text-2xl font-bold">Dashboard Owner</h1>
    <p class="text-slate-400 mt-2">Selamat datang, {{ auth()->user()->name }}!</p>
</div>
@endsection