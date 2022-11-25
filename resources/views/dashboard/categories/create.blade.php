

@extends('dashboard.layouts.main')


@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Create New Category</h1>
    
</div>
<a href="/dashboard/categories" class="btn btn-info mb-3"><span data-feather="arrow-left"></span> Back to Categories</a>
<div class="col-lg-6">
    <form method="post" action="/dashboard/categories" class="mb-5" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
          <label for="name" class="form-label">Category Name</label>
          <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" value="{{ old('name') }}" required autofocus>
          @error('name')
              <div class="invalid-feedback">
                {{ $message }}
              </div>
          @enderror
        </div>
        <div class="mb-3">
          <label for="slug" class="form-label">Slug</label>
          <input type="text" class="form-control @error('slug') is-invalid @enderror" name="slug" id="slug" value="{{ old('slug') }}" required readonly>
          @error('slug')
              <div class="invalid-feedback">
                {{ $message }}
              </div>
          @enderror
        </div>
        
        <div class="mb-3">
          <label for="image" class="form-label">Gambar</label>
          <img class="img-preview img-fluid mb-3 col-sm-4">
          <input class="form-control  @error('image') is-invalid @enderror" type="file" id="image" name="image" onchange="previewImage();">
          @error('image')
              <div class="invalid-feedback">
                {{ $message }}
              </div>
          @enderror
        </div>
        <button type="submit" class="btn btn-primary">Create Category</button>
        <button type="reset" class="btn btn-danger">Cancel</button>
         
        
      </form>
</div>

<script>
    const name = document.querySelector('#name');
    const slug = document.querySelector('#slug');

    name.addEventListener('change', function() {
        fetch("/dashboard/categories/createSlug?name=" + name.value)
            .then(response => response.json())
            .then(data => slug.value = data.slug)
    });
    name.addEventListener('focus', function() {
        fetch("/dashboard/categories/createSlug?name=" + name.value)
            .then(response => response.json())
            .then(data => slug.value = data.slug)
    });
    name.addEventListener('click', function() {
        fetch("/dashboard/categories/createSlug?name=" + name.value)
            .then(response => response.json())
            .then(data => slug.value = data.slug)
    });
    
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