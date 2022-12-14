@extends('layouts.main')
@section('container')
    <h1 class="mb-4">Post Categories</h1>

    <div class="container mt-5">
        <div class="row g-3">
            @foreach ($categories as $category)
                <div class="col-md-4">
                    <a class="text-decoration-none" href="/posts?category={{ $category->slug }}">
                        <div class="card text-bg-dark">
                            @if ($category->image)
                                <img src="{{ asset('storage/' . $category->image) }}" class="img-fluid"
                                    alt="{{ $category->name }}">
                            @else
                                <img src="https://source.unsplash.com/1200x400/?{{ $category->name }}"
                                    class="img-fluid" alt="{{ $category->name }}">
                            @endif
                            <div class="card-img-overlay d-flex align-items-center p-0">
                                <h5 class="card-title text-center flex-fill p-4 opacity-75 fs-3"
                                    style="background-color: black">{{ $category->name }}</h5>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
@endsection
