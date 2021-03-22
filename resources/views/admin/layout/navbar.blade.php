<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <li class="nav-item mr-2">
            <div class="dropdown">
                <a class=" dropdown-toggle"  id="dropdownMenuButton2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img class="avatar-image" src="{{ asset("images/man-avatar.jpg") }}"></a>
                <ul class="dropdown-menu " aria-labelledby="dropdownMenuButton2">
                    <li><a class="dropdown-item" href="{{ route("profile") }}">Profile</a></li>
                    <li><form method="POST" action="{{ route("logout") }}">@csrf<button class="dropdown-item" >Logout</button></form></li>
                </ul>
            </div>
        </li>
    </ul>
</nav>
<!-- /.navbar -->
