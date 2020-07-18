@extends('frontend.layout.app')
@section('title', 'Post Details')
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
    <div class="slider">

    </div><!-- slider -->

    <section class="post-area">
        <div class="container">

            <div class="row">

                <div class="col-lg-1 col-md-0"></div>
                <div class="col-lg-10 col-md-12">

                    <div class="main-post">

                        <div class="post-top-area">

                            <h5 class="pre-title">FASHION</h5>

                            <h3 class="title"><a href="#"><b>{{ $post->title }}</b></a></h3>

                            <div class="post-info">

                                <div class="left-area">
                                    <a class="avatar" href="#"><img src="{{ Storage::disk('public')->url('profile/').$post->user->image}}" alt="Profile Image"></a>
                                </div>

                                <div class="middle-area">
                                    <a class="name" href="#"><b>{{$post->user->name}}</b></a>
                                    <h6 class="date">{{ $post->created_at->diffForHumans() }}</h6>
                                </div>

                            </div><!-- post-info -->

                            <p class="para">{{ $post->body }}</p>

                        </div><!-- post-top-area -->

                        <div class="post-image"><img src="{{ Storage::disk('public')->url('post/').$post->image }}" alt="Blog Image"></div>

                        <div class="post-bottom-area">

                            {{--<p class="para">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et
                                dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex
                                ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat
                                nulla pariatur. Excepteur sint
                                occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum</p>--}}
                            <ul class="tags">
                                @foreach($post->tags as $tag)
                                    <li><a href="#">{{ $tag->name }}</a></li>
                                @endforeach
                            </ul>

                            <div class="post-icons-area">
                                <ul class="post-icons">
                                    <li>
                                        @guest()
                                            <a href="javascript:void(0);" onclick="toastr.info('To' +
                                             ' add favorite list, You need to login first.', 'Info',{
                                                closeButton: true,
                                                progressBar: true,
                                             })">
                                                <i class="ion-heart"></i>{{ $post->favorite_to_users->count() }}</a>
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
                                    <li><a href="#"><i class="ion-chatbubble"></i>6</a></li>
                                    <li><a href="#"><i class="ion-eye"></i>{{ $post->view_count }}</a></li>
                                </ul>

                                <ul class="icons">
                                    <li>SHARE : </li>
                                    <li><a href="#"><i class="ion-social-facebook"></i></a></li>
                                    <li><a href="#"><i class="ion-social-twitter"></i></a></li>
                                    <li><a href="#"><i class="ion-social-pinterest"></i></a></li>
                                </ul>
                            </div>

                            <div class="post-footer post-info">

                                <ul class="tags">
                                    @foreach($post->categories as $category)
                                        <li><a href="#">{{ $category->name }}</a></li>
                                    @endforeach
                                </ul>

                            </div><!-- post-info -->

                        </div><!-- post-bottom-area -->

                    </div><!-- main-post -->
                </div><!-- col-lg-8 col-md-12 -->
            </div><!-- row -->
        </div><!-- container -->
    </section><!-- post-area -->


    <section class="recomended-area section">
        <div class="container">
            <div class="row">

                @foreach($randomPosts as $randomPost)
                    <div class="col-lg-4 col-md-6">
                        <div class="card h-100">
                            <div class="single-post post-style-1">

                                <div class="blog-image"><img src="{{ Storage::disk('public')->url('post/').$randomPost->image }}" alt="Blog Image"></div>

                                <a class="avatar" href="#"><img src="{{ Storage::disk('public')->url('profile/').$post->user->image }}" alt="Profile Image"></a>

                                <div class="blog-info">

                                    <h4 class="title"><a href="#"><b>{{ $randomPost->title }}</b></a></h4>

                                    <ul class="post-footer">
                                        <li>
                                            @guest()
                                                <a href="javascript:void(0);" onclick="toastr.info('To' +
                                             ' add favorite list, You need to login first.', 'Info',{
                                                closeButton: true,
                                                progressBar: true,
                                             })">
                                                    <i class="ion-heart"></i>{{ $randomPost->favorite_to_users->count() }}</a>
                                            @else
                                                <a class="{{ !Auth::user()->favorite_posts()
                                            ->where('post_id',$randomPost->id)->count() == 0 ? 'favorite_post': '' }}"
                                                   href="javascript:void(0);" onclick="document.getElementById
                                                    ('favorite-form-{{ $randomPost->id }}').submit();">
                                                    <form id="favorite-form-{{ $randomPost->id }}"
                                                          action="{{ route('post.favorite', $randomPost->id) }}" method="post" style="display: none">
                                                        @csrf
                                                    </form>
                                                    <i class="ion-heart"></i>{{ $randomPost->favorite_to_users->count() }}</a>
                                            @endguest
                                        </li>
                                        <li><a href="#"><i class="ion-chatbubble"></i>6</a></li>
                                        <li><a href="#"><i class="ion-eye"></i>{{ $randomPost->view_count }}</a></li>
                                    </ul>

                                </div><!-- blog-info -->
                            </div><!-- single-post -->
                        </div><!-- card -->
                    </div><!-- col-md-6 col-sm-12 -->
                @endforeach

            </div><!-- row -->

        </div><!-- container -->
    </section>

    <section class="comment-section center-text">
        <div class="container">
            <h4><b>POST COMMENT</b></h4>
            <div class="row">

                <div class="col-lg-2 col-md-0"></div>
                <div class="col-lg-8 col-md-12">
                    <div class="comment-form">
                        <form method="post" action="{{ route('comment.store', $post->id) }}">
                            @csrf
                            <div class="row">
                                <div class="col-sm-12">
									<textarea name="comment" rows="2" class="text-area-messge form-control"
                                              placeholder="Enter your comment" aria-required="true" aria-invalid="false"></textarea >
                                </div><!-- col-sm-12 -->
                                <div class="col-sm-12">
                                    <button class="submit-btn" type="submit" id="form-submit"><b>POST COMMENT</b></button>
                                </div><!-- col-sm-12 -->

                            </div><!-- row -->
                        </form>
                    </div><!-- comment-form -->

                    <h4><b>COMMENTS({{ $post->comments()->count() }})</b></h4>

                    @foreach($post->comments as $comment)

                        <div class="commnets-area text-left">

                            <div class="comment">

                                <div class="post-info">

                                    <div class="left-area">
                                        <a class="avatar" href="#"><img src="{{ Storage::disk('public')->url('profile/').$comment->user->image }}" alt="Profile Image"></a>
                                    </div>

                                    <div class="middle-area">
                                        <a class="name" href="#"><b>{{ $comment->user->name }}</b></a>
                                        <h6 class="date">{{ $comment->created_at->diffForHumans() }}</h6>
                                    </div>

                                    <div class="right-area">
                                        <h5 class="reply-btn" ><a href="#"><b>REPLY</b></a></h5>
                                    </div>

                                </div><!-- post-info -->

                                <p>{{ $comment->comment }}</p>
                            </div>
                        </div><!-- commnets-area -->
                    @endforeach
                    <a class="more-comment-btn" href="#"><b>VIEW MORE COMMENTS</a>

                </div><!-- col-lg-8 col-md-12 -->

            </div><!-- row -->

        </div><!-- container -->
    </section>
@endsection

@push('js')
    <link href="{{ asset('frontend/js/scripts.js') }}" rel="stylesheet">
@endpush

