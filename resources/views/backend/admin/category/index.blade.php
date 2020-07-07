@extends('backend.layout.app')
@section('title', ' Category ')
@push('css')
    <link href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap.min.css" rel="stylesheet">
@endpush
@section('content')

<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>All Categories <strong style="font-size:15px;">{{ $categories->count() }}</strong></h2>
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
            <a href="{{ route('backend.admin.category.create') }}" class="btn btn-sm btn-primary pull-right m-t-n-xs" 
            type="submit"><i class="fa fa-plus"></i> <strong>Create</strong></a>
        </div>
    </div>
</div>

<table id="example" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>Name</th>
                <th>Slug</th>
                <th>Image</th>
                <th>Post Count</th>
                <th>Created At</th>
                <th class="actionCenter">Action</th>
            </tr>
        </thead>
        <tbody>
      
            @foreach($categories as $category )
                <tr>
                    <td>{{  $category->name }}</td>
                    <td>{{  $category->slug }}</td>
                    <td>{{  $category->image }}</td>
                    <td>{{  $category->posts->count() }}</td>
                    <td>{{  $category->created_at }}</td>
                    <td class="actionCenter">
                        <a title="Edit" href="{{ route('backend.admin.category.edit', $category->id) }}" class="cus_mini_icon color-success"> 
                            <i class="fa fa-pencil-square-o"></i></a>

                        <button type="button" onclick="deleteItem({{ $category->id }})" class="cus_mini_icon color-danger"><i class="fa fa-trash "></i></button>

                        <form id="delete-form-{{ $category->id }}" style="display:hidden" action="{{ route('backend.admin.category.destroy', $category->id) }}" method="post">
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
                <th>Name</th>
                <th>Slug</th>
                <th>Image</th>
                <th>Post Count</th>
                <th>Created At</th>
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

    