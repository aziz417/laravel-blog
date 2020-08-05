<ul>
    @foreach($posts as $post)
    <li>
        <a>
            <img src="{{ Storage::disk('public')->url('post/'.$post->image) }}">
            <span>{{ $post->title }}</span><br>
            <span><small>Created on by <b>{{ $post->user->name }}</b></small></span>
        </a>
    </li>
    @endforeach
</ul>
