@extends('backend.layout.app')
@section('title', 'Posts')
@push('css')
    <link href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap.min.css" rel="stylesheet">
@endpush
@section('content')

    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Favorite Posts <strong style="font-size:15px;">{{ $posts->count() }}</strong></h2>
            <ol class="breadcrumb">
                <li>
                    <a href="index.html">Home</a>
                </li>
                <li>
                    <a>Forms</a>
                </li>
                <li class="active">
                    <strong>Basic Form</strong>
                </li>
            </ol>
        </div>
        <div class="col-lg-2">
            <div class="ibox-tools">
                <a href="{{ route('admin.posts.create') }}" class="btn btn-sm btn-primary pull-right m-t-n-xs"
                   type="submit"><i class="fa fa-plus"></i> <strong>Create</strong></a>
            </div>
        </div>
    </div>

    <table id="example" class="table table-striped table-bordered" style="width:100%">
        <thead>
        <tr>
            <th>Title</th>
            <th>Author</th>
            <th>View Count</th>
            <th>Favorite</th>
            <th class="actionCenter action_custom_width">Action</th>
        </tr>
        </thead>
        <tbody>

        @foreach($posts as $post )
            <tr>
                <td>{{ \Illuminate\Support\Str::limit($post->title, '10') }}</td>
                <td>{{ $post->user->name }}</td>
                <td>{{ $post->view_count }}</td>
                <td>{{ $post->favorite_to_users }}</td>
                <td class="actionCenter">

                </td>
            </tr>
        @endforeach

        </tbody>
        <tfoot>
        <tr>
            <th>Title</th>
            <th>Author</th>
            <th>View Count</th>
            <th>Favorite</th>
            <th class="actionCenter action_custom_width">Action</th>
        </tr>
        </tfoot>
    </table>
@endsection

@push('scripts')
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"> </script>
    <script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap.min.js"> </script>
    <script type="text/javascript">

        $(document).ready(function() {
            $('#example').DataTable();
        } );

            function approved(id){
                swal({
                    title: "Are you sure approved this post?",
                    text: "You will not be able to recover this post!",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: "Yes, Approved it!",
                    closeOnConfirm: false
                }, function () {
                    swal("Changed!", "Your imaginary file has been change.", "success");
                    event.preventDefault();
                    document.getElementById('approved-'+id).submit();
                })
            }

    </script>
@endpush

