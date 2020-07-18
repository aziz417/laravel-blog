@extends('backend.layout.app')
@section('title', ' Comments ')
@push('css')
    <link href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap.min.css" rel="stylesheet">
@endpush
@section('content')

    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>All Comments <strong style="font-size:15px;">----------{{--{{ $subscribers->count() }}--}}</strong></h2>
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
        </div>
    </div>

    <table id="example" class="table table-striped table-bordered" style="width:100%">
        <thead>
        <tr>
            <th>Sl</th>
            <th>Author</th>
            <th>Posts</th>
            <th>Time</th>
            <th>Comments</th>
            <th class="actionCenter">Action</th>
        </tr>
        </thead>
        <tbody>

        @foreach($posts as $key=>$post )
            <tr>
                <td>{{  $key+1 }}</td>
                <td>{{  $post->email }}</td>
                <td>{{  $post->created_at }}</td>
                <td>{{  $subscriber->updated_at }}</td>
                <td class="actionCenter">
                    <button type="button" onclick="deleteItem({{ $subscriber->id }})" class="cus_mini_icon color-danger"><i class="fa fa-trash "></i></button>

                    <form id="delete-form-{{ $subscriber->id }}" style="display:hidden" action="{{ route('admin.subscriber.destroy', $subscriber->id) }}" method="post">
                        @csrf
                        @method('delete')
                    </form>
                </td>
            </tr>
            </form>
        @endforeach

        </tbody>
        <tfoot>
        <tr>
            <th>Sl</th>
            <th>Email</th>
            <th>Created At</th>
            <th>Updated At</th>
            <th class="actionCenter">Action</th>
        </tr>
        </tfoot>
    </table>
@endsection

@push('scripts')
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"> </script>
    <script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap.min.js"> </script>
    <script>
        $(document).ready(function() {
            $('#example').DataTable();
        } );
    </script>
@endpush

