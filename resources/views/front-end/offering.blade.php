@extends('front-end.layout.master')
@section('content')
@if (isset($offering))
@php
$locale = app()->getLocale();
$title = 'title_' . $locale;
$description = 'description_' . $locale;
$wayToGive = 'way_to_give_' . $locale;
@endphp
<div class="container">
    <div class="offering py-5">
        <div class="text-uppercase fw-bold fs-1 text-white">
            <div class="px-2 py-3">
                <h1 class="fs-1">{{ $offering->$title }}</h1>
            </div>
        </div>
        <div class="text-white">
            {!! $offering->$description !!}
        </div>
        <div class="text-white mt-5">
            <h1 class="fs-1">{!! $offering->$wayToGive !!}</h1>
        </div>
        <div class="rounded-lg bg-dark px-5 d-flex">
            <div class="flex-grow-1 mt-4">
                <h3 class="text-white">In Service</h3>
                <p class="text-white" style="margin:0px;">
                    Please kindly bring your cash or check to our Sunday service.
                </p>
                <div>
                    <a href="" class="bg-white rounded-lg p-4">
                        <img src="{{ asset('icons/paypal.png') }}" />
                    </a>
                </div>
            </div>
            <div style="width: 100px" class="d-flex justify-content-center items-center">
                <div style="border-left:1px solid #4f5459;"></div>
            </div>
            <div class="flex-grow-1 mt-4">
                <h3 class="text-white mb-3">Via Bank Account Below</h3>
                @if (isset($banks) && $banks->count())
                <div class="d-flex">
                    @foreach ($banks as $key => $bank)
                    <div style="margin-right:2rem;">
                        <a href="#" data-bank="{{ json_encode($bank) }}" class="bank-info">
                            <img src="{{ $bank->icon }}" />
                        </a>
                    </div>
                    @endforeach
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endif
<button type="button" class="btn btn-primary" id="button-modal" data-bs-toggle="modal" data-bs-target="#exampleModal" style="display:none;"></button>
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content rounded-2">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <img id="qr_code" class="img-fluid" />
            </div>
            <div class="p-3">
                <div style="border:1px solid #d8dbdd;" class="p-2 rounded-lg text-center d-flex items-center justify-content-center">
                    <div>{{ __('common.Account Number') }} :&nbsp;</div>
                    <div id="account-number"></div>
                </div>
                <div class="mb-3"></div>
                <div style="border:1px solid #d8dbdd;" class="p-2 rounded-lg text-center d-flex items-center justify-content-center">
                    <div>{{ __('common.Account Name') }} :&nbsp;</div>
                    <div id="account-name"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->

<script>
    $(document).ready(function() {
        $(".bank-info").on("click", function() {
            var bank = $(this).data("bank");
            $("#qr_code").attr("src", bank.qr_code);
            $("#account-number").text(bank.number);
            $("#account-name").text(bank.account_name);
            $("#button-modal").click();
            $("#exampleModal .modal-title").html(bank.name);
        });
    })

</script>

@endsection
