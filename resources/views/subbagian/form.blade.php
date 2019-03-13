<div class="box-body">

	@php
	$class = $errors->has('subbagian') ? 'form-group has-error' : 'form-group';
	$message = $errors->has('subbagian') ? '<span class="help-block">' . $errors->first('subbagian') . '</span>' : '';
	@endphp
	<div class="{{$class}}">
		<label for="subbagian">Sub Bagian</label>
		{!! Form::text('subbagian',null,['class'=> 'form-control','placeholder'=>'Isi Sub Bagian', 'id' => 'subbagian']) !!}
		{!! $message !!}
	</div>
	
</div>