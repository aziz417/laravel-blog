@extends('backend.layout.app')
@section('title', 'Dashbord')
@push('css')

@endpush
@section('content')

    <h2>Welcome Admin dashbord</h2>
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif
    <hr>
    <p>Lorem ipsum dolor sit amet, est ut amet metus montes pellentesque.
        Ligula tristique cras, voluptatibus sapien ut ut ut amet quam,
        urna commodo eu in, sollicitudin pede lectus arcu et arcu. Nec praesent neque
        ante, interdum metus nonummy, a nullam et dui. Gravida mauris
        commodo auctor rutrum, aliquam sem malesuada pretium. Non vel
        magnam vivamus cursus, cras massa. Hymenaeos lectus, condimentum
        laoreet soluta, tempus amet etiam vel ante. Lectus erat
        felis quis cras gravida, nec quisque elit maecenas. Venenatis
            lacinia sodales maecenas nisl, id vitae tellus, luctus consectetuer
            nunc convallis neque dolor cum, nam nam elit nunc.
     </p>
     

@endsection

@push('scripts')

@endpush

