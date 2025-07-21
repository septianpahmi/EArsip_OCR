<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('dashboard') }}" class="brand-link text-center">
        {{-- <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
            style="opacity: .8"> --}}
        <h3 class="brand-text font-weight-bold">OCRDashboard</h3>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="{{ route('dashboard') }}"
                        class="nav-link{{ request()->routeIs('dashboard') ? ' active' : '' }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
                @can('Admin')
                    <li class="nav-item">
                        <a href="{{ route('users') }}" class="nav-link{{ request()->routeIs('users') ? ' active' : '' }}">
                            <i class="nav-icon fas fa-users"></i>
                            <p>
                                Manajemen Pengguna
                            </p>
                        </a>
                    </li>
                @endcan
                <li
                    class="nav-item{{ request()->routeIs(['documenType', 'kategori', 'tag', 'document.ocr', 'document.create']) ? ' menu-open' : '' }}">
                    <a href="#"
                        class="nav-link{{ request()->routeIs(['documenType', 'kategori', 'tag', 'document.ocr', 'document.create']) ? ' active' : '' }}">
                        <i class="nav-icon fas fa-copy"></i>
                        <p>
                            Manajemen Dokumen
                            <i class="fas fa-angle-left right"></i>
                            {{-- <span class="badge badge-info right">6</span> --}}
                        </p>
                    </a>

                    <ul class="nav nav-treeview">
                        @can('Tata Usaha')
                            <li class="nav-item">
                                <a href="{{ route('document.ocr') }}"
                                    class="nav-link{{ request()->routeIs('document.ocr') ? ' active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Klasifikasi Otomatis</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('document.create') }}"
                                    class="nav-link{{ request()->routeIs('document.create') ? ' active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Upload Manual</p>
                                </a>
                            </li>
                        @endcan
                        @can('Admin')
                            <li class="nav-item">
                                <a href="{{ route('kategori') }}"
                                    class="nav-link{{ request()->routeIs('kategori') ? ' active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Kategori</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('documenType') }}"
                                    class="nav-link{{ request()->routeIs('documenType') ? ' active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Jenis Dokumen</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('tag') }}"
                                    class="nav-link{{ request()->routeIs('tag') ? ' active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Tags</p>
                                </a>
                            </li>
                        @endcan
                    </ul>
                </li>
                @can('Tata Usaha')
                    <li class="nav-item{{ request()->routeIs(['document', 'document.detail']) ? ' menu-open' : '' }}">
                        <a href="#"
                            class="nav-link{{ request()->routeIs(['document', 'document.detail']) ? ' active' : '' }}">
                            <i class="nav-icon fas fa-folder"></i>
                            <p>
                                Kategori Dokumen
                                <i class="fas fa-angle-left right"></i>
                                {{-- <span class="badge badge-info right">6</span> --}}
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('document') }}"
                                    class="nav-link{{ request()->routeIs('document') ? ' active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Semua Dokumen</p>
                                </a>
                            </li>
                            @foreach ($kategori as $item)
                                <li class="nav-item">
                                    <a href="{{ route('document.detail', ['slug' => $item->slug]) }}"
                                        class="nav-link{{ request()->routeIs('document.detail') && request()->route('slug') === $item->slug ? ' active' : '' }} ">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>{{ $item->name }}</p>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('arsip') }}" class="nav-link{{ request()->routeIs('arsip') ? ' active' : '' }}">
                            <i class="nav-icon fas fa-archive"></i>
                            <p>
                                Arsip
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('reminder') }}"
                            class="nav-link{{ request()->routeIs('reminder') ? ' active' : '' }}">
                            <i class="nav-icon fas fa-calendar"></i>
                            <p>
                                Pengingat Dokumen
                            </p>
                        </a>
                    </li>
                @endcan
                @can('Admin')
                    <li class="nav-item">
                        <a href="{{ route('audit') }}" class="nav-link{{ request()->routeIs('audit') ? ' active' : '' }}">
                            <i class="nav-icon fas fa-history"></i>
                            <p>
                                Log Aktivitas
                            </p>
                        </a>
                    </li>
                @endcan
                {{-- <li class="nav-header">EXAMPLES</li> --}}
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
