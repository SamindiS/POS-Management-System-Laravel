@if(session('success'))
<div class="industrial-alert industrial-alert-success">
    <i class="fas fa-check-circle mr-2"></i>{{ session('success') }}
    <button type="button" class="industrial-alert-close" data-dismiss="alert">
        <span>&times;</span>
    </button>
</div>
@endif

@if($errors->any()))
<div class="industrial-alert industrial-alert-danger">
    <i class="fas fa-exclamation-triangle mr-2"></i>
    <ul class="industrial-alert-list">
        @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
    <button type="button" class="industrial-alert-close" data-dismiss="alert">
        <span>&times;</span>
    </button>
</div>
@endif