@extends('layouts.main')
@section('container')
    <script type="text/javascript">
        $(document).ready(function() {
            $('.comment_section').click(function() {
                var id = this.id;
                $('#comment' + id).fadeToggle("slow");
            });
            $('.comment_section_reply').click(function() {
                var id = this.id;
                $('#comment_reply' + id).fadeToggle("slow");
            });
            $('.comment_section_update_reply').click(function() {
                var id = this.id;
                $('#comment_update_reply' + id).fadeToggle("slow");
            });
        });
    </script>
    <div class="container">
        <div class="row justify-content-center mb-5">
            <div class="col-md-8">
                <h1 class="mb-3">
                    {{ $post['title'] }}
                </h1>

                <p>By. <a href="/posts?user={{ $post->user->username }}" class="text-decoration-none"> {{ $post->user->name }}
                    </a> in <a class="text-decoration-none"
                        href="/posts?category={{ $post->category->slug }}">{{ $post->category->name }}</a> </p>
                @if ($post->image)
                    <img src="{{ asset('storage/' . $post->image) }}" class="img-fluid mt-3"
                        alt="{{ $post->category->name }}">
                @else
                    <img src="https://source.unsplash.com/1200x400/?{{ $post->category->name }}" class="img-fluid"
                        alt="{{ $post->category->name }}">
                @endif
                <article class="my-3 fs-5">
                    {!! $post->body !!}
                </article>
                <section class="gradient-custom">
                    <div class="container my-5 py-5">
                        <div class="row d-flex justify-content-center">
                            <div class="col-md-12 col-lg-10 col-xl-8">
                                <div class="card">
                                    <div class="card-body p-4">
                                        <h4 class="text-center mb-4 pb-2">Comments Section</h4>
                                        <div class="row">
                                            <div class="col">
                                                @foreach ($comments as $comment)
                                                    <div class="d-flex flex-start mb-3">
                                                        @if ($comment->user->image)
                                                            <img class="rounded-circle shadow-1-strong me-3"
                                                                src="{{ asset('storage/' . $comment->user->image) }}"
                                                                alt="avatar" width="65" height="65" />
                                                        @else
                                                            <img class="rounded-circle shadow-1-strong me-3"
                                                                src="http://bootdey.com/img/Content/avatar/avatar1.png"
                                                                alt="avatar" width="65" height="65" />
                                                        @endif

                                                        <div class="flex-grow-1 flex-shrink-1">
                                                            <div>
                                                                <div
                                                                    class="d-flex justify-content-between align-items-center">
                                                                    <p class="mb-1">
                                                                        {{ $comment->user->name }} <span class="small">-
                                                                            {{ $comment->created_at->diffForHumans() }}
                                                                        </span>
                                                                    <div class="d-absolute">
                                                                        @auth
                                                                            @if (auth()->user()->id == $comment->user_id)
                                                                                <a class="badge bg-primary comment_section_reply text-decoration-none"
                                                                                    id="{{ $comment->comment_id }}">Reply</a>
                                                                                <a class="badge bg-warning comment_section text-decoration-none"
                                                                                    id="{{ $comment->id }}">Edit</a>

                                                                                <form action="comment/{{ $comment->id }}/del"
                                                                                    method="post" class="d-inline">
                                                                                    @csrf
                                                                                    <button
                                                                                        class="badge bg-danger text-decoration-none d-inline border-0"
                                                                                        onclick="confirm('Apakah anda yakin ingin menghapus komen ini?')">Hapus</button>
                                                                                </form>
                                                                            @else
                                                                                <a class="badge bg-primary comment_section_reply text-decoration-none"
                                                                                    id="{{ $comment->comment_id }}">Reply</a>
                                                                            @endif
                                                                        @endauth
                                                                    </div>

                                                                    </p>
                                                                </div>
                                                                <p class="small mb-1">
                                                                    {{ $comment->comment }}
                                                                </p>
                                                                @auth
                                                                    @if ($comment->user->id == auth()->user()->id)
                                                                        <form action="comment/{{ $comment->id }}/update"
                                                                            method="post" class="comment_sec_box"
                                                                            id="comment{{ $comment->id }}"
                                                                            style="display: none">

                                                                            @csrf

                                                                            <textarea name="comment" class="form-control" cols="30" rows="2">{{ $comment->comment }}</textarea>
                                                                            <input type="submit" class="btn btn-info mt-2"
                                                                                name="edit_c" value="Kirim">
                                                                        </form>
                                                                    @endif

                                                                @endauth


                                                            </div>
                                                            <form action="comment/{{ $comment->comment_id }}/reply"
                                                                method="post" class="comment_sec_box"
                                                                id="comment_reply{{ $comment->comment_id }}"
                                                                style="display: none">
                                                                @csrf
                                                                <input type="hidden" name="comment_id"
                                                                    value="{{ $comment->comment_id }}">
                                                                <input type="hidden" name="user_id"
                                                                    value="{{ auth()->user()->id }}">
                                                                <input type="hidden" name="post_id"
                                                                    value="{{ $post->id }}">
                                                                <textarea name="comment" class="form-control" cols="30" rows="2">Balas Komentar</textarea>
                                                                <input type="submit" class="btn btn-info mt-2"
                                                                    name="reply_c" value="Kirim">
                                                            </form>
                                                            @foreach ($Comment
            ::where('comment_id', $comment->comment_id)->get()->skip(1) as $section)
                                                                <div class="d-flex flex-start mt-4">
                                                                    @if ($section->user->image)
                                                                    <img class="rounded-circle shadow-1-strong me-3"
                                                                        src="{{ asset('storage/' . $section->user->image) }}"
                                                                        alt="avatar" width="65" height="65" />
                                                                @else
                                                                    <img class="rounded-circle shadow-1-strong me-3"
                                                                        src="http://bootdey.com/img/Content/avatar/avatar1.png"
                                                                        alt="avatar" width="65" height="65" />
                                                                @endif
                                                                    <div class="flex-grow-1 flex-shrink-1">
                                                                        <div>
                                                                            <div
                                                                                class="d-flex justify-content-between align-items-center">
                                                                                <p class="mb-1">
                                                                                    {{ $section->user->name }} <span
                                                                                        class="small">-
                                                                                        {{ $section->created_at->diffForHumans() }}</span>
                                                                                    @auth
                                                                                        @if (auth()->user()->id == $section->user_id)
                                                                                            <div class="d-absolute">
                                                                                                <a class="badge bg-warning comment_section_update_reply text-decoration-none"
                                                                                                    id="{{ $section->id }}">Edit</a>
                                                                                                <form
                                                                                                    action="comment/{{ $section->id }}/del"
                                                                                                    method="post"
                                                                                                    class="d-inline">
                                                                                                    @csrf
                                                                                                    <button
                                                                                                        class="badge bg-danger text-decoration-none d-inline border-0"
                                                                                                        onclick="confirm('Apakah anda yakin ingin menghapus komen ini?')">Hapus</button>
                                                                                                </form>
                                                                                            </div>
                                                                                        @endif
                                                                                    @endauth
                                                                                </p>
                                                                            </div>
                                                                            <p class="small mb-0">
                                                                                {{ $section->comment }}
                                                                            </p>
                                                                            @auth
                                                                                @if ($section->user->id == auth()->user()->id)
                                                                                    <form
                                                                                        action="comment/{{ $section->id }}/update"
                                                                                        method="post" class="comment_sec_box"
                                                                                        id="comment_update_reply{{ $section->id }}"
                                                                                        style="display: none">
                                                                                        @csrf
                                                                                        <textarea name="comment" class="form-control" cols="30" rows="2">{{ $section->comment }}</textarea>
                                                                                        <input type="submit"
                                                                                            class="btn btn-info mt-2"
                                                                                            name="edit_section_c"
                                                                                            value="Kirim">
                                                                                    </form>
                                                                                @endif
                                                                            @endauth
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            @endforeach

                                                        </div>

                                                    </div>
                                                @endforeach

                                                @auth
                                                    {{-- Comment Form --}}
                                                    <div class="d-flex flex-start mt-4">
                                                        <div class="container my-3 py-3 text-dark">
                                                            <div class="row d-flex justify-content-center">
                                                                <div class="col-md-10 col-lg-10 col-xl-10">
                                                                    <div class="card">
                                                                        <div class="card-body p-4">
                                                                            <div class="d-flex flex-start w-100">
                                                                                @if (auth()->user()->image)
                                                                                    <img class="rounded-circle shadow-1-strong me-3"
                                                                                        src="{{ asset('storage/' . auth()->user()->image) }}"
                                                                                        alt="avatar" width="65"
                                                                                        height="65" />
                                                                                @else
                                                                                    <img class="rounded-circle shadow-1-strong me-3"
                                                                                        src="http://bootdey.com/img/Content/avatar/avatar1.png"
                                                                                        alt="avatar" width="65"
                                                                                        height="65" />
                                                                                @endif

                                                                                <div class="w-100">
                                                                                    <h5>{{ auth()->user()->name }}</h5>
                                                                                    <form
                                                                                        action="/posts/{{ $post->slug }}/comment"
                                                                                        method="post">
                                                                                        @csrf
                                                                                        <div class="form-outline">
                                                                                            <label class="form-label"
                                                                                                for="textAreaExample">What is
                                                                                                your
                                                                                                view?</label>
                                                                                            <textarea class="form-control" name="comment" id="textAreaExample" rows="4"></textarea>
                                                                                        </div>
                                                                                        <div
                                                                                            class="d-flex justify-content-between mt-3">
                                                                                            <input type="hidden"
                                                                                                name="user_id"
                                                                                                value="{{ auth()->user()->id }}">
                                                                                            <input type="hidden"
                                                                                                name="post_id"
                                                                                                value="{{ $post->id }}">
                                                                                            <input type="hidden"
                                                                                                name="comment_id"
                                                                                                value="{{ auth()->user()->id . $post->id }}">
                                                                                            <input type="reset"
                                                                                                class="btn btn-success"
                                                                                                value="Batal">
                                                                                            <input type="submit"
                                                                                                class="btn btn-danger"
                                                                                                value="Kirim"><i
                                                                                                class="fas fa-long-arrow-alt-right ms-1"></i>

                                                                                        </div>
                                                                                    </form>

                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @else
                                                    <div class="my-5">
                                                        <p align='center'><a href="/login"
                                                                class="btn btn-{{ request()->segment(1) == 'login' ? 'primary' : 'success' }} me-2"><i
                                                                    class="bi bi-box-arrow-in-right"></i> Login</a> to add
                                                            comment</p>
                                                    </div>
                                                @endauth
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <br>
                <a href="/posts"><input type="button" value="Kembali" class="btn btn-info mb-5"></a>
            </div>
        </div>
    </div>
@endsection
