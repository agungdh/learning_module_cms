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
				<h3 class="box-title">Ubah Modul</h3>
			</div>

			{!! Form::model($modul, ['route' => ['modul.update', $modul->id], 'role' => 'form', 'method' => 'put']) !!}
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