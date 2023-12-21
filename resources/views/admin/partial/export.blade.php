@if (isset($data['export']) && $data['export'])
    <div class="d-flex flex-row justify-content-end mb-3">
        <div>
            <a href="#">
                <button type="button" class="btn btn-dark btn-sm">
                    <i class="fa fa-file-excel"></i>
                    Excel
                </button>
            </a>
            <a href="#">
                <button type="button" class="btn btn-dark btn-sm">
                    <i class="fa fa-file-csv"></i>
                    Csv
                </button>
            </a>
            <a href="#">
                <button type="button" class="btn btn-dark btn-sm">
                    <i class="fa fa-file-pdf"></i>
                    Pdf
                </button>
            </a>
        </div>
    </div>
@endif
