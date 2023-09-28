@if ($errors->any())
    <div class="alert alert-danger">
        @foreach ($errors->all() as $error)
            <span>
                <li>
                    {{ $error }}
                </li>
            </span>
        @endforeach
    </div>
@endif
