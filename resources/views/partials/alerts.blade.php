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

<!--Laravel passes messages back as a status
    If a status is set, its a success-->

@if(session('status'))

<div class="alert alert-success" role="alert">
    {{session('status')}}
</div>

@endif