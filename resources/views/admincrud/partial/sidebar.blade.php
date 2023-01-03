<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <div class="text-center">
        <a href="{{URL::to('/')}}" class="brand-link">
            <img src="{{ asset('images/logo/logo.png') }}" alt="AdminLTE Logo"
                 style="opacity: .8" width="150" class="m-auto">
        </a>
    </div>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset('dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">Alexander Pierce</a>
            </div>
        </div>
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                @if(Cache::has('menus') && count(Cache::get('menus')))
                    @foreach(Cache::get('menus') as $key => $menu)
                        <li class="nav-item">
                            <a href="/{{$menu->action}}" class="nav-link">
                                <i class="{{$menu->icon}}"></i>
                                <p>
                                    {{$menu->name}}
                                </p>
                            </a>
                        </li>
                    @endforeach
                @else
                    <li class="nav-item">
                        <a href="/admin/menu" class="nav-link">
                            <i class="fa fa-bars"></i>
                            <p>
                                Menu
                            </p>
                        </a>
                    </li>
                @endif
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
