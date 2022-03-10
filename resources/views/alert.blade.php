@if($errors->has('message_error'))
    <div class="alert alert-danger" role="alert">{!! $errors->first('message_error') !!}</div>
@endif
@if(session('message_success'))
    <div class="alert alert-success" role="alert">{{ session('message_success') }}</div>
@endif