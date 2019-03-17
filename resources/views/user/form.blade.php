<div class="box-body">

	@php
	$class = $errors->has('username') ? 'form-group has-error' : 'form-group';
	$message = $errors->has('username') ? '<span class="help-block">' . $errors->first('username') . '</span>' : '';
	@endphp
	<div class="{{$class}}">
		<label for="username">Username</label>
		{!! Form::text('username',null,['class'=> 'form-control', 'readonly' => $state == 'edit' ? true : false,'placeholder'=>'Isi Username', 'id' => 'username']) !!}
		{!! $message !!}
	</div>
	
	@php
	$class = $errors->has('nama') ? 'form-group has-error' : 'form-group';
	$message = $errors->has('nama') ? '<span class="help-block">' . $errors->first('nama') . '</span>' : '';
	@endphp
	<div class="{{$class}}">
		<label for="nama">Nama</label>
		{!! Form::text('nama',null,['class'=> 'form-control','placeholder'=>'Isi Nama', 'id' => 'nama']) !!}
		{!! $message !!}
	</div>

	@php
	$class = $errors->has('id_peran') ? 'form-group has-error' : 'form-group';
	$message = $errors->has('id_peran') ? '<span class="help-block">' . $errors->first('id_peran') . '</span>' : '';
	@endphp
	<div class="{{$class}}">
		<label for="id_peran">Peran</label>
		{!! Form::select('id_peran',$perans,null,['class'=> 'form-control select2','placeholder'=>'Pilih Peran','id'=>'id_peran']) !!}
		{!! $message !!}
	</div>

	@php
	$class = $errors->has('password') ? 'form-group has-error' : 'form-group';
	$message = $errors->has('password') ? '<span class="help-block">' . $errors->first('password') . '</span>' : '';
	@endphp
	<div class="{{$class}}">
		<label for="password">Password</label>
		{!! Form::password('password',['class'=> 'form-control','placeholder'=>'Isi Password', 'id' => 'password']) !!}
		{!! $message !!}
	</div>
	
	@php
	$class = $errors->has('password') ? 'form-group has-error' : 'form-group';
	$message = $errors->has('password') ? '<span class="help-block">' . $errors->first('password') . '</span>' : '';
	@endphp
	<div class="{{$class}}">
		<label for="password_confirmation">Password</label>
		{!! Form::password('password_confirmation',['class'=> 'form-control','placeholder'=>'Isi Password', 'id' => 'password_confirmation']) !!}
		{!! $message !!}
	</div>
	
</div>