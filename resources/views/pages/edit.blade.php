@extends('../layouts.app')
@section('content')
    <div class="headerPage text-center">
        <h1>Edit</h1>
        <h4>Edit post</h4>
        <span><a href="{{ route('index.post') }}">Go to Home page</a></span>
    </div>
    <hr>

    @include('partials.errorAlert')
    @include('partials.successAlert')

    <form action="{{ route('update.post', $post->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="Input1" class="form-label">Title</label>
            <input type="text" class="form-control" name="title" id="Input1" value="{{ $post->title }}">
        </div>
        <div class="mb-3 summary">
            <label for="summary" class="form-label">Summary</label>
            <textarea class="form-control" id="summary" name="summary" placeholder="summary" rows="3">{{ $post->summary }}</textarea>
        </div>
        <div class="mb-3 body">
            <label for="body" class="form-label">Body</label>
            <textarea class="form-control" id="body" name="body" placeholder="body" rows="10">{{ $post->body }}</textarea>
        </div>

        <div class="d-grid gap-2">
            <button class="btn btn-primary" name="submit" type="submit">Update post</button>
        </div>
    </form>
@endsection
