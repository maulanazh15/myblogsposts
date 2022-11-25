@extends('layouts.main')
@section('container')
    <div class="container mt-3 mb-3">
        <h1 class="mb-3 text-center">{{ $title }}</h1>
        <div class="row justify-content-center mb-3">
            <div class="col-md-6">
                <form action="/posts">
                    @if (request('category'))
                        <input type="hidden" name="category" value="{{ request('category') }}">
                    @endif
                    @if (request('user'))
                        <input type="hidden" name="user" value="{{ request('user') }}">
                    @endif
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Search post..." name="search"
                            value="{{ request('search') }} ">
                        <button class="btn btn-outline-primary" type="submit">Search <i class="bi bi-search"></i></button>
                    </div>
                </form>
            </div>
        </div>

        @if ($posts->count())
            <div class="card mb-3 text-center">
              @if ($posts[0]->image)
                            <img src="{{ asset('storage/' . $posts[0]->image) }}" class="img-fluid mt-3"
                                alt="{{ $posts[0]->category->name }}">
                        @else
                <img src="https://source.unsplash.com/1200x400/?{{ $posts[0]->category->name }}" class="card-img-top"
                    alt="{{ $posts[0]->category->name }}">
                    @endif
                <div class="card-body">
                    <h3 class="card-title"><a class="text-decoration-none text-dark"
                            href="/posts/{{ $posts[0]->slug }}">{{ $posts[0]->title }}</a></h3>
                    <small class="text-muted">By. <a href="/posts?user={{ $posts[0]->user->username }}"
                            class="text-decoration-none"> {{ $posts[0]->user->name }} </a> in <a
                            class="text-decoration-none"
                            href="/posts?category={{ $posts[0]->category->slug }}">{{ $posts[0]->category->name }}</a>
                        Last updated
                        {{ $posts[0]->created_at->diffForHumans() }}</small>
                    <p class="card-text">{{ $posts[0]->excerpt }}</p>
                    <a class="text-decoration-none btn btn-primary" href="/posts/{{ $posts[0]->slug }}">Read More...</a>
                </div>
            </div>



    </div>

    <div class="container">
        <div class="row">
            @foreach ($posts->skip(1) as $post)
                <div class="col-md-4 mb-3">
                    <div class="card">
                        <div class="position-absolute bg-dark px-3 py-2 text-white opacity-75">
                            <a class="text-decoration-none text-white"
                                href="/posts?category={{ $post->category->slug }}">{{ $post->category->name }}</a>
                        </div>
                        @if ($post->image)
                            <img src="{{ asset('storage/' . $post->image) }}" class="img-fluid mt-3"
                                alt="{{ $post->category->name }}">
                        @else
                            <img src="https://source.unsplash.com/500x400/?{{ $post->category->name }}"
                                class="card-img-top" alt="{{ $post->category->name }}">
                        @endif
                            <div class="card-body">
                                <h5 class="card-title">{{ $post->title }}</h5>
                                <small class="text-muted">By. <a href="/posts?user={{ $post->user->username }}"
                                        class="text-decoration-none"> {{ $post->user->name }} </a> Last updated
                                    {{ $post->created_at->diffForHumans() }}</small>
                                <p class="card-text">{{ $post->excerpt }}</p>
                                <a href="/posts/{{ $post->slug }}" class="btn btn-primary">Read More..</a>
                            </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@else
    <p class="text-center fs-4">No post found.</p>
    @endif
    <div class="d-flex justify-content-end">
        {{ $posts->links() }}
    </div>
@endsection
