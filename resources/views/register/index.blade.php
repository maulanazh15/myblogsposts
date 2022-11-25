

@extends('layouts.main')

@section('container')

<div class="row justify-content-center">
    <div class="col-lg-5">
        <main class="form-registration w-100 m-auto">
            <h1 class="h3 mb-3 fw-normal text-center">Registration Form</h1>
            <form action="/register" method="post">
              {{-- <img class="mb-4" src="../assets/brand/bootstrap-logo.svg" alt="" width="72" height="57"> --}}
              
              @csrf
              <div class="form-floating">
                <input type="text" class="form-control rounded-top @error('name') is-invalid @enderror" name="name" id="name" placeholder="John Doe" required value="{{ old('name')}}">
                <label for="name">Name</label>
                @error('name')
                <div class="invalid-feedback mb-2">
                    {{ $message }}
                </div>
                @enderror
              </div>
              <div class="form-floating">
                <input type="text" class="form-control @error('username') is-invalid  @enderror" name="username" id="username" placeholder="johndoe21" required value="{{ old('username')}}">
                <label for="username">Username</label>
                @error('username')
                <div class="invalid-feedback mb-2">
                    {{ $message }}
                </div>
                @enderror
              </div>
              <div class="form-floating">
                <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" id="email" placeholder="name@example.com" required value="{{ old('email')}}">
                <label for="email">Email address</label>
                @error('email')
                <div class="invalid-feedback mb-2">
                    {{ $message }}
                </div>
                @enderror
              </div>
              <div class="form-floating">
                <input type="password" class="form-control @error('password') is-invalid @enderror rounded-bottom" name="password" id="password" placeholder="Password" required>
                <label for="password">Password</label>
                @error('password')
                <div class="invalid-feedback mb-2">
                    {{ $message }}
                </div>
                @enderror
              </div>
          
              
              <button class="w-100 btn btn-lg btn-primary mt-3" type="submit">Register</button>
            </form>
            <small class="d-block text-center mt-3">Already registered? <a href="/login" class="text-decoration-none">Login</a></small>
        </main>
    </div>
</div>



@endsection