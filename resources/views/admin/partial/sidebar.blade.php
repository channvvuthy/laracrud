<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <div class="text-center">
        <a href="{{URL::to('/')}}" class="brand-link">
            {{__('common.VSM')}}
        </a>
    </div>
    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                @if(Auth::check() && Auth::user()->profile)
                    <img src="{{Auth::user()->profile}}" class="img-circle elevation-2">
                @else
                    <img src="{{ asset('dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2">

                @endif
            </div>
            <div class="info">
                <a href="#" class="d-block">
                    @if(Auth::check())
                        {{Str::ucfirst(Auth::user()->name)}}
                    @endif
                </a>
            </div>
        </div>
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                @if(Cache::has('menus') && count(Cache::get('menus')))
                    @foreach(Cache::get('menus') as $key => $menu)
                        <li class="nav-item">
                            <a href="/{{$menu->action}}"
                               class="nav-link {{request()->path() == $menu->action?'active':''}} @if(isset($_GET['parent']) && ($_GET['parent'] ==  $menu->action)) active @endif">
                                <i class="{{$menu->icon}}"></i>
                                <p class="pl-2">
                                    {{$menu->name}}
                                </p>
                            </a>
                        </li>
                    @endforeach
                @endif
                <li class="nav-item">
                    <a href="/admin/menu"
                       class="nav-link {{Str::contains(strtolower(URL::current()),'menu')?'active':''}}">
                        <i class="fa-cloud-download-alt fa"></i>
                        <p class="pl-2">
                            {{__('common.Menu')}}
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/admin/setting"
                       class="nav-link {{Str::contains(strtolower(URL::current()),'setting')?'active':''}}">
                        <i class="fa fa-cogs"></i>
                        <p class="pl-2">
                            {{__('common.Setting')}}
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/auth/logout" class="nav-link">
                        <i class="fa fa-lock"></i>
                        <p class="pl-2">
                            {{__('common.Logout')}}
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
