@extends('backend.layout.app')
@section('title', 'Dashboard')
@push('css')

@endpush
@section('content')

    <div class="row">
        <div class="col-lg-3">
            <div class="ibox ">
                <div class="ibox-title">
                    <span class="label  label-success cus_btn_size">Posts</span>
                </div>
                <div class="ibox-content">
                    <h1 class="no-margins">{{ $user->posts->count() }}</h1>
                    <small>Total Posts</small>
                </div>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="ibox ">
                <div class="ibox-title">
                    <span class="label label-info cus_btn_size">Pending Posts</span>
                </div>
                <div class="ibox-content">
                    <h1 class="no-margins">{{ $pending_posts->count() }}</h1>
                    <small>Pending Posts</small>
                </div>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="ibox ">
                <div class="ibox-title">
                    <span class="label label-primary cus_btn_size">Comments</span>
                </div>
                <div class="ibox-content">
                    <h1 class="no-margins">{{ $user->comments->count() }}</h1>
                    <small>Your Comments</small>
                </div>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="ibox ">
                <div class="ibox-title">
                    <span class="label label-danger cus_btn_size">{{ $user->name }}</span>
                </div>
                <div class="ibox-content">
                    <h1 class="no-margins"></h1>
                    <small>In first month</small>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="ibox">
                <div class="ibox-title" style="background: #23c6c8;">
                    <h5>Popular Posts List</h5>
                </div>
                <div class="ibox-content table-responsive">
                    <table class="table table-hover no-margins">
                        <thead>
                        <tr>
                            <th>Sl</th>
                            <th>Title</th>
                            <th>View</th>
                            <th>Comment</th>
                            <th>Favorite</th>
                            <th>Created At</th>
                            <th>Status</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($popular_posts as $key=> $post)
                            <tr>
                                <td>{{ $key+1 }}</td>
                                <td>{{ Str::limit($post->title, 40) }}</td>
                                <td>{{ $post->view_count }}</td>
                                <td>{{ $post->comments_count }}</td>
                                <td>{{ $post->favorite_to_users_count }}</td>
                                <td>{{ $post->created_at }}</td>
                                <td><span class="btn btn-danger">{{ $post->status == 1 ? 'Publish' : 'Un-publish' }}</span></td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="ibox">
                <div class="ibox-title" style="background: #E8D0DF;">
                    <h5>Pending Post List</h5>
                </div>
                <div class="ibox-content table-responsive">
                    <table class="table table-hover no-margins">
                        <thead>
                        <tr>
                            <th>Sl</th>
                            <th>Title</th>
                            <th>Created At</th>
                            <th>Status</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($pending_posts as $key=> $post)
                            <tr>
                                <td>{{ $key+1 }}</td>
                                <td>{{ Str::limit($post->title, 40) }}</td>
                                <td>{{ $post->created_at }}</td>
                                <td><span class="btn btn-danger">{{ $post->is_approved == 1 ? 'Approved' : 'No Approve' }}</span></td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


@endsection

@push('scripts')

@endpush

