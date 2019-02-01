<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            @if(session()->get('role')['id_role'] == 5)
                <div class="pull-left image">
                    <img src="{{ env('API_URL') }}/{{session()->get('sekolah')['foto_guru']}}" class="img-circle" alt="User Image">
                </div>
                <div class="pull-left info">
                    <p>{{session()->get('sekolah')['nama_guru']}}</p>
                    <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                </div>
            @else
                <div class="pull-left image">
                    <img src="{{ env('API_URL') }}/{{session()->get('sekolah')['logo']}}" class="img-circle" alt="User Image">
                </div>
                <div class="pull-left info">
                    <p>{{session()->get('sekolah')['nama_sekolah']}}</p>
                    <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                </div>
            @endif
        </div>
        <!-- search form -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search...">
                <span class="input-group-btn">
                    <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                    </button>
                </span>
            </div>
        </form>
        <!-- /.search form -->
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header">MAIN NAVIGATION</li>
            <li class="{{ Request::is('/') ? 'active' : '' }}">
                <a href="{{ url('/') }}"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a>
            </li>
            @if(session()->get('role')['id_role'] == 1)
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-database"></i> <span>Master Data</span>
                    <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ Request::is('studentdata*') ? 'active' : '' }}">
                        <a href="{{ route('indexStudentdata') }}"><i class="fa fa-circle-o"></i> Data Siswa</a>
                    </li>
                    <li class="{{ Request::is('schooldata*') ? 'active' : '' }}">
                        <a href="{{ route('indexSchooldata') }}"><i class="fa fa-circle-o"></i> Data Sekolah</a>
                    </li>
                    <li class="{{ Request::is('teacherdata*') ? 'active' : '' }}">
                        <a href="{{ route('indexTeacherdata') }}"><i class="fa fa-circle-o"></i> Data Guru</a>
                    </li>
                    <li class="{{ Request::is('classdata*') ? 'active' : '' }}">
                        <a href="{{ route('indexClassdata') }}"><i class="fa fa-circle-o"></i> Data Kelas</a>
                    </li>
                    <li class="{{ Request::is('lesson*') ? 'active' : '' }}">
                        <a href="{{ route('index.lesson') }}"><i class="fa fa-circle-o"></i>Data MataPelajaran</a>
                    </li>
                </ul>
            </li>
            @endif
            @if(session()->get('role')['id_role'] == 3)
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-book"></i> <span>Perpustakaan</span>
                    <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ Request::is('finetransaction*') ? 'active' : '' }}">
                        <a href="{{ route('FineTransaction.index') }}"><i class="fa fa-circle-o"></i>Denda Pinjaman Buku</a>
                    </li>
                    <li class="{{ Request::is('bookdata*') ? 'active' : '' }}">
                        <a href="{{ route('indexBookdata') }}"><i class="fa fa-circle-o"></i>Data Buku</a>
                    </li>
                    <li class="{{ Request::is('borrowbook*') ? 'active' : '' }}">
                        <a href="{{ route('borrowbookIndex') }}"><i class="fa fa-circle-o"></i>Track Peminjam Buku</a>
                    </li>
                </ul>
            </li>
            @endif
            @if(session()->get('role')['id_role'] == 1 || session()->get('role')['id_role'] == 5)
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-graduation-cap"></i> <span>Akademik</span>
                    <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    @if(session()->get('role')['id_role'] == 1)
                    <li class="{{ Request::is('schedule*') ? 'active' : '' }}">
                        <a href="{{ route('indexSchedule') }}"><i class="fa fa-circle-o"></i>Jadwal Pelajaran</a>
                    </li>
                    @endif
                    @if(session()->get('role')['id_role'] == 5)
                    <li class="{{ Request::is('task*') ? 'active' : '' }}">
                        <a href="{{ route('task.index') }}"><i class="fa fa-circle-o"></i>Tugas</a>
                    </li>
                    <li class="{{ Request::is('score*') ? 'active' : '' }}">
                        <a href="{{ route('indexScoredata') }}"><i class="fa fa-circle-o"></i>Nilai</a>
                    </li>
                    @endif
                </ul>
            </li>
            @endif
            @if(session()->get('role')['id_role'] == 2)
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-cart-plus"></i> <span>Transaksi Spp</span>
                    <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li  class="{{ Request::is('spp*') ? 'active' : '' }}">
                        <a href="{{ route('spp.index') }}"><i class="fa fa-circle-o"></i>Monitoring Spp</a>
                    </li>
                    <li  class="{{ Request::is('pembayaranspp*') ? 'active' : '' }}">
                        <a href="{{ route('index.pembayaranspp') }}"><i class="fa fa-circle-o"></i>Transaksi Spp</a>
                    </li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-cart-plus"></i> <span>Transaksi Lainnya</span>
                    <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ Request::is('additionalcosts*') ? 'active' : '' }}">
                        <a href="{{ route('Additionalcosts.index') }}"><i class="fa fa-circle-o"></i>Aditional Costs</a>
                    </li>
                </ul>
            </li>
            @endif
            @if(session()->get('role')['id_role'] == 5)
            <li class="{{ Request::is('studentattendance*') ? 'active' : '' }}">
                <a href="{{ route('studentattendance.index') }}"><i class="fa fa-book"></i> <span>Absensi Siswa</span></a>
            </li>
            @endif
            @if(session()->get('role')['id_role'] == 1)
            <li class="{{ Request::is('schoolinformation*') ? 'active' : '' }}">
              <a href="{{ route('SchoolInformation.index') }}"><i class="fa fa-university"></i> <span>Information Sekolah</span></a>
            </li>
          @endif
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>
