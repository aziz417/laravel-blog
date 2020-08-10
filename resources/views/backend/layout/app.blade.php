<!DOCTYPE html>
<html>
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>
        @yield('title')
    </title>

    <link href="{{ asset('backend/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{ asset('backend/font-awesome/css/font-awesome.css')}}" rel="stylesheet">

    <!-- Toastr style -->
    <link href="{{ asset('backend/css/plugins/toastr/toastr.min.css')}}" rel="stylesheet">

     <!-- Sweet Alert -->
     <link href="{{ asset('backend/css/plugins/sweetalert/sweetalert.css') }}" rel="stylesheet">

    <link href="{{ asset('backend/css/animate.css')}}" rel="stylesheet">
    <link href="{{ asset('backend/css/style.css')}}" rel="stylesheet">
    <link href="{{ asset('backend/css/coustom_style.css')}}" rel="stylesheet">
    @stack('css')

</head>

<body>
    <div id="wrapper">

        @include('backend.element.sidebar')

        <div id="page-wrapper" class="gray-bg dashbard-1">

            @include('backend.element.header')

            @yield('content')
            @include('backend.element.footer')
        </div>

    </div>



    <!-- Mainly scripts -->
    <script src="{{ asset('backend/js/jquery-3.1.1.min.js')}}"></script>
    <script src="{{ asset('backend/js/bootstrap.min.js')}}"></script>
    <script src="{{ asset('backend/js/plugins/metisMenu/jquery.metisMenu.js')}}"></script>
    <script src="{{ asset('backend/js/plugins/slimscroll/jquery.slimscroll.min.js')}}"></script>

    <!-- Custom and plugin javascript -->
    <script src="{{ asset('backend/js/inspinia.js')}}"></script>

    <!-- Toastr -->
    <script src="{{ asset('backend/js/plugins/toastr/toastr.min.js')}}"></script>

    {!! Toastr::message() !!}

    @stack('scripts')
    <!-- Sweet alert -->
    <script src="{{ asset('backend/js/plugins/sweetalert/sweetalert.min.js') }}"></script>

    <script type="text/javascript">

        function deleteItem(id){
            swal({
                title: "Are you sure delete this item?",
                text: "You will not be able to recover this item file!",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: "Yes, delete it!",
                closeOnConfirm: false
            }, function () {
                swal("Deleted!", "Your imaginary file has been deleted.", "success");
                event.preventDefault();
                document.getElementById('delete-form-'+id).submit();
            })
        }
    </script>

</body>
</html>
