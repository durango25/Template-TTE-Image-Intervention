@if ($message = Session::get('success'))
	<div class="alert alert-success" id="alert">
		<button type="button" class="close" data-dismiss="alert">&times;</button>
		<i class="fas fa-check-circle"></i>&nbsp; {{ $message }}
	</div>
@endif
@if ($message = Session::get('failed'))
	<div class="alert alert-danger" id="alert">
		<button type="button" class="close" data-dismiss="alert">&times;</button>
		<i class="fas fa-times-circle"></i>&nbsp; {{ $message }} 
	</div>
@endif
@if ($message = Session::get('warning'))
	<div class="alert alert-warning" id="alert">
		<button type="button" class="close" data-dismiss="alert">&times;</button>
		<i class="fas fa-info-circle"></i>&nbsp; {{ $message }} 
	</div>
@endif

@if ($errors->any())
    <div class="callout callout-danger text-danger" id="alert">
		<button type="button" class="close" data-dismiss="alert">&times;</button>
        <i class="fas fa-info-circle"></i>&nbsp; <b> Terdapat beberapa isian form yang tidak valid : </b>
        <ul>
            @foreach ($errors->all() as $error)
                <li> {{ $error }} </li>
            @endforeach
        </ul>
    </div>
@endif