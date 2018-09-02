@if(Session::has('flash_message'))
     
    <div class="alert alert-success"><em> {!! session('flash_message') !!}</em></div>

@endif