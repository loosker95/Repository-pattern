@if (\Session::has('success'))
    <div id="successMsg" class="alert alert-success">
        {!! \Session::get('success') !!}
    </div>
@endif

<script>
    $(function() {
        setTimeout(() => {
            $('#successMsg').hide();
        }, 3000);
    });
</script>
