@extends('template.template')

@section('title')
@include('bagian.title')
@endsection

@section('nav')
@include('bagian.nav')
@endsection

@section('content')
<div class="row">
	<div class="col-md-12">
		<div class="box box-primary">
			<div class="box-header with-border">
				<h3 class="box-title">Tambah Bagian</h3>
			</div>

			{!! Form::open(['route' => ['bagian.store', $modul->id], 'role' => 'form']) !!}
				@include('bagian.form')

				<div class="box-footer">
					<button type="submit" class="btn btn-success">Simpan</button>
					<a href="{{route('bagian.index', $modul->id)}}" class="btn btn-info">Batal</a>
				</div>
			{!! Form::close() !!}
		</div>
	</div>
</div>
@endsection