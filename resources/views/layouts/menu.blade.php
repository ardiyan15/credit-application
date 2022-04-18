<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="index3.html" class="brand-link">
        <img src="{{ asset('dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo"
            class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">Pengajuan Kredit</span>
    </a>
    <div class="sidebar">
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">

                    <a href="{{ route('home') }}" class="nav-link @if ($menu == 'Dashboard') active @endif"><i
                            class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
                <li class="nav-item">

                    <a href="{{ route('users.show', Auth::user()->id) }}"
                        class="nav-link @if ($menu == 'users') active @endif"><i
                            class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            User Profile
                        </p>
                    </a>
                </li>

                <li class="nav-item @if ($menu == 'mks') menu-open @endif">
                    <a href="#" class="@if ($menu == 'mks') active @endif nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            MKA
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>

                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('mks.index') }}"
                                class="@if ($sub_menu == 'scoring') active @endif nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Perhitungan MKA</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item @if ($menu == 'approval') menu-open @endif">
                    <a href="#" class="@if ($menu == 'approval') active @endif nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Approval
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>

                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('approval.index') }}"
                                class="@if ($sub_menu == 'approval_credit') active @endif nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Approval Kredit</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item @if ($menu == 'master') menu-open @endif">
                    <a href="#" class="@if ($menu == 'master') active @endif nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Data Master
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('users.index') }}"
                                class="@if ($sub_menu == 'user') active @endif nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>User</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('credits.index') }}"
                                class="@if ($sub_menu == 'credit') active @endif nav-link ">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Pengajuan Kredit</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('sukubunga.index') }}"
                                class="@if ($sub_menu == 'suku_bunga') active @endif nav-link ">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Suku Bunga</p>
                            </a>
                        </li>
                    </ul>
                </li>

                {{-- <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Kredit
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">

                        <li class="nav-item">
                            <a href="{{ route('credits.index') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Pengajuan Kredit</p>
                            </a>
                        </li>
                    </ul>
                </li> --}}
                <hr color="white" width="200px;">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <li class="nav-item">
                        <button class="btn btn-sm nav-link text-left font-weight-bold text-mute" style="width: 100%;">
                            <i class="fas fa-sign-out-alt"></i>
                            <p>
                                Logout
                            </p>
                        </button>
                    </li>
                </form>
            </ul>
        </nav>
    </div>
</aside>
