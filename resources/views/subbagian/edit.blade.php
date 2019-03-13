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
				<h3 class="box-title">Ubah Sub Bagian</h3>
			</div>

			{!! Form::model($subbagian, ['route' => ['subbagian.update', $subbagian->id], 'role' => 'form', 'method' => 'put']) !!}
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