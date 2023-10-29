@extends('../layouts.app')
@section('content')
    <div class="headerPage text-center">
        <h1>Create</h1>
        <h4>Write a post</h4>
        <span><a href="{{ route('index.post') }}">See all posts</a></span>
    </div>
    <hr>
    <div class="col-md-12">
        <div class="row">
            @include('partials.errorAlert')
            @include('partials.successAlert')

            <form action="{{ route('store.post') }}" method="post">
                @csrf
                <div class="mb-3">
                    <label for="Input1" class="form-label">Title</label>
                    <input type="text" class="form-control" name="title" id="Input1" placeholder="title">
                </div>
                <div class="mb-3 summary">
                    <label for="summary" class="form-label">Summary</label>
                    <textarea class="form-control" id="summary" name="summary" placeholder="summary" height="300" rows="3"></textarea>
                </div>
                <div class="mb-3 body">
                    <label for="body" class="form-label">Body</label>
                    <textarea class="form-control" id="body" name="body" placeholder="body" rows="10"></textarea>
                </div>

                <div class="d-grid gap-2">
                    <button class="btn btn-primary" name="submit" type="submit">Post</button>
                </div>
            </form>
        </div>
    </div>
@endsection
<style>
    .summary .ck-placeholder{
        height: 70px;
    }
    .body .ck-placeholder{
        height: 130px;
    }
</style>

