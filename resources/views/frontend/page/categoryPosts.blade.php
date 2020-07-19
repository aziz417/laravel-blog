@extends('frontend.layout.app')
@section('title', 'Category Posts')
@push('css')
    <link href="{{ asset('frontend/css/posts/responsive.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/css/posts/styles.css') }}" rel="stylesheet">
    <style>
        .favorite_post{
            color:blue;
        }
        .slider {
            height: 400px;
            width: 100%;
            background-image: url({{ Storage::disk('public')->url('category/').$category->image }});
            background-size: cover;
        }
    </style>
@endpush

@section('content')
    <div class="slider display-table center-text">
        <h1 class="title display-table-cell"><b>{{ $category->name }}</b></h1>
    </div><!-- slider -->

    <section class="blog-area section">
        <div class="container">

            <div class="row">
                @foreach($category->posts as $post)
                    <div class="col-lg-4 col-md-6">
                        <div class="card h-100">
                            <div class="single-post post-style-1">

                                <div class="blog-image"><a href="{{ route('post.details', ['id' => $post->id, 'slug' => $post->slug]) }}"><img src="{{ Storage::disk('public')->url('post/').$post->image }}" alt="Blog Image"></a></div>

                                <a class="avatar" href="#"><img src="{{ Storage::disk('public')->url('profile/').$post->user->image }}" alt="Profile Image"></a>

                                <div class="blog-info">

                                    <h4 class="title"><a href="{{ route('post.details', ['id' => $post->id, 'slug' => $post->slug]) }}"><b>{{ $post->title }}</b></a></h4>

                                    <ul class="post-footer">
                                        <li>
                                            @guest()
                                                <a href="javascript:void(0);" onclick="toastr.info('To' +
                                                     ' add favorite list, You need to login first.', 'Info',{
                                                        closeButton: true,
                                                        progressBar: true,
                                                     })">
                                                    <i class="ion-heart"></i>{{ $post->favorite_to_users->count() }}
                                                </a>
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
                                        <li><a href="#"><i class="ion-chatbubble"></i>{{ $post->comments->count() }}</a></li>
                                        <li><a href="#"><i class="ion-eye"></i>{{ $post->view_count }}</a></li>
                                    </ul>

                                </div><!-- blog-info -->
                            </div><!-- single-post -->
                        </div><!-- card -->
                    </div><!-- col-lg-4 col-md-6 -->
                @endforeach
            </div><!-- row -->

           {{-- {{ $posts->links() }}--}}

        </div><!-- container -->
    </section><!-- section -->
@endsection
