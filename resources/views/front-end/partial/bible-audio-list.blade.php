  @if (isset($libraries) && $libraries->count())
      @foreach ($libraries as $key => $library)
          <li class="text-white border-b @if ($key == 0) pb-3 @else py-3 @endif">
              <a href="{{ route('bible-studies') }}?type=bible-audio&detail={{ $bibleStudy->id }}&index={{ $key }}"
                  class="text-decoration-none text-white">
                  <div class="row">
                      <div class="col-sm-4">
                          <div class="position-relative ">
                              <img src="{{ $library->thumbnail }}" class="rounded img-fluid" />

                              <div
                                  class="position-absolute rounded top-0 start-0 w-100 h-100 bg-overlay d-flex justify-content-center align-items-center">
                                  <svg width="40px" height="40px" viewBox="0 0 36 36"
                                      xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                      aria-hidden="true" role="img" class="iconify iconify--twemoji"
                                      preserveAspectRatio="xMidYMid meet">
                                      <path fill="#d3d3d3"
                                          d="M19.182 10.016l-6.364 1.313c-.45.093-.818.544-.818 1.004v16.185a6.218 6.218 0 0 0-2.087-.36c-2.785 0-5.042 1.755-5.042 3.922c0 2.165 2.258 3.827 5.042 3.827C12.649 35.905 14.922 34 15 32V16.39l4.204-.872c.449-.093.796-.545.796-1.004v-3.832c0-.458-.368-.759-.818-.666zm8 3.151l-4.297.865c-.45.093-.885.544-.885 1.003V26.44c0-.152-.878-.24-1.4-.24c-2.024 0-3.633 1.276-3.633 2.852c0 1.574 1.658 2.851 3.683 2.851s3.677-1.277 3.677-2.851l-.014-11.286l2.869-.598c.45-.093.818-.544.818-1.003v-2.33c0-.459-.368-.76-.818-.668z" />
                                  </svg>


                              </div>

                              @if ($index != null && $index == $key)
                                  <div
                                      class="position-absolute rounded top-0 start-0 w-100 h-100 d-flex justify-content-start align-items-center">
                                      <div style="margin-left: -40px">
                                          <svg width="30px" height="30px" viewBox="0 0 15 15" fill="none"
                                              xmlns="http://www.w3.org/2000/svg">
                                              <path
                                                  d="M4.79062 2.09314C4.63821 1.98427 4.43774 1.96972 4.27121 2.05542C4.10467 2.14112 4 2.31271 4 2.5V12.5C4 12.6873 4.10467 12.8589 4.27121 12.9446C4.43774 13.0303 4.63821 13.0157 4.79062 12.9069L11.7906 7.90687C11.922 7.81301 12 7.66148 12 7.5C12 7.33853 11.922 7.18699 11.7906 7.09314L4.79062 2.09314Z"
                                                  fill="#fff" />
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
