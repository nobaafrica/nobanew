@if (session()->has('success'))
<div class="alert alert-success alert-dismissable" role="alert">
    {{session('success')}}
    <button type="button" class="btn-close btn-success text-success" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@elseif(session()->has('error'))
<div class="alert alert-danger alert-dismissable" role="alert">
    {{session('error')}}
    <button type="button" class="btn-close btn-danger text-danger" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif