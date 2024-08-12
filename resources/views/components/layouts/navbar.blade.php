<nav class="navbar navbar-expand-lg bg-white navbar-light p-0">
    <a href="" class="navbar-brand d-block d-lg-none">
        <h1 class="m-0 display-4 text-primary">Klean</h1>
    </a>
    <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
        <div class="navbar-nav mr-auto py-0">
            <a href="{{route('main')}}" class="nav-item nav-link">Home</a>
            <a href="{{route('about')}}" class="nav-item nav-link">About</a>
            <a href="{{route('service')}}" class="nav-item nav-link">Service</a>
            <a href="{{route('project')}}" class="nav-item nav-link">Project</a>
            <a href="{{route('contact')}}" class="nav-item nav-link">Contact</a>
            <a href="{{route('posts.index')}}" class="nav-item nav-link">Posts</a>

        </div>
        @auth()
        <a href="{{route('posts.create')}}" class="btn btn-primary mr-3 d-none d-lg-block">Create Post</a>
            <form action="{{ route('logout') }}"
                  method="POST"
                  onsubmit="return confirm('Are you sure you want to log out?')">
                @csrf
                <button type="submit" class="btn btn-danger mr-3 d-none d-lg-block">Log out</button>
            </form>
        @else
            <a href="{{route('login')}}" class="btn btn-secondary mr-3 d-none d-lg-block">Login</a>
        @endauth
    </div>
</nav>
