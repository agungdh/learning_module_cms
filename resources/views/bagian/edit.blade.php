@extends('template.template')

@section('title')
@include('bagian.title')
@endsection

@section('html-title')
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
				<h3 class="box-title">Ubah Bagian</h3>
				<p>Modul: {{$modul->modul}}</p>
			</div>

			{!! Form::model($bagian, ['route' => ['bagian.update', $bagian->id], 'role' => 'form', 'method' => 'put']) !!}
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