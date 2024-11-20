<header class="main-header">
    <!-- Logo -->
    <a href="index2.html" class="logo">
        @php
            $words = explode(' ', $setting->nama_toko);
            $word = '';
            foreach ($words as $w) {
                $word .= $w[0];
            }
        @endphp
        <span class="logo-mini"><b>{{ $word }}</b></span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"><b>{{ $setting->nama_toko }}</b></span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>

        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">

                <!-- User Account: style can be found in dropdown.less -->
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        @if (isset(auth()->user()->foto))
                            <img src="#" class="user-image" alt="User Image">
                        @else
                            <img src="{{ asset('assets/dist/img/user2-160x160.jpg') }}" class="user-image"
                                alt="User Image">
                        @endif
                        <span class="hidden-xs">{{ auth()->user()->name }}</span>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- User image -->
                        <li class="user-header">
                            @if (isset(auth()->user()->foto))
                                <img src="#" class="img-circle" alt="User Image">
                            @else
                                <img src="{{ asset('assets/dist/img/user2-160x160.jpg') }}" class="img-circle"
                                    alt="User Image">
                            @endif
                            <p>
                                {{ auth()->user()->name }}
                            </p>
                        </li>
                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <div class="pull-left">
                                <a href="#" class="btn btn-default btn-flat">Profile</a>
                            </div>
                            <div class="pull-right">
                                <form action="{{ route('logout') }}" method="post">
                                    @csrf
                                    <button type="submit" class="btn btn-default btn-flat">Logout</button>
                                </form>
                            </div>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</header>
