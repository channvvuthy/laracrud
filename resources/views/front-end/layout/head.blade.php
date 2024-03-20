<!DOCTYPE html>
<html lang="en">
{{ request()->getHost()}}
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <script src="{{ asset('dist/js/jquery.min.js') }}"></script>
    <script src="{{ asset('bootstrap/js/bootstrap.min.js') }}"></script>
    <title>
        @if (isset($siteTitle))
            {{ __('common.' . $siteTitle) }}
        @else
            Eternity Community church
        @endif
    </title>
    @if (Cache::has('fonts'))
        @foreach (Cache::get('fonts') as $font)
            <style>
                @font-face {
                    font-family: "{{ $font->name }}";
                    src: url("{{ $font->file }}") format('truetype');
                }
            </style>
        @endforeach
    @endif
    <style>
        body {
            font-family: 'siemreap', Droid Serif', Koulen, sans-serif !important;

        }

        .f-koulen {
            font-family: 'Koulen' !important;
        }

        .font-siemreap {
            font-family: innovate, 'siemreap' !important;
        }

        .documents {
            border-left: 1px solid #236DA3;
        }

        .border-b {
            border-bottom: 1px solid #236DA3;
        }

        .thumbnail {
            max-width: 40%;
        }

        .bg-overlay {
            background-color: rgba(0, 0, 0, 0.5);
        }

        .cursor-pointer {
            cursor: pointer;
        }

        .icon-play {
            width: 40px;
        }

        .rounded-base {
            border-radius: 1rem;
        }

        .rounded-top-base {
            border-top-left-radius: 1rem;
            border-top-right-radius: 1rem;
        }
    </style>
    @if (Cache::has('settings'))
        @php
            $setting = Cache::get('settings');
        @endphp
        <style>
            .nav-item a {
                font-family: {{ $setting->navbar_font }} !important;
            }

            p {
                font-family: {{ $setting->paragraph_font }} !important;
            }

            h1,
            h2,
            h3,
            h4,
            h5,
            h6 {
                font-family: {{ $setting->title_font }} !important;
            }
            p{
                line-height: {{ $setting->paragraph_line_height }} !important;
            }
        </style>
    @endif
    @stack('style')
</head>

<body>
