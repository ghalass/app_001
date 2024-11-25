<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">
            {{ config('app.name', 'APP Laravel') }}
        </a>
        <a class="navbar-brand" href="{{ url('/configs') }}">
            Configs
        </a>
        <a class="navbar-brand" href="{{ url('/rje') }}">
            RJE
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            {{-- <ul class="navbar-nav me-auto">

            </ul> --}}



            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ms-auto">
                <div class="col">
                    @role('admin')
                        <ul class="navbar-nav ms-auto">
                            <li class="nav-item dropdown">
                                <button class="btn dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                    Roles & Permissions
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li><a class="dropdown-item" href="{{ url('/roles') }}">Roles</a></li>
                                    <li><a class="dropdown-item" href="{{ url('/permissions') }}">Permissions</a></li>
                                </ul>
                            </li>
                        </ul>
                    @endrole
                </div>
                <div class="row">
                    <div class="col"> <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </div>
                </div>
            </ul>

        </div>
    </div>
</nav>
