<!DOCTYPE HTML>
<html lang="en">

    <head>
        <title>@yield('title')</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta charset="UTF-8">
        <meta name="csrf_token" content="{{ csrf_token() }}" />
        <!-- Font -->
        <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500" rel="stylesheet">
        <!-- Stylesheets -->
        <link href="{{ asset('frontend/css/bootstrap.css') }}" rel="stylesheet">

        <link href="{{ asset('frontend/css/swiper.css') }}" rel="stylesheet">
        <!-- Toastr style -->
        <link href="{{ asset('backend/css/plugins/toastr/toastr.min.css')}}" rel="stylesheet">
        <link href="{{ asset('frontend/css/ionicons.css') }}" rel="stylesheet">
        @stack('css')
        <link href="{{ asset('frontend/css/custom_style.css') }}" rel="stylesheet">

    </head>
    <body>
        @include('frontend.element.header')

        @yield('content')

        @include('frontend.element.footer')

        <script src="{{ asset('frontend/js/jquery-3.1.1.min.js') }}"></script>

        <script src="{{ asset('frontend/js/tether.min.js') }}"></script>

        <script src="{{ asset('frontend/js/bootstrap.js') }}"></script>
        <!-- Toastr -->
        <script src="{{ asset('backend/js/plugins/toastr/toastr.min.js')}}"></script>

        {!! Toastr::message() !!}

        @stack('js')

        <script type="text/javascript">
            function getSuggestion(e) {
                var search = $(e).val();

                if (search.trim() === ''){
                    $('#show-suggestion').html('').addClass('hidden');
                    return;
                }

                $.get('{{ route("auto.complete.posts") }}', { search : search }, function(response){
                    if(response.length > 0){
                        $('#show-suggestion').removeClass('hidden').html(response);
                    }else{
                        $('#show-suggestion').addClass('hidden');
                    }
                });
            }
        </script>
    </body>
</html>
