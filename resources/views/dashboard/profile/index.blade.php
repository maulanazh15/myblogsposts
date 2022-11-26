@extends('dashboard.layouts.main')

@section('container')

    <div class="container-xl px-4 mt-4">
        <!-- Account page navigation-->
        <hr class="mt-0 mb-4">
        <div class="row">
            @if (session()->has('pesan'))
            <div class="alert alert-success" role="alert">
                {{ session('pesan') }}
            </div>
            @endif
            <div class="col-xl-4">
               
                <!-- Profile picture card-->
                <div class="card mb-4 mb-xl-0">
                    <div class="card-header">Profile Picture</div>
                    <div class="card-body text-center">
                        <!-- Profile picture image-->

                        @if($user->image)
                        <img class="img-account-profile rounded-circle mb-2"
                            src="{{ asset('storage/' . $user->image) }}" alt="" width="250" height="250">
                        @else
                        <img class="img-account-profile rounded-circle mb-2"
                            src="http://bootdey.com/img/Content/avatar/avatar1.png" alt="">
                        @endif
                        <!-- Profile picture help block-->
                        <div class="small font-italic text-muted mb-4">JPG or PNG no larger than 5 MB</div>
                        <!-- Profile picture upload button-->
                        <button class="btn btn-primary upload-img" type="button">Upload new image</button>
                        <div class="img-up" style="display: none">
                            <img class="img-preview img-fluid mb-3 col-sm-4 mt-1">
                            <form action="/dashboard/profile/img" method="post" enctype="multipart/form-data">
                                @csrf
                            <input class="form-control  @error('image') is-invalid @enderror" type="file" id="image"
                                name="image" onchange="previewImage();">
                            @error('image')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                            <button class="btn btn-success mt-2" type="submit" name="save">Kirim</button>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
            <div class="col-xl-8">
                <!-- Account details card-->
                <div class="card mb-4">
                    <div class="card-header">Account Details</div>
                    <div class="card-body">
                        <form action="/dashboard/profile/update" method="post">
                            @csrf
                            <!-- Form Group (username)-->
                            <div class="mb-3">
                                <label class="small mb-1" for="inputUsername">Username</label>
                                <input class="form-control @error('username') is invalid @enderror" id="inputUsername" name='username' type="text"
                                    placeholder="Enter your username" value="{{ $user->username }}">
                                    @error('username')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                            </div>
                            
                            <!-- Form Row-->
                            <div class="mb-3">
                                <!-- Form Group (first name)-->
                                <label class="small mb-1" for="inputUsername">Fullname (how your name will appear to other
                                    users on the site)</label>
                                <input class="form-control @error('name') is-invalid @enderror" id="inputUsername" type="text"
                                    placeholder="Enter your username" name="name" value="{{ $user->name }}">
                                    @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                            </div>
                            <!-- Form Group (email address)-->
                            <div class="mb-3">
                                <label class="small mb-1" for="inputEmailAddress">Email address</label>
                                <input class="form-control @error('email') is-invalid @enderror" id="inputEmailAddress" type="email"
                                    placeholder="Enter your email address" name="email" value="{{ $user->email }}">
                                    @error('email')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                            </div>
                            {{-- <!-- Form Row-->
                            <div class="row gx-3 mb-3">
                                <!-- Form Group (phone number)-->
                                <div class="col-md-6">
                                    <label class="small mb-1" for="inputPhone">Phone number</label>
                                    <input class="form-control" id="inputPhone" type="tel"
                                        placeholder="Enter your phone number" value="555-123-4567">
                                </div>
                                <!-- Form Group (birthday)-->
                                <div class="col-md-6">
                                    <label class="small mb-1" for="inputBirthday">Birthday</label>
                                    <input class="form-control" id="inputBirthday" type="text" name="birthday"
                                        placeholder="Enter your birthday" value="06/10/1988">
                                </div>
                            </div> --}}
                            <!-- Save changes button-->
                            <button class="btn btn-primary" type="submit" name="save">Save changes</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $(document).ready(function() {
            $('.upload-img').click(function() {
                console.log('klik');
                $('.img-up').fadeToggle("slow");
            });
        });

        function previewImage() {
            const image = document.querySelector('#image');
            const imgPreview = document.querySelector('.img-preview');

            imgPreview.style.display = 'block';

            const oFReader = new FileReader();
            oFReader.readAsDataURL(image.files[0]);

            oFReader.onload = function(oFREvent) {
                imgPreview.src = oFREvent.target.result;
            }
        }
    </script>
@endsection
