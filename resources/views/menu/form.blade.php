<div class="box-body">

	{!! Form::hidden('id', $request->id) !!}

	@php
	$class = $errors->has('menu') ? 'form-group has-error' : 'form-group';
	$message = $errors->has('menu') ? '<span class="help-block">' . $errors->first('menu') . '</span>' : '';
	@endphp
	<div class="{{$class}}">
		<label for="menu">Menu</label>
		{!! Form::text('menu',null,['class'=> 'form-control','placeholder'=>'Isi Menu', 'id' => 'menu']) !!}
		{!! $message !!}
	</div>

	@php
	$class = $errors->has('icon') ? 'form-group has-error' : 'form-group';
	$message = $errors->has('icon') ? '<span class="help-block">' . $errors->first('icon') . '</span>' : '';
	@endphp
	<div class="{{$class}}">
		<label for="icon">Icon</label>
		{!! Form::text('icon',null,['class'=> 'form-control','placeholder'=>'Isi Icon', 'id' => 'icon']) !!}
		{!! $message !!}
	</div>
	
	@php
	$class = $errors->has('route') ? 'form-group has-error' : 'form-group';
	$message = $errors->has('route') ? '<span class="help-block">' . $errors->first('route') . '</span>' : '';
	@endphp
	<div class="{{$class}}">
		<label for="route">Route</label>
		{!! Form::text('route',null,['class'=> 'form-control','placeholder'=>'Isi Route', 'id' => 'route']) !!}
		{!! $message !!}
	</div>
	
</div>