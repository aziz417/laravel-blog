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
                    <h1 class="no-margins">{{ $posts->count() }}</h1>
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
                    <span class="label label-primary cus_btn_size">Authors</span>
                </div>
                <div class="ibox-content">
                    <h1 class="no-margins">{{ $authors->count() }}</h1>
                    <small>Total Authors</small>
                </div>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="ibox ">
                <div class="ibox-title">
                    <span class="label label-danger cus_btn_size">Total View</span>
                </div>
                <div class="ibox-content">
                    <h1 class="no-margins">{{ $view_count }}</h1>
                    <small>Total View</small>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-3">
           <div class="ibox ">
               <div class="ibox-title">
                   <span class="label label-primary cus_btn_size">Total Categories</span>
               </div>
               <div class="ibox-content">
                   <h1 class="no-margins">{{ $categories }}</h1>
                   <small>Categories</small>
               </div>
           </div>

            <div class="ibox ">
                <div class="ibox-title">
                    <span class="label label-warning cus_btn_size">Total Tags</span>
                </div>
                <div class="ibox-content">
                    <h1 class="no-margins">{{ $tags }}</h1>
                    <small>Tags</small>
                </div>
            </div>

            <div class="ibox ">
                <div class="ibox-title">
                    <span class="label label-inverse cus_btn_size">New Authors</span>
                </div>
                <div class="ibox-content">
                    <h1 class="no-margins">{{ $new_authors }}</h1>
                    <small>Last 7 days new author</small>
                </div>
            </div>
        </div>

        <div class="col-lg-9">
            <div class="ibox">
                <div class="ibox-title" style="background: #23c6c8;">
                    <h5>Top 10 Popular Posts List</h5>
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
                <div class="ibox-title" style="background: #337ab7;">
                    <h5>Top 10 Active Author List</h5>
                </div>
                <div class="ibox-content table-responsive">
                    <table class="table table-hover no-margins">
                        <thead>
                        <tr>
                            <th>Sl</th>
                            <th>Name</th>
                            <th>Posts</th>
                            <th>Comments</th>
                            <th>Favorites</th>
                            <th>Created At</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($popular_authors as $key=> $author)
                            <tr>
                                <td>{{ $key+1 }}</td>
                                <td>{{ Str::limit($author->name, 40) }}</td>
                                <td>{{ $author->posts->count() }}</td>
                                <td>{{ $author->comments->count() }}</td>
                                <td>{{ $author->favorite_posts->count() }}</td>
                                <td>{{ $author->created_at }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <br>
    <br>



@endsection

@push('scripts')

@endpush

