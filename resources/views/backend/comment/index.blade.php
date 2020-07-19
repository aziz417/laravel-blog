@extends('backend.layout.app')
@section('title', ' Comments ')
@push('css')
    <link href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap.min.css" rel="stylesheet">
@endpush
@section('content')

    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>All Comments <strong style="font-size:15px;">{{ $comments->count() }}</strong></h2>
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
            <th>Comment info</th>
            <th>Post info</th>
            <th class="actionCenter">Action</th>
        </tr>
        </thead>
        <tbody>

        @foreach($comments as $key=>$comment )
            <tr>
                <td>{{  $key+1 }}</td>
                <td>
                    <img style="width: 30px; height: 30px; border-radius: 3px"  src="{{ Storage::disk('public')->url('profile/').$comment->user->image }}" alt="">
                    <strong><span>{{ ucfirst($comment->user->name) }}</span></strong>
                    <span>{{ $comment->created_at->diffForHumans() }}</span>
                    <hr class="coustom_hr">
                    <p>{{ ucfirst( $comment->comment)  }}</p>
                </td>
                <td>
                    <div class="row">
                        <div class="col-sm-2">
                            <img style="width: 60px; height: 60px; border-radius: 3px"  src="{{ Storage::disk('public')->url('post/').$comment->post->image }}" alt="">
                        </div>
                        <div class="col-sm-10">
                            <h5><strong>{{  Str::limit(ucfirst($comment->post->title), 40) }}</strong></h5>
                            <small>by <strong>{{ ucfirst($comment->post->user->name) }}</strong></small>
                            <h5>{{ $comment->post->created_at->diffForHumans() }}</h5>
                        </div>
                    </div>
                </td>
                <td class="actionCenter">
                    <button type="button" onclick="deleteItem({{ $comment->id }})" class="cus_mini_icon color-danger"><i class="fa fa-trash "></i></button>

                  @if(Auth::user()->role_id == 1)
                        <form id="delete-form-{{ $comment->id }}" style="display:hidden" action="{{ route('admin.comment.destroy', $comment->id ) }}" method="post">
                            @csrf
                            @method('delete')
                        </form>
                    @else
                        <form id="delete-form-{{ $comment->id }}" style="display:hidden" action="{{ route('author.comment.destroy', $comment->id ) }}" method="post">
                            @csrf
                            @method('delete')
                        </form>
                    @endif
                </td>
            </tr>
            </form>
        @endforeach

        </tbody>
        <tfoot>
        <tr>
            <th>Sl</th>
            <th>Comment info</th>
            <th>Post info</th>
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

