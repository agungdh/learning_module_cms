@extends('template.template')

@section('title')
@include('modul.title')
@endsection

@section('nav')
@include('modul.nav')
@endsection

@section('content')
<div class="row">
	<div class="col-md-12">
		<div class="box box-primary">
			<div class="box-header with-border">
				<h3 class="box-title">Tambah Modul</h3>
			</div>

			{!! Form::open(['route' => 'modul.store', 'role' => 'form']) !!}
				@include('modul.form')

				<div class="box-footer">
					<button type="submit" class="btn btn-success">Simpan</button>
					<a href="{{route('modul.index')}}" class="btn btn-info">Batal</a>
				</div>
			{!! Form::close() !!}
		</div>
	</div>
</div>
@endsection