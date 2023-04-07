<nav class="navbar navbar-expand-lg bg-light">
    <div class="container">
        <a href="/" class="navbar-brand">{{ env('APP_NAME') }}</a>

        <button class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#showNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="showNavbar">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a href="/" class="nav-link">Home</a></li>
                <li class="nav-item"><a href="/create-polling" class="nav-link">Create Polling</a></li>
                <form action="{{ route('logout') }}" method="post">
                    @csrf
                    @method('post')
                    <li class="nav-item"><button type="submit" class="nav-link">Logout</button></li>
                </form>
            </ul>
        </div>
    </div>
</nav>
