<body class="hold-transition sidebar-mini">
    <div class="wrapper">
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
                <li class="nav-item">
                    <a class="nav-link" data-widget="navbar-search" href="#" role="button">
                        <i class="fas fa-search"></i>
                    </a>
                    <div class="navbar-search-block">
                        <form class="form-inline" onsubmit="return false;">
                            <div class="input-group input-group-sm">
                                <input id="tagSearchInput" class="form-control form-control-navbar" type="search"
                                    placeholder="Cari tag..." aria-label="Search">
                                <div class="input-group-append">
                                    <button class="btn btn-navbar" type="submit">
                                        <i class="fas fa-search"></i>
                                    </button>
                                    <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </li>
                @can('Tata Usaha')
                    <li class="nav-item dropdown">
                        <a class="nav-link" data-toggle="dropdown" href="#">
                            <i class="far fa-bell"></i>
                            @if ($reminderNotifications->count())
                                <span class="badge badge-warning navbar-badge">{{ $reminderNotifications->count() }}</span>
                            @endif
                        </a>
                        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                            <span class="dropdown-item dropdown-header">{{ $reminderNotifications->count() }} Notifikasi
                                Pengingat</span>
                            @forelse($reminderNotifications as $reminder)
                                <a href="{{ route('reminder.read', $reminder->id) }}" class="dropdown-item">
                                    <!-- Message Start -->
                                    <div class="media">
                                        <div class="media-body">
                                            <h3 class="dropdown-item-title">
                                                {{ $reminder->document->title }}
                                            </h3>
                                            <p class="text-sm">{{ Str::limit($reminder->message, 35) }}</p>
                                            <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i>
                                                {{ Carbon\Carbon::parse($reminder->remind_at)->diffForHumans() }}</p>
                                        </div>
                                    </div>
                                    <!-- Message End -->
                                </a>
                            @empty
                                <a class="dropdown-item text-muted text-center">Tidak ada notifikasi</a>
                            @endforelse
                            <div class="dropdown-divider"></div>
                            <a href="{{ route('reminder') }}" class="dropdown-item dropdown-footer">Lihat Semua
                                Pengingat</a>
                        </div>
                    </li>
                @endcan
                <li class="nav-item dropdown">
                    <a class="nav-link items-center" data-toggle="dropdown" href="#">
                        <i class="fas fa-user-circle"></i>
                        <span class="hidden-xs ml-2">{{ Auth::user()->name }}</span>
                        <i class="right fas fa-angle-down ml-2"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <span class="dropdown-item dropdown-header">{{ Auth::user()->email }}</span>
                        <div class="dropdown-divider"></div>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <a href="route('logout')" class="dropdown-item"
                                onclick="event.preventDefault();
                                        this.closest('form').submit();">
                                <i class="fas fa-sign-out-alt mr-2"></i> Keluar
                            </a>
                        </form>
                    </div>
                </li>
            </ul>
        </nav>
