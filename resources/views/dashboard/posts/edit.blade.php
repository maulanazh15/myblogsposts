

@extends('dashboard.layouts.main')


@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Edit Post</h1>
    
</div>
<a href="/dashboard/posts" class="btn btn-info mb-3"><span data-feather="arrow-left"></span> Back to my posts</a>
<div class="col-lg-6">
    <form method="post" action="/dashboard/posts/{{ $post->slug }}" class="mb-5" enctype="multipart/form-data">
        @method('put')
        @csrf
        <div class="mb-3">
          <label for="title" class="form-label">Title</label>
          <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" id="title" value="{{ old('title', $post->title) }}" required autofocus>
          @error('title')
              <div class="invalid-feedback">
                {{ $message }}
              </div>
          @enderror
        </div>
        <div class="mb-3">
          <label for="slug" class="form-label">Slug</label>
          <input type="text" class="form-control @error('slug') is-invalid @enderror" name="slug" id="slug" value="{{ old('slug',$post->slug) }}" required readonly>
          @error('slug')
              <div class="invalid-feedback">
                {{ $message }}
              </div>
          @enderror
        </div>
        
        <div class="mb-3">
          <label for="category" class="form-label">Category</label>
          <select class="form-select form-select-md @error('category') is-invalid @enderror" name="category_id" required>
            <option selected disabled aria-readonly="true">Pilih kategori</option>
            @foreach ($categories as $category)
            @if (old('category_id',$post->category_id) == $category->id)
            <option value="{{ $category->id }}" selected>{{ $category->name }}</option>
            @else
            <option value="{{ $category->id }}">{{ $category->name }}</option>
            @endif
            @endforeach

          </select>

        </div>
        <div class="mb-3">
            <label for="image" class="form-label">Gambar</label>
            <input type="hidden" name="oldImage" value="{{$post->image}}">
            @if ($post->image)
          <img src="{{ asset('storage/'.$post->image) }}" class="img-preview img-fluid mb-3 col-sm-4 d-block">
          @else
          <img class="img-preview img-fluid mb-3 col-sm-4">
          @endif
            
            <input class="form-control @error('image') is-invalid @enderror" type="file" id="image" name="image" onchange="previewImage();">
            @error('image')
              <div class="invalid-feedback">
                {{ $message }}
              </div>
          @enderror
          </div>
        <div class="mb-3">
            <label for="body" class="form-label">Body</label>
            <input id="body" type="hidden" name="body" class="@error('body') is-invalid @enderror" value="{{ old('body',$post->body) }}" required>
            <trix-editor input="body"></trix-editor>
            @error('body')
              <div class="invalid-feedback">
                {{ $message }}
              </div>
          @enderror
        </div>
        <button type="submit" class="btn btn-primary">Update Post</button>
        <button type="reset" class="btn btn-danger">Cancel</button>
         
        
      </form>
</div>

<script>
    const title = document.querySelector('#title');
    const slug = document.querySelector('#slug');

    title.addEventListener('change', function() {
        fetch("/dashboard/posts/createSlug?title=" + title.value)
            .then(response => response.json())
            .then(data => slug.value = data.slug)
    });
    title.addEventListener('focus', function() {
        fetch("/dashboard/posts/createSlug?title=" + title.value)
            .then(response => response.json())
            .then(data => slug.value = data.slug)
    });
    title.addEventListener('click', function() {
        fetch("/dashboard/posts/createSlug?title=" + title.value)
            .then(response => response.json())
            .then(data => slug.value = data.slug)
    });

    
    document.addEventListener('trix-file-accept', function (e) {
        e.preventDefault();
    })

    function previewImage() {
      const image = document.querySelector('#image');
      const imgPreview = document.querySelector('.img-preview');

      imgPreview.style.display = 'block';

      const oFReader = new FileReader();
      oFReader.readAsDataURL(image.files[0]);

      oFReader.onload = function(oFREvent){
        imgPreview.src = oFREvent.target.result;
      }
    }

</script>


@endsection