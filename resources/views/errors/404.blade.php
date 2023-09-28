@extends('../layouts.app')
@section('content')
    <div class="error text-center">
        <h1>Error 404</h1>
        <h4>Page not found</h4>
        <span><a href="{{ route('index.post') }}">Go to Home page</a></span>
    </div>
@endsection
