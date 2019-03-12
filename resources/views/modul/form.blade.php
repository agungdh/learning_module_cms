<div class="box-body">

	@php
	$class = $errors->has('modul') ? 'form-group has-error' : 'form-group';
	$message = $errors->has('modul') ? '<span class="help-block">' . $errors->first('modul') . '</span>' : '';
	@endphp
	<div class="{{$class}}">
		<label for="modul">Modul</label>
		{!! Form::text('modul',null,['class'=> 'form-control','placeholder'=>'Isi Modul', 'id' => 'modul']) !!}
		{!! $message !!}
	</div>
	
</div>