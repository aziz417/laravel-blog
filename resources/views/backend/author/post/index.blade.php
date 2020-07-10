@extends('backend.layout.app')
@section('title', 'Posts')
@push('css')
    <link href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap.min.css" rel="stylesheet">
@endpush
@section('content')

<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>All Posts <strong style="font-size:15px;">{{ $posts->count() }}</strong></h2>
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
            <a href="{{ route('author.posts.create') }}" class="btn btn-sm btn-primary pull-right m-t-n-xs"
            type="submit"><i class="fa fa-plus"></i> <strong>Create</strong></a>
        </div>
    </div>
</div>

<table id="example" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>Title</th>
                <th>Author</th>
                <th>Slug</th>
                <th>Image</th>
                <th>Body</th>
                <th>View Count</th>
                <th>Status</th>
                <th>Is Approved</th>
                <th>Created At</th>
                <th class="actionCenter action_custom_width">Action</th>
            </tr>
        </thead>
        <tbody>

            @foreach($posts as $post )
                <tr>
                    <td>{{ \Illuminate\Support\Str::limit($post->title, '10') }}</td>
                    <td>{{ $post->user->name }}</td>
                    <td>{{ \Illuminate\Support\Str::limit($post->slug, '10') }}</td>
                    <td>{{ $post->image }}</td>
                    <td>{{ \Illuminate\Support\Str::limit($post->body, '15') }}</td>
                    <td>{{ $post->view_count }}</td>
                    <td>{{ $post->status == 1 ? 'Published': 'Unpublished' }}</td>
                    <td>{{ $post->is_approved == 1 ? 'Approved' : 'Pandaing' }}</td>
                    <td>{{ $post->created_at }}</td>
                    <td class="actionCenter">
                        <a title="Edit" href="{{ route('author.posts.show', $post->id) }}" class="cus_mini_icon color-info">
                            <i class="fa fa-eye"></i></a>
                        <a title="Edit" href="{{ route('author.posts.edit', $post->id) }}" class="cus_mini_icon color-success">
                            <i class="fa fa-pencil-square-o"></i></a>

                        <button type="button" onclick="deleteItem({{ $post->id }})" class="cus_mini_icon color-danger"><i class="fa fa-trash "></i></button>

                        <form id="delete-form-{{ $post->id }}" style="display:hidden" action="{{ route('author.posts.destroy', $post->id) }}" method="post">
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
                <th>Title</th>
                <th>Author</th>
                <th>Slug</th>
                <th>Image</th>
                <th>Body</th>
                <th>View Count</th>
                <th>Status</th>
                <th>Is Approved</th>
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

