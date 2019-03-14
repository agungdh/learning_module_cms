<div class="box-body">

	@php
	$class = $errors->has('deskripsi') ? 'form-group has-error' : 'form-group';
	$message = $errors->has('deskripsi') ? '<span class="help-block">' . $errors->first('deskripsi') . '</span>' : '';
	@endphp
	<div class="{{$class}}">
		<label for="deskripsi">Deskripsi</label>
		{!! Form::text('deskripsi',null,['class'=> 'form-control','placeholder'=>'Isi Deskripsi', 'id' => 'deskripsi']) !!}
		{!! $message !!}
	</div>

	@php
	$class = $errors->has('gambar') ? 'form-group has-error' : 'form-group';
	$message = $errors->has('gambar') ? '<span class="help-block">' . $errors->first('gambar') . '</span>' : '';
	@endphp
	<div class="{{$class}}">
		<label for="gambar">Gambar</label>
		{!! Form::file('gambar', ['class'=> 'form-control', 'id' => 'gambar']) !!}
		{!! $message !!}
	</div>
	
</div>