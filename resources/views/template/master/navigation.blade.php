<nav class="navbar navbar-expand-lg navbar-custom bg-custom">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
        <span style="color: #fff;"><i class="fa fa-bars"></i></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
        <a class="navbar-brand d-none d-sm-block" href="/">
            @if(file_exists('logo-knockout.pnh'))
                <img src="images/logo-knockout.png" style="height: 14pt; margin-bottom: 4pt; margin-right: 10pt;">
            @else
                <span style="color: #fff;">{{ config('app.name') }}</span>
            @endif
        </a>
        <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
            <li class="nav-item active">
                <a class="nav-link" href="/">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/about">About</a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Channels
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="/channels">View All</a>
                @if(!Auth::guest())
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="/user/subscriptions">View Subscriptions</a>
                @endif
                </div>
            </li>
        </ul>

        @if (Auth::guest())
            <a class="nav-link" href="/register">Register</a>
        @else
            <a class="nav-link" href="/logout">Logout</a>
        @endif

    </div>
</nav>
