@extends('dashboard.layouts.main')

@section('container')
<div class="container">
    <div class="row my-3">
        <div class="col-lg-8">
            <h1 class="mb-3">
                {{ $post["title"] }}
            </h1>
            <a href="/dashboard/posts" class="btn btn-info"><span data-feather="arrow-left"></span> Back to my posts</a>
            <a href="/dashboard/posts/{{ $post->slug }}/edit" class="btn btn-warning"><span data-feather="edit-3"></span> Edit</a>
            <form action="/dashboard/posts/{{ $post->slug }}" method="post" class="d-inline">
                @method('delete')
                @csrf
                <button class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus post?')"><span data-feather="trash-2"></span> Delete</button>
              </form>
              @if ($post->image)
                <img src="{{ asset('storage/'.$post->image) }}" class="img-fluid mt-3" alt="{{ $post->category->name }}">
              @else
              <img src="https://source.unsplash.com/1200x600/?{{ $post->category->name }}" class="img-fluid mt-3" alt="{{ $post->category->name }}">
              @endif
            
            <article class="my-3 fs-5">
                {!! $post->body !!} 
            </article>
            
            
            <br>
            
        </div>
    </div>
</div>
@endsection
