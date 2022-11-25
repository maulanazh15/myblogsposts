<header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
    <div class="container-fluid">
        <button class="navbar-toggler d-md-none collapsed" type="button" data-bs-toggle="collapse"
        data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
        <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3 fs-6" href="/">Our Blogs</a>
    <form action="/dashboard/posts">
        <input style="border: 0pt; width:50ch; display: block;
        width: 100%;
        padding: 0.375rem 0.75rem;
        font-size: 1rem;
        font-weight: 400;
        line-height: 1.5;
        transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out;
        color: #fff;
        background-color: rgba(255, 255, 255, .1);
        border-color: rgba(255, 255, 255, .1);" type="text" placeholder="Search" aria-label="Search"
            name="search" value="{{ request('search') }}">
    </form>



    <div class="navbar-nav">
        <div class="nav-item text-nowrap">
            <form action="/logout" method="post">
                @csrf
                <button type="submit" class="btn btn-danger mx-2 my-2">Logout <span data-feather="log-out"
                        class="align-text-bottom"></button>
            </form>
        </div>
    </div>
    </div>
    
</header>
