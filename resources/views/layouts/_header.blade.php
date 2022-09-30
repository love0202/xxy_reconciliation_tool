<header>
    <nav class="navbar navbar-dark bg-primary" style="padding: 10px 20px;">
        <a href="{{ url('/') }}" class="d-flex align-items-center mb-2 mb-lg-0 text-dark text-decoration-none"
           rel="{{ config('app.name', 'Laravel') }}">
            <img src="{{ yxx_path_static('logo.png') }}" alt="mdo" width="32" height="32" class="bi me-2">
        </a>
        <!-- Navbar content -->
        @guest
            <div class="col-md-3 text-end">
                <a href="{{ route('auth_admin.login') }}" class="btn btn-outline-primary me-2">{{ __('Login') }}</a>
            </div>
        @else
            <div class="dropdown text-end">
                <a href="#" class="d-block link-dark text-decoration-none dropdown-toggle" id="dropdownUser1"
                   data-bs-toggle="dropdown" aria-expanded="false" rel="{{ Auth::user()->name }}">
                    <img src="{{ yxx_path_static('man.png') }}" alt="mdo" width="32" height="32" class="rounded-circle">
                </a>
                <ul class="dropdown-menu text-small" aria-labelledby="dropdownUser1" style="">
                    <li>
                        <a class="dropdown-item" href="{{ route('auth_admin.logout') }}"
                           onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>
                        <form id="logout-form" action="{{ route('auth_admin.logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </li>
                </ul>
            </div>
        @endguest
    </nav>
</header>
<nav class="navbar navbar-dark" style="background-color: #e3f2fd;">
    <ul class="nav">
        @foreach (config('yxx_menu') as $menu)
            <li class="nav-item">
                <a class="nav-link active" href="{{$menu['url']}}">{{$menu['name']}}</a>
            </li>
        @endforeach
    </ul>
</nav>

