@extends('../layouts.app')
@section('content')
    <div class="headerPage text-center">
        <h1>Show</h1>
        <h4>View post</h4>
        <span><a href="{{ route('index.post') }}">Go to Home page</a></span>
    </div>

    <span><a href="{{ route('index.post') }}">Home</a></span>
    <hr>

    @foreach ($data as $data)
        <h2>{{ $data->title }}</h2>
        <hr>
        <h5 style="color: grey">Summary : -> <cite>{{ strip_tags($data->summary) }}</cite></h5>
        <hr>
        <h5 style="text-align: justify">{{ strip_tags($data->body) }}</h5>
        <p>
            <b>Author</b> : <cite>{{ $data->author }}</cite>
        </p>
        <p><a href="{{ route('change.post', $data->id) }}">Edit</a></p>
        <div class="row">
            <div class="col-md-8">
                <br><br>
                <h4>
                    {{ $data['comments']->count() }}
                    {{-- {{ $data['comments']->count() != 1 ? 'Comments' : 'Comment' }} --}}
                    {{ Str::plural('Comment', $data['comments']->count()) }}
                </h4>
                <hr>
                @foreach ($data['comments'] as $comment)
                    <div style="background-color: #F6F8F7; padding:10px;">{!! $comment->content !!}
                        <br>
                        <span class="d-flex justify-content-end">
                            <cite> {{ $comment->created_at->diffForHumans() }}</cite>
                        </span>
                    </div>
                    <hr>
                @endforeach
            </div>
        </div>


        <div class="row">
            <div class="col-md-8">

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
