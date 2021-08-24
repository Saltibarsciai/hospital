@if ($message = Session::get('success'))
    <div class="alert alert-success alert-block w-100 position-fixed" style="z-index: 1">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <strong>{{ $message }}</strong>
    </div>
@endif

@if ($message = Session::get('error'))
    <div class="alert alert-danger alert-block w-100 position-fixed" style="z-index: 1">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <strong>{{ $message }}</strong>
    </div>
@endif

<div class="alert alert-success alert-block w-100 position-fixed d-none" id="js-flash" style="z-index: 1">
    <button type="button" class="close" data-dismiss="alert" id="js-flash-close">×</button>
    <strong id="js-flash-message"></strong>
</div>
