<div class="box-body">

	@php
	$class = $errors->has('bagian') ? 'form-group has-error' : 'form-group';
	$message = $errors->has('bagian') ? '<span class="help-block">' . $errors->first('bagian') . '</span>' : '';
	@endphp
	<div class="{{$class}}">
		<label for="bagian">Bagian</label>
		{!! Form::text('bagian',null,['class'=> 'form-control','placeholder'=>'Isi Bagian', 'id' => 'bagian']) !!}
		{!! $message !!}
	</div>
	
</div>