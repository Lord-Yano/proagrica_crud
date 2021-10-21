<!-- Check the presence of an alert and display it out-->

@if(session('success'))
<div class="alert alert-success" role="alert">
    {{session('success')}}
</div>
@endif


@if(session('error'))
<div class="alert alert-danger" role="alert">
    {{session('error')}}
</div>
@endif