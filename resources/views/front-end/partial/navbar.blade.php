<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-bottom">
    <div class="container-fluid">
        <a class="navbar-brand" href="/">
            @if (Cache::has('settings'))
                @php
                    $logo = Cache::get('settings')->logo;
                @endphp
                <img src="{{ $logo }}" alt="" width="50">
            @else
                <img src="{{ asset('images/logo/logo.jpg') }}" alt="" width="50">
            @endif

        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                @if (Cache::has('pages'))
                    @foreach (Cache::get('pages') as $key => $page)
                        @php
                            $locale = app()->getLocale();
                            $displayName = 'name_' . $locale;
                        @endphp
                        @if ($page->children->count())
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle {{ Route::currentRouteName() == $page->slug ? 'active' : '' }}"
                                    aria-current="page" href="/{{ $page->slug }}" href="#" id="navbarDropdown"
                                    role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    {{ $page->$displayName }}
                                </a>
                                <ul class="dropdown-menu  px-2 py-2" aria-labelledby="navbarDropdown"
                                    style="border-radius:1rem;">
                                    @foreach ($page->children as $child)
                                        <li class="nav-item my-2">
                                            <a class="dropdown-item rounded-lg {{ request()->get('type') == $child->slug ? 'active' : '' }}"
                                                href="/{{ $page->slug }}?type={{ $child->slug }}">
                                                {{ $child->$displayName }}
                                            </a>
                                        </li>
                                    @endforeach

                                </ul>
                            </li>
                        @else
                            <li class="nav-item">
                                <a class="nav-link {{ Route::currentRouteName() == $page->slug ? 'active' : '' }}"
                                    aria-current="page" href="/{{ $page->slug }}">
                                    {{ $page->$displayName }}
                                </a>
                            </li>
                        @endif
                    @endforeach
                @endif
            </ul>
            <form class="d-flex" method="post" action="{{ route('switch-language') }}" id="switch-language-form">
                {{ csrf_field() }}
                @if (app()->getLocale() == 'en')
                    <input type="hidden" name="lang" value="kh" />
                    <a class="switch-language" href="#">
                        <img src="{{ asset('icons/kh_flag.png') }}" alt="" height="30">
                    </a>
                @else
                    <a class="switch-language" href="#">
                        <input type="hidden" name="lang" value="en" />
                        <img src="{{ asset('icons/us_flag.png') }}" alt="" height="30">
                    </a>
                @endif
            </form>
        </div>
    </div>
</nav>
