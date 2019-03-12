@extends('template.template')

@section('title')
@include('peran.title')
@endsection

@section('nav')
@include('peran.nav')
@endsection

@section('content')
<div class="row">
	<div class="col-md-12">
		<div class="box box-primary">
			<div class="box-header with-border">
				<h3 class="box-title">Tambah Peran</h3>
			</div>

			{!! Form::open(['route' => 'peran.store', 'role' => 'form']) !!}
				@include('peran.form')

				<div class="box-footer">
					<button type="submit" class="btn btn-success">Simpan</button>
					<a href="{{route('peran.index')}}" class="btn btn-info">Batal</a>
				</div>
			{!! Form::close() !!}
		</div>
	</div>
</div>
@endsection