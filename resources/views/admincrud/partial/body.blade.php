<div class="wrapper">
    <!-- Preloader -->
    <div class="preloader flex-column justify-content-center align-items-center">
        <img class="animation__shake" src="{{ asset('images/loading/loading.svg') }}" alt="LARACRUD">
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
                <div class="col-md-12 overflow-x-scroll">
                    @yield('content')
                </div>
            </div>
        </div>
    </div>
</div>
<!-- ./wrapper -->
