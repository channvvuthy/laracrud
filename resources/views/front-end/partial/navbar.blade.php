
<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-bottom">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">
        <img src="{{asset('images/logo/logo.jpg')}}" alt="" width="50">
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          @if(Cache::has('pages'))
          @foreach(Cache::get('pages') as $key => $page)
          @php
          $locale = app()->getLocale();
          $displayName = "name_" . $locale;
          @endphp
          @if($page->children->count())
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              {{$page->$displayName}}
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
              @foreach($page->children as $child)
              <li>
                <a class="dropdown-item" href="{{$child->slug}}">
                  {{$child->$displayName}}
                </a>
              </li>
              @endforeach

            </ul>
          </li>
          @else
          <li class="nav-item">
            <a class="nav-link {{Route::currentRouteName() == $page->slug ? 'active' : ''}}" aria-current="page" href="{{$page->slug}}">
              {{$page->$displayName}}
            </a>
          </li>
          @endif
          @endforeach
          @endif
        </ul>
        <form class="d-flex">
          <img src="{{asset('icons/us_flag.png')}}" alt="" height="30">
        </form>
      </div>
    </div>
  </nav>