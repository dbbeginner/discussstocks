@if (\Session::has('success'))
    <div class="alert alert-success alert-dismissible alert-container" role="alert">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <strong>Success!</strong> {!! \Session::get('success') !!}
    </div>
@elseif (\Session::has('error'))
    <div class="alert alert-danger alert-dismissible alert-container" role="alert">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <strong>Error!</strong> {!! \Session::get('error') !!}
    </div>
@elseif (\Session::has('warning'))
    <div class="alert alert-danger alert-dismissible alert-container" role="alert">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <strong>Warning!</strong> {!! \Session::get('warning') !!}
    </div>
@elseif (\Session::has('info'))
    <div class="alert alert-info alert-dismissible alert-container" role="alert">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <strong>Just FYI...</strong> {!! \Session::get('info') !!}
    </div>
@elseif (\Session::has('status'))
    <div class="alert alert-info alert-dismissible alert-container" role="alert">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        {!! \Session::get('status') !!}
    </div>
@endif

