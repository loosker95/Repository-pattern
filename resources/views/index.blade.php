@extends('../layouts.app')

<div class="menu" style="background-color: #1E2D7D; height:60px;">

</div>



@section('content')
    <div class="headerPage text-center">
        <h1>Welcome to my Blog</h1>
        <h4>All our posts</h4>
        <span><a href="{{ route('create.post') }}">Write a post</a></span>
    </div>



    @include('partials.successAlert')
    <div class="row">
        @forelse ($posts as $key => $post)
            <div class="col-md-9">
                <hr>
                <div class="row">
                    <div class="col-md-4">
                        <a href="#" class="indexImg">
                            <img src="https://bootstrapmade.com/demo/templates/ZenBlog/assets/img/post-landscape-6.jpg"
                                alt="" class="img-fluid">
                        </a>
                    </div>

                    <div class="col-md-8">
                        <h2 class="title">
                            <a href="{{ route('show.post', $post->slug) }}">{{ strip_tags($post->title) }}</a>
                        </h2>

                        <p style="margin-top: -7px; margin-bottom: 8px; color:grey;">Technology . sept 10 2023</p>

                        <h5 style="text-align: justify;">{{ strip_tags($post->summary) }}</h5>
                        <span>
                            <b>Author</b> : <cite>{{ $post->author }}</cite> -
                            <a type="submit" href="{{ route('show.post', $post->slug) }}"
                                style="text-decoration: none">{{ $post['comments']->count() }}
                                {{ $post['comments']->count() != 1 ? 'Comments' : 'Comment' }}
                            </a>
                        </span>

                        {{-- <form action="{{ route('remove.post', $post->id) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <a href="{{ route('change.post', $post->slug) }}">Edit</a>
                            <button type="submit" class="btn btn-link">Delete</button>
                        </form> --}}
                    </div>
                </div>
                <hr>
            </div>
        @empty
            <p>Not data available...</p>
        @endforelse
    </div>

    {{ $posts->links('pagination::bootstrap-4') }}
@endsection
