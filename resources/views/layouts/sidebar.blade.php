<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                @if (isset(auth()->user()->foto))
                    <img src="#" class="img-circle" alt="User Image">
                @else
                    <img src="{{ asset('assets/dist/img/user2-160x160.jpg') }}" class="img-circle" alt="User Image">
                @endif
            </div>
            <div class="pull-left info">
                <p>{{ auth()->user()->name }}</p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>

        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu" data-widget="tree">
            <li>
                <a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a>
            </li>
            <li class="header">MASTER</li>
            <li>
                <a href="{{ route('kategori.index') }}"><i class="fa fa-cube"></i> <span>Kategori</span></a>
            </li>
            <li>
                <a href="{{ route('produk.index') }}"><i class="fa fa-cubes"></i> <span>Produk</span></a>
            </li>
            <li>
                <a href="{{ route('member.index') }}"><i class="fa fa-id-card-o"></i> <span>Member</span></a>
            </li>
            <li>
                <a href="{{ route('supplier.index') }}"><i class="fa fa-truck"></i> <span>Supplier</span></a>
            </li>
            <li class="header">TRANSAKSI</li>
            <li>
                <a href="{{ route('pengeluaran.index') }}"><i class="fa fa-money"></i> <span>Pengeluaran</span></a>
            </li>
            <li>
                <a href="{{ route('pembelian.index') }}"><i class="fa fa-upload"></i> <span>Pembelian</span></a>
            </li>
            <li class="header">SISTEM</li>
            <li>
                <a href="{{ route('setting.index') }}"><i class="fa fa-cogs"></i> <span>Setting</span></a>
            </li>
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>
