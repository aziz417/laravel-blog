@extends('backend.layout.app')
@section('title', 'Profile Update')

@push('css')

@endpush

@section('content')
    <div style="margin:3% 0 3% 0"><h2 class="text-center"><strong>{{ $user->name }} Profile</strong></h2></div>

    <section class="blog-area section">
        <div class="container">
            <form method="POST" enctype="multipart/form-data" action="{{ route('author.author.update', $user->id) }}">
                @csrf
                @method('PUT')

                <div class="form-group row">
                    <label for="name" class="col-md-2 col-form-label text-md-right">{{ __('Name') }}</label>

                    <div class="col-md-6">
                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $user->name }}" required autocomplete="name" autofocus>

                        @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="email" class="col-md-2 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                    <div class="col-md-6">
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $user->email }}" required autocomplete="email">

                        @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="about" class="col-md-2 col-form-label text-md-right">{{ __('About') }}</label>

                    <div class="col-md-6">
                        <textarea id="about" type="text" class="form-control" name="about" required>{{ $user->about }}</textarea>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="password" class="col-md-2 col-form-label text-md-right">{{ __('New Password') }}</label>

                    <div class="col-md-6">
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                        @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="password-confirm" class="col-md-2 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                    <div class="col-md-6">
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="image" class="col-md-2 col-form-label text-md-right">{{ __('Image') }}</label>

                    <div class="col-md-6">
                        <input id="image" type="file" class="form-control" name="img">
                        <br>
                            <div class="pull-right">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Update') }}
                                </button>
                            </div>
                        <a href="{{ route('author.dashboard') }}" type="submit" class="btn btn-info" class="btn btn-primary">
                            {{ __('Back') }}
                        </a>
                        <br>
                        <br>

                        @if($user->image == "default.png")
                            <img alt="image" class="thumbnail" src="{{ asset('backend/img/profile_small.jpg')}}" />
                        @else
                            <img alt="profile image" class="thumbnail" src="{{ Storage::disk('public')->url('profile/').$user->image }}">
                        @endif
                    </div>
                </div>
                <br>
                <br>
            </form>

        </div><!-- container -->
    </section><!-- section -->
@endsection



