<aside class="main-sidebar custom-background sidebar-dark-primary elevation-4">
    <a href="index3.html" class="brand-link">
        <img src="{{ asset('dist/img/mandiri-logo-transparent.png') }}" class="center" alt="AdminLTE Logo"
            style="width: 150px; margin-left: 10%; opacity: .8">
        {{-- <span class="brand-text font-weight-light">Pengajuan Kredit</span> --}}
    </a>
    <div class="sidebar">
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="{{ route('home') }}"
                        class="nav-link @if ($menu == 'Dashboard') active @else custom-color @endif"><i
                            class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
                <li class="nav-item">

                    <a href="{{ route('users.show', Auth::user()->id) }}"
                        class="nav-link @if ($menu == 'users') active @else custom-color @endif"><i
                            class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            User Profile
                        </p>
                    </a>
                </li>

                @if (Auth::user()->roles == 'mka' || Auth::user()->roles == 'kepala cabang')
                    <li class="nav-item @if ($menu == 'mks') menu-open @endif">
                        <a href="#" class="@if ($menu == 'mks') active @else custom-color @endif nav-link">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>
                                MKA
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>

                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('mks.index') }}"
                                    class="@if ($sub_menu == 'scoring') active @else custom-color @endif nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Skoring MKA</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                @endif

                @if (Auth::user()->roles == 'kepala cabang' || Auth::user()->roles == 'mka')
                    <li class="nav-item @if ($menu == 'approval') menu-open @endif">
                        <a href="#" class="@if ($menu == 'approval') active @else custom-color @endif nav-link">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>
                                Approval
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        @if (Auth::user()->roles == 'mka')
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('approval.bi_checking') }}"
                                        class="@if ($sub_menu == 'approval_bi_checking') active @else custom-color @endif nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Approval BI Checking</p>
                                    </a>
                                </li>
                            </ul>
                        @endif
                        @if (Auth::user()->roles == 'kepala cabang')
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('approval.index') }}"
                                        class="@if ($sub_menu == 'approval_credit') active @else custom-color @endif nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Approval K. Cabang</p>
                                    </a>
                                </li>
                            </ul>
                        @endif
                    </li>
                @endif

                <li class="nav-item @if ($menu == 'master') menu-open @endif">
                    <a href="#" class="@if ($menu == 'master') active @else custom-color @endif nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Data Master
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        @if (Auth::user()->roles == 'superadmin')
                            <li class="nav-item">
                                <a href="{{ route('employee.index') }}"
                                    class="@if ($sub_menu == 'employee') active @else custom-color @endif nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Employee</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('users.index') }}"
                                    class="@if ($sub_menu == 'user') active @else custom-color @endif nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>User</p>
                                </a>
                            </li>
                        @endif
                        @if (Auth::user()->roles == 'mks' || Auth::user()->roles == 'kepala cabang' || Auth::user()->roles == 'mka')
                            <li class="nav-item">
                                <a href="{{ route('credits.index') }}"
                                    class="@if ($sub_menu == 'credit') active @else custom-color @endif nav-link ">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Pengajuan Kredit</p>
                                </a>
                            </li>
                        @endif
                        @if (Auth::user()->roles == 'superadmin')
                            <li class="nav-item">
                                <a href="{{ route('sukubunga.index') }}"
                                    class="@if ($sub_menu == 'suku_bunga') active @else custom-color @endif nav-link ">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Suku Bunga</p>
                                </a>
                            </li>
                        @endif
                    </ul>
                </li>
                <hr color="white" width="200px;">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <li class="nav-item">
                        <button class="btn btn-sm nav-link text-left font-weight-bold text-mute" style="width: 100%;">
                            <i class="fas fa-sign-out-alt custom-color"></i>
                            <p class="custom-color">
                                Logout
                            </p>
                        </button>
                    </li>
                </form>
            </ul>
        </nav>
    </div>
</aside>
