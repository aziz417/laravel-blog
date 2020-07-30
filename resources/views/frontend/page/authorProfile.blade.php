@extends('frontend.layout.app')
@section('title', 'Author Profile')
@push('css')
    <link href="{{ asset('frontend/css/profile/responsive.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/css/profile/styles.css') }}" rel="stylesheet">
    <style>
        .favorite_post{
            color:blue;
        }
    </style>
@endpush

@section('content')

    <div class="slider display-table center-text">
        <h1 class="title display-table-cell"><b>{{ $author->name }}</b></h1>
    </div><!-- slider -->

    <section class="blog-area section">
        <div class="container">

            <div class="row">

                <div class="col-lg-8 col-md-12">
                    @if($posts->count() > 0)
                        <div class="row">
                            @foreach($posts as $post)
                                <div class="col-md-6 col-sm-12">
                                    <div class="card h-100">
                                        <div class="single-post post-style-1">
                                            <div class="blog-image"><a href="{{ route('post.details', ['id' => $post->id, 'slug' => $post->slug]) }}"><img src="{{ Storage::disk('public')->url('post/').$post->image }}" alt="Blog Image"></a></div>

                                            <a class="avatar" href="{{ route('author.profile', ['slug' => Str::slug($post->user->username), 'id' => $post->user->id ]) }}"><img src="{{ Storage::disk('public')->url('profile/').$post->user->image }}" alt="Profile Image"></a>

                                            <div class="blog-info">

                                                <a href="{{ route('post.details', ['id' => $post->id, 'slug' => $post->slug]) }}"> <h4 class="title"><b>{{ $post->title }}</b></h4></a>

                                                <ul class="post-footer">
                                                    <li>
                                                        @guest()
                                                            <a href="javascript:void(0);" onclick="toastr.info('To' +
                                                                'add favorite list, You need to login first.', 'Info',{
                                                                closeButton: true,
                                                                progressBar: true,
                                                             })"><i class="ion-heart"></i>{{ $post->favorite_to_users->count() }}</a>
                                                        @else
                                                            <a class="{{ !Auth::user()->favorite_posts()
                                                                ->where('post_id',$post->id)->count() == 0 ? 'favorite_post': '' }}"
                                                               href="javascript:void(0);" onclick="document.getElementById
                                                                ('favorite-form-{{ $post->id }}').submit();">
                                                                <form id="favorite-form-{{ $post->id }}"
                                                                      action="{{ route('post.favorite', $post->id) }}" method="post" style="display: none">
                                                                    @csrf
                                                                </form>
                                                                <i class="ion-heart"></i>{{ $post->favorite_to_users->count() }}</a>
                                                        @endguest
                                                    </li>
                                                    <li><a href="{{ route('post.details', ['id' => $post->id, 'slug' => $post->slug]) }}#comment"><i class="ion-chatbubble"></i>{{ $post->comments->count() }}</a></li>
                                                    <li><a href="#"><i class="ion-eye"></i>{{ $post->view_count }}</a></li>
                                                </ul>

                                            </div><!-- blog-info -->
                                        </div><!-- single-post -->
                                    </div><!-- card -->
                                </div><!-- col-md-6 col-sm-12 -->
                            @endforeach
                        </div><!-- row -->
                    @else
                        <div class="row">
                            <div class="col-sm-12">
                                <span class="text-center">No post found (:</span>
                            </div>
                        </div>
                    @endif

                    {{ $posts->links() }}

                </div><!-- col-lg-8 col-md-12 -->

                <div class="col-lg-4 col-md-12 ">

                    <div class="single-post info-area ">

                        <div class="about-area">
                            <p><b><strong>{{ $author->name }}</strong></b></p><br>
                            <p>Registration Date: <strong>{{ $author->created_at->toDateString()}}</strong></p>
                            <p>Total Posts: <strong>{{ $author->posts->count()}}</strong></p>
                            <p>About of <strong>{{ $author->name }}</strong>: {!! $author->about !!}</p>
                        </div>

                        <div class="tag-area">

                            <h4 class="title"><b>Top Post</b></h4>
                            <ul>
                                @foreach($author->posts as $post)
                                    <li><a href="#">{{ Str::limit($post->title, 20) }}</a></li>
                                @endforeach
                            </ul>

                        </div><!-- subscribe-area -->

                    </div><!-- info-area -->

                </div><!-- col-lg-4 col-md-12 -->

            </div><!-- row -->

        </div><!-- container -->
    </section><!-- section -->
@endsection

