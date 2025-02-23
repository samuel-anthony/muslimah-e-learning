<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="/assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="/assets/css/jquery-ui.css">
	<link rel="stylesheet" href="/assets/css/jquery.timepicker.min.css">
    <link rel="stylesheet" href="/assets/css/style.css">
    <title>Sahabat Muslimah</title>
</head>

<body>
    @auth
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        @if(Auth::user()->isAdmin == 1)
        <a class="navbar-brand" href="/admin">
        @else
        <a class="navbar-brand" href="/user">
        @endif
            Sahabat Muslimah
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup"
            aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        @if(Auth::user()->isAdmin == 1)
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav">
                <a class="nav-item nav-link" href="/admin/materi">Material</a>
                <a class="nav-item nav-link" href="/admin/ujian">Exam</a>
                <a class="nav-item nav-link" href="/admin/group">Group</a>
                <a class="nav-item nav-link" href="/admin/anggota">Members</a>
                <a class="nav-item nav-link" href="/admin/ranking">Ranking</a>
            </div>
        </div>
        @else
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav">
                <a class="nav-item nav-link" href="/user/materi">Material</a>
                <a class="nav-item nav-link" href="/user/ujian">Exam</a>
            </div>
        </div>
        @endif
        <div class="dropdown">
            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton"
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Settings
            </button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                @if(Auth::user()->isAdmin==0)
                <a class="dropdown-item" href="/user/profile">Profile</a>
                @endif
                <a class="dropdown-item" href="{{ route('logout') }}"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">{{ __('Logout') }}</a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">@csrf</form>
            </div>
        </div>
    </nav>
    @endauth
    
    @if (session('alert'))
    <div class="alert alert-success">
        {{ session('alert') }}
    </div>
    @endif

    @yield('content')
    
    <script src="/assets/js/jquery-3.4.1.slim.min.js"></script>
    <script src="/assets/js/jquery-1.12.4.js"></script>
    <script src="/assets/js/popper.min.js"></script>
    <script src="/assets/js/bootstrap.min.js"></script>
	<script src="/assets/js/jquery-ui.min.js"></script>
	<script src="/assets/js/jquery.timepicker.min.js"></script>
	<script src="/assets/js/index.js"></script>
</body>

</html>
