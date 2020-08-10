@extends('frontend.layout.app')
@section('title', 'Welcome to our laravel blog site')

@push('css')
    <link href="{{ asset('frontend/css/home/styles.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/css/home/responsive.css') }}" rel="stylesheet">
    <style>
        .favorite_post{
            color:blue;
        }
    </style>
@endpush

@section('content')
<div class="main-slider">
    <div class="swiper-container position-static" data-slide-effect="slide" data-autoheight="false"
        data-swiper-speed="500" data-swiper-autoplay="10000" data-swiper-margin="0" data-swiper-slides-per-view="4"
        data-swiper-breakpoints="true" data-swiper-loop="true" >
        <div class="swiper-wrapper">

            @foreach($categories as $category)
                <div class="swiper-slide">
                    <a class="slider-category" href="{{ route('category.post', [ 'category' => $category->slug, 'id' =>$category->id ] ) }}">
                        <div class="blog-image"><img src="{{ Storage::disk('public')->url('category/slider/').$category->image }}" alt="{{ $category->name }}"></div>

                        <div class="category">
                            <div class="display-table center-text">
                                <div class="display-table-cell">
                                    <h3><b>{{ $category->name }}</b></h3>
                                </div>
                            </div>
                        </div>

                    </a>
                </div><!-- swiper-slide -->
            @endforeach

        </div><!-- swiper-wrapper -->

    </div><!-- swiper-container -->

</div><!-- slider -->


<section class="blog-area section">
    <div class="container">
        @if($posts->count() > 0 )
            <div class="row">
                @foreach($posts  as $post)
                    <div class="col-lg-4 col-md-6">
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
                                        <li><a href="{{ route('post.details', ['id' => $post->id, 'slug' => $post->slug]) }}#comment"><i class="ion-chatbubble"></i>{{ $post->comments->count() }}</a></li>
                                        <li><a href="#"><i class="ion-eye"></i>{{ $post->view_count }}</a></li>
                                    </ul>

                                </div><!-- blog-info -->
                            </div><!-- single-post -->
                        </div><!-- card -->
                    </div><!-- col-lg-4 col-md-6 -->
                @endforeach
            </div><!-- row -->
            {{ $posts->links() }}
        @else
            <div class="row">
                <div class="col-sm-12">
                    <span class="text-center">No post found (:</span>
                </div>
            </div>
        @endif
    </div><!-- container -->
</section><!-- section -->
@endsection

@push('js')
    <script src="{{ asset('frontend/js/home/swiper.js') }}"></script>
    <script src="{{ asset('frontend/js/home/scripts.js') }}"></script>
@endpush
