  @if (isset($libraries) && $libraries->count())
  @foreach ($libraries as $key => $library)
  <li class="text-white border-b @if ($key == 0) pb-3 @else py-3 @endif">
      <a href="{{ route('bible-studies') }}?type=bible-video&detail={{ $bibleStudy->id }}&index={{ $key }}" class="text-decoration-none text-white">
          <div class="row">
              <div class="col-sm-4">
                  <div class="position-relative ">
                      <img src="{{ $library->thumbnail }}" class="rounded img-fluid" />

                      <div class="position-absolute rounded top-0 start-0 w-100 h-100 bg-overlay d-flex justify-content-center align-items-center">
                          <svg width="24px" height="24px" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                              <rect x="0" fill="none" width="30" height="30" />
                              <g fill="#d8e4ee">
                                  <path d="M12 2a10 10 0 1 0 10 10A10 10 0 0 0 12 2zm-2 14.5v-9l6 4.5z" />
                              </g>
                          </svg>

                      </div>

                      @if ($index != null && $index == $key)
                      <div class="position-absolute rounded top-0 start-0 w-100 h-100 d-flex justify-content-start align-items-center">
                          <div style="margin-left: -40px">
                              <svg width="30px" height="30px" viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                  <path d="M4.79062 2.09314C4.63821 1.98427 4.43774 1.96972 4.27121 2.05542C4.10467 2.14112 4 2.31271 4 2.5V12.5C4 12.6873 4.10467 12.8589 4.27121 12.9446C4.43774 13.0303 4.63821 13.0157 4.79062 12.9069L11.7906 7.90687C11.922 7.81301 12 7.66148 12 7.5C12 7.33853 11.922 7.18699 11.7906 7.09314L4.79062 2.09314Z" fill="#fff" />
                              </svg>

                          </div>
                      </div>
                      @endif
                  </div>
              </div>
              <div class="col-sm-8">
                  <h5 class="fs-5">
                      {{ Helper::limitString($library->$title, 50) }}
                  </h5>
                  <p class="fs-6">
                      {{ Helper::limitString($library->$description, 50) }}
                  </p>
              </div>
          </div>
      </a>

  </li>
  @endforeach
  @endif
