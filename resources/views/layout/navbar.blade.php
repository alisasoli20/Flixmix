<nav class="navbar navbar-expand-lg navbar-light bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ route("home") }}">Flixmix</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <form method="GET" >
                    <div class="input-group">
                        <input class="form-control" type="search" placeholder="Search Movies & Uers" aria-label="Search">
                        <span class="input-group-text" ><i class="fa fa-search"></i></span>
                    </div>
                </form>
            </ul>
            <ul class="navbar-nav mr-auto">
                <li class="nav-item mr-2">
                    <div class="dropdown dropstart">
                        <a class=" dropdown-toggle"  id="dropdownMenuButton2" data-bs-toggle="dropdown" aria-expanded="false"><img class="avatar-image" src="{{ asset("images/man-avatar.jpg") }}"></a>
                        <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="dropdownMenuButton2">
                            <li><a class="dropdown-item" href="{{ route("profile") }}">Profile</a></li>
                            <li><form method="POST" action="{{ route("logout") }}">@csrf<button class="dropdown-item" >Logout</button></form></li>
                        </ul>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</nav>
