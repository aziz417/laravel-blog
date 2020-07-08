
@extends('backend.layout.app')
@section('title', 'Post View')
@push('css')

@endpush
@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>View Post</h2>
        <ol class="breadcrumb">
            <li>
                <a href="{{ route('admin.dashboard') }}">Home</a>
            </li>
            <li>
                <a>Post</a>
            </li>
            <li class="active">
                <strong>View</strong>
            </li>
        </ol>
    </div>
    <div class="col-lg-2">
        <div class="ibox-tools">
            <a href="{{ route('admin.posts.create') }}" class="btn btn-sm btn-primary pull-right m-t-n-xs"
               type="submit"><i class="fa fa-plus"></i> <strong>Create</strong></a>
        </div>
    </div>
</div>

<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-8">
            <div class="social-feed-box">
                <div class="social-avatar">
                    <div class="media-body">
                        @if($post->is_approved)
                            <button class="btn btn-xs btn-primary pull-right"><strong><i class="fa fa-check"></i> Approved</strong></button>
                        @else
                            <button class="btn btn-xs btn-warning pull-right"><strong><i class="fa fa-refresh"></i> Pending</strong></button>
                        @endif

                        <form id="approve-form{{ $post->id }}" method="GET" action=" " style="display: none" >
                            @csrf()
                        </form>
                        <h4><strong>{{ $post->title }}</strong></h4>
                        <p class="text-muted">Posted by <strong>{{ $post->user->name }}</strong> on {{ $post->created_at->toFormattedDateString() }}</p>
                    </div>
                </div>
                <div class="social-body">
                    {!! html_entity_decode($post->body) !!}
                </div>
            </div>

        </div>

        <div class="col-lg-4 m-b-lg">

            <div class="vertical-container light-timeline no-margins">
                <div class="vertical-timeline-block">
                    <div class="vertical-timeline-content float-e-margins">
                        <h2>Categories</h2>
                        @foreach($post->categories as $category)
                            <button class="btn btn-xs btn-info"><strong>{{ $category->name }}</strong></button>
                        @endforeach
                    </div>
                </div>

                <div class="vertical-timeline-block">
                    <div class="vertical-timeline-content float-e-margins">
                        <h2>Tags</h2>
                        @foreach($post->tags as $tag)
                            <button class="btn btn-xs btn-success"><strong>{{ $tag->name }}</strong></button>
                        @endforeach
                    </div>
                </div>

                <div class="vertical-timeline-block">
                    <div class="vertical-timeline-content">
                        <h2>Featured Image</h2>
                        <img alt="image" class="img-responsive b-r-sm" src="{{ Storage::disk('public')->url('post/'.$post->image) }}">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')

@endpush
