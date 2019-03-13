@extends('template.template')

@section('title')
@include('subbagian.title')
@endsection

@section('nav')
@include('subbagian.nav')
@endsection

@section('content')
<div class="row">
	<div class="col-md-12">
		<div class="box box-primary">
			<div class="box-header with-border">
				<h3 class="box-title">Tambah Sub Bagian</h3>
			</div>

			{!! Form::open(['route' => ['subbagian.store', $bagian->id], 'role' => 'form']) !!}
				@include('subbagian.form')

				<div class="box-footer">
					<button type="submit" class="btn btn-success">Simpan</button>
					<a href="{{route('subbagian.index', $bagian->id)}}" class="btn btn-info">Batal</a>
				</div>
			{!! Form::close() !!}
		</div>
	</div>
</div>
@endsection