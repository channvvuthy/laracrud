<div class="wrapper">
    <!-- Preloader -->
    <div class="preloader flex-column justify-content-center align-items-center">
        <img class="animation__shake" src="{{ asset('dist/img/AdminLTELogo.png') }}" alt="AdminLTELogo" height="60" width="60">
    </div>

    <!-- Navbar -->
    @include('admincrud.partial.header')
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    @include('admincrud.partial.sidebar')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <div class="container-fluid p-4">
            @include('admincrud.components.success')
            @include('admincrud.components.error')
            @stack('module')
            <div class="row">
                <div class="col-md-12">
                    @yield('content')
                </div>
            </div>
        </div>
    </div>
    <!-- /.content-wrapper -->
    <footer class="main-footer">
        <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong>
        All rights reserved.
        <div class="float-right d-none d-sm-inline-block">
            <b>Version</b> 3.2.0
        </div>
    </footer>

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->
