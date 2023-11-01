@extends('../layouts.app')
<div class="menu" style="background-color: #1E2D7D; height:60px;">

</div>

@section('content')
    <div class="headerPage text-center">
        <h1>Blog</h1>
        <h4>View post</h4>
        <span><a href="{{ route('index.post') }}">Go to Home page</a></span>
    </div>

    <span><a href="{{ route('index.post') }}">Home</a></span>
    <hr>

    <div class="row">
        <div class="col-md-8 offset-2">

            @foreach ($data as $data)
                <h1 style="font-weight: 900; text-transform: uppercase; font-family: Montserrat, sans-serif; ">
                    {{ $data->title }}</h1>
                <hr>
                <h5 style="text-align:justify; color: grey">Summary : <cite>{{ strip_tags($data->summary) }}</cite></h5>
                <hr>

                <div class="text-center">
                    <a href="#" class="indexImg">
                        <img src="https://bootstrapmade.com/demo/templates/ZenBlog/assets/img/post-landscape-6.jpg"
                            alt="" class="img-fluid">
                    </a>
                </div>

                <br><br>
                <h5 style="text-align:justify;">{!! $data->body !!}</h5>
                <p>
                    <b>Author</b> : <cite>{{ $data->author }}</cite>
                </p>
                <p><a href="{{ route('change.post', $data->slug) }}">Edit</a></p>

                <br><br>

                <h4>
                    {{ $data['comments']->count() }}
                    {{-- {{ $data['comments']->count() != 1 ? 'Comments' : 'Comment' }} --}}
                    {{ Str::plural('Comment', $data['comments']->count()) }}
                </h4>
                <hr>
                @foreach ($data['comments'] as $comment)
                    <div style="background-color: #F6F8F7; padding:10px;">
                        <span class="" style="margin-bottom: 5px; display:block;">
                            Fabienlk
                        </span>
                        {!! $comment->content !!}
                        <span class="d-flex justify-content-end">
                            <cite> {{ $comment->created_at->diffForHumans() }}</cite>
                        </span>
                    </div>
                    <hr>
                @endforeach

                @include('partials.errorAlert')
                {{-- @include('partials.successAlert') --}}

                <form action="{{ route('add.comment', $data->id) }}" method="post">
                    @csrf
                    <div class="mb-3">
                        <label for="comment" class="form-label">Comment</label>
                        <textarea class="form-control" id="comment" name="content" placeholder="body" rows="3"></textarea>
                    </div>

                    <div class="d-grid gap-2">
                        <button class="btn btn-primary" name="submit" type="submit">Comment</button>
                    </div>
                </form>
                <br><br>
        </div>
    </div>
    @endforeach
@endsection
