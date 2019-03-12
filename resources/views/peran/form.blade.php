<div class="box-body">

	@php
	$class = $errors->has('peran') ? 'form-group has-error' : 'form-group';
	$message = $errors->has('peran') ? '<span class="help-block">' . $errors->first('peran') . '</span>' : '';
	@endphp
	<div class="{{$class}}">
		<label for="peran">Peran</label>
		{!! Form::text('peran',null,['class'=> 'form-control','placeholder'=>'Isi Peran', 'id' => 'peran']) !!}
		{!! $message !!}
	</div>
	
</div>