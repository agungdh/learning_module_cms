@extends('template.template')

@section('title')
@include('gambar.title')
@endsection

@section('nav')
@include('gambar.nav')
@endsection

@section('content')
<div class="row">
	<div class="col-md-12">
		<div class="box box-primary">
			<div class="box-header with-border">
				<h3 class="box-title">Tambah Gambar</h3>
			</div>

			{!! Form::open(['route' => 'gambar.store', 'role' => 'form', 'files' => 'true']) !!}
				@include('gambar.form')

				<div class="box-footer">
					<button type="submit" class="btn btn-success">Simpan</button>
					<a href="{{route('gambar.index')}}" class="btn btn-info">Batal</a>
				</div>
			{!! Form::close() !!}
		</div>
	</div>
</div>
@endsection