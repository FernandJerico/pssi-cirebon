<link href="public/css/style.css" rel="stylesheet">
<header id="header" class="header fixed-top d-flex align-items-center shadow-sm">
    <div class="container d-flex align-items-center justify-content-between">
        <a href="/" class="logo">
            <h1><img src="{{ asset('img/logo-pssi-transparan.png') }}" alt="Logo PSSI">PSSI<span> CRB</span></h1>
        </a>
        <nav id="navbar" class="navbar">
            <ul class="ms auto">
                <li><a href="/" class="nav-link {{ Request::path() === '/' ? 'active' : '' }}">Home</a></li>
                <li class="dropdown"><a href="/news"
                        class="nav-link {{ Request::is('news*') ? 'active' : '' }}"><span>News</span> <i
                            class="bi bi-chevron-down dropdown-indicator"></i></a>
                    <ul>
                        <li><a href="/news"
                                class="nav-link {{ Request::path() === 'news' ? 'active' : 'news' }}"><span>All
                                    News</span></a>
                        </li>
                        <li class="dropdown"><a href="/categories"
                                class="nav-link {{ Request::path() === 'categories' ? 'active' : 'news' }}"><span>Categories</span><i
                                    class="bi bi-chevron-down dropdown-indicator"></i></a>
                            <ul>
                                @foreach ($categories as $category)
                                    <li><a href="/news?category={{ $category->slug }}">{{ $category->name }}</a></li>
                                @endforeach
                            </ul>
                        </li>
                    </ul>
                <li class="dropdown"><a href="/teams"
                        class="nav-link {{ Request::is('teams*') ? 'active' : '' }}"><span>Member</span> <i
                            class="bi bi-chevron-down dropdown-indicator"></i></a>
                    <ul>
                        <li><a href="/teams"
                                class="nav-link {{ Request::path() === 'teams' ? 'active' : 'teams' }}"><span>All
                                    Clubs</span></a>
                        </li>
                        @foreach ($categories as $category)
                            <li class="dropdown"><a href="/teams?category={{ $category->slug }}"
                                    class="nav-link
                                    {{ Request::path() === 'categories' ? 'active' : 'teams' }}"><span>{{ $category->name }}</span>
                                    <i class="bi bi-chevron-down dropdown-indicator"></i></a>
                                <ul>
                                    @foreach ($list_teams->where('category_id', $category->id) as $team)
                                        <li><a href="/teams/{{ $team->slug }}">{{ $team->team_name }}</a></li>
                                    @endforeach
                                </ul>
                            </li>
                        @endforeach
                    </ul>
                </li>
                <li><a href="/about" class="nav-link {{ Request::path() === 'about' ? 'active' : '' }}">About</a></li>
                <li><a href="/contact" class="nav-link {{ Request::path() === 'contact' ? 'active' : '' }}">Contact
                        Us</a>
                </li>
            </ul>

        </nav>
        <nav class="nav">
            <ul>
                @auth
                    <li class="dropdown"><a href="/dashboard"><span>Welcome back, {{ auth()->user()->name }}</span> <i
                                class="bi bi-chevron-down"></i></a>
                        <ul>
                            <li class="dropdown"><a href="/dashboard"><span>My Dashboard</span></a>
                            </li>
                            {{-- <li><hr class="dropdown-divider"></li> --}}
                            <li>
                                <form action="/logout" method="POST">
                                    @csrf
                                    <button type="submit" class="dropdown bg-white px-2 border-0"><span
                                            data-feather="log-out">Logout</span></button>
                                </form>
                            </li>
                        </ul>
                    </li>
                @else
                    {{-- <a class="btn-login {{ Request::path() === 'login' ? 'active' : '' }}" href="/login">Login</a> --}}
                @endauth
            </ul>
        </nav>
        <!-- .navbar -->

        <i class="mobile-nav-toggle mobile-nav-show bi bi-list"></i>
        <i class="mobile-nav-toggle mobile-nav-hide d-none bi bi-x"></i>
    </div>
</header>
