@extends('../layouts.app')
@section('content')
    <div class="headerPage text-center">
        <h1>Welcome to my Blog</h1>
        <h4>All our posts</h4>
        <span><a href="{{ route('create.post') }}">Write a post</a></span>
    </div>
    <hr>
    @include('partials.successAlert')

    @forelse ($posts as $key => $post)
        <h2 class="title"><a href="{{ route('show.post', $post->id) }}">{{ $post->title }}</a></h2>
        <h5>{{ $post->summary }}</h5>
        <span>
            <b>Author</b> : <cite>{{ $post->author }}</cite> -
            <a type="submit" href="{{ route('show.post', $post->id) }}"
                style="text-decoration: none">{{ $post['comments']->count() }}
                {{ $post['comments']->count() != 1 ? 'Comments' : 'Comment' }}
            </a>
        </span>
        <form action="{{ route('remove.post', $post->id) }}" method="post">
            @csrf
            @method('DELETE')
            <a href="{{ route('change.post', $post->id) }}">Edit</a>
            <button type="submit" class="btn btn-link">Delete</button>
        </form>
        <hr>
        <br>
    @empty
        <p>Not data available...</p>
    @endforelse
    {{ $posts->links('pagination::bootstrap-4') }}
@endsection
