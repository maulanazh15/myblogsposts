@extends('dashboard.layouts.main')

@section('container')
    {{-- <script src="https://cdn.tailwindcss.com"></script> --}}
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Welcome Back, {{ auth()->user()->name }}</h1>
    </div>
    <h3 class="mx-auto text-center">Analisis Data Post Bulan {{ now()->monthName }}</h3>
    <div class="container px-4 mx-auto">
        <div class="p-6 m-20 bg-white rounded shadow">
            {!! $postsChart->container() !!}
        </div>
    </div>
    <div class="container px-4 mx-auto mt-3">
        <div class="p-6 m-20 bg-white rounded shadow">
            {!! $categoryChart->container() !!}
        </div>
    </div>

    <div class="hr mt-4">

    </div>
    
    <script src="{{ $postsChart->cdn() }}"></script>
    {{ $postsChart->script() }}
    <script src="{{ $categoryChart->cdn() }}"></script>
    {{ $categoryChart->script() }}
@endsection
