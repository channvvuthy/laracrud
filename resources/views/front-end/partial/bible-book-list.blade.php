  @if (isset($libraries) && $libraries->count())
      @foreach ($libraries as $key => $library)
          <li class="text-white border-b @if ($key == 0) pb-3 @else py-3 @endif">
              <a href="#" class="text-decoration-none text-white" onclick="openPDFWindow('{{ $library->file }}')">
                  <div class="row">
                      <div class="col-sm-4">
                          <div class="position-relative mb-2">
                              <img src="{{ $library->thumbnail }}" class="rounded img-fluid" />
                          </div>
                      </div>
                      <div class="col-sm-8 ">
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
      <script>
          function openPDFWindow(pdfUrl) {
              // Opens a new window and displays the PDF at the provided URL
              window.open(pdfUrl, '', 'popup');
          }
      </script>
  @endif
