@extends('template.template')

@section('title')
Profil
@endsection

@section('nav')
<li><a href="{{ route('main.profil') }}"><i class="fa fa-home"></i> Profil</a></li>
@endsection

@section('content')
<div class="row">
	<div class="col-md-12">
		<div class="box box-primary">
			<div class="box-header with-border">
				<h3 class="box-title">Ubah Profil</h3>
			</div>

			{!! Form::model($profil, ['route' => ['main.saveProfil'], 'role' => 'form', 'method' => 'put']) !!}
				<div class="box-body">

					@php
					$class = $errors->has('username') ? 'form-group has-error' : 'form-group';
					$message = $errors->has('username') ? '<span class="help-block">' . $errors->first('username') . '</span>' : '';
					@endphp
					<div class="{{$class}}">
						<label for="username">Username</label>
						{!! Form::text('username',null,['class'=> 'form-control','placeholder'=>'Isi Username', 'id' => 'username', 'readonly' => true]) !!}
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
						<label for="password_confirmation">Konfirmasi Password</label>
						{!! Form::password('password_confirmation',['class'=> 'form-control','placeholder'=>'Isi Konfirmasi Password', 'id' => 'password_confirmation']) !!}
						{!! $message !!}
					</div>
					
				</div>

				<div class="box-footer">
					<button type="submit" class="btn btn-success">Simpan</button>
					<a href="{{route('main.profil')}}" class="btn btn-info">Batal</a>
				</div>
			{!! Form::close() !!}
		</div>
	</div>
</div>
@endsection