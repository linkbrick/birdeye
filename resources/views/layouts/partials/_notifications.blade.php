@if(session()->has('success'))
    <div class="alert alert-primary">
        {{ session()->get('success') }}
    </div>
@endif