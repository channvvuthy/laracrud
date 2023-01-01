@if (session('message'))
    <div class="alert alert-success">
        <h4><i class="icon fa fa-info"></i> Wow, good job...</h4>
        {{ session('message') }}
    </div>
@endif
