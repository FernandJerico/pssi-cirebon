<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
    <div class="position-sticky pt-3 sidebar-sticky">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link {{ Request::is('dashboard') ? 'active' : '' }}" aria-current="page" href="/dashboard">
                    <span data-feather="home" class="align-text-bottom"></span>
                    Dashboard
                </a>
            </li>

            @can('is_admin')
                <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-2 mb-1 text-muted">
                    <span>Administator Area</span>
                </h6>
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('dashboard/manage-users*') ? 'active' : '' }}"
                        href="/dashboard/manage-users">
                        <span data-feather="user" class="align-text-bottom"></span>
                        Manage Users
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('dashboard/need-approval*') ? 'active' : '' }}"
                        href="/dashboard/need-approval">
                        <span data-feather="bell" class="align-text-bottom">
                        </span>
                        <span class="unapproved-icon">
                            News Need Approval
                            <span class="unapproved-count"> {{ $countUnapprovedPosts }}</span>
                        </span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('dashboard/categories-news*') ? 'active' : '' }}"
                        href="/dashboard/categories-news">
                        <span data-feather="grid" class="align-text-bottom"></span>
                        Categories
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('dashboard/teams*') ? 'active' : '' }}" href="/dashboard/teams">
                        <span data-feather="users" class="align-text-bottom"></span>
                        My Club
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('dashboard/coaches*') ? 'active' : '' }}" href="/dashboard/coaches">
                        <span data-feather="user-check" class="align-text-bottom"></span>
                        Coaches
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('dashboard/officials*') ? 'active' : '' }}"
                        href="/dashboard/officials">
                        <span data-feather="command" class="align-text-bottom"></span>
                        Officials
                    </a>
                </li>
            @endcan

            <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-2 mb-1 text-muted">
                <span>News Area</span>
            </h6>
            <li class="nav-item">
                <a class="nav-link {{ Request::is('dashboard/news*') ? 'active' : '' }}" href="/dashboard/news">
                    <span data-feather="file-text" class="align-text-bottom"></span>
                    My News
                </a>
            </li>
        </ul>
    </div>
</nav>
