@extends('template.template')

@section('title')
@include('peran.title')
@endsection

@section('html-title')
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
				<h3 class="box-title">Ubah Peran</h3>
			</div>

			{!! Form::model($peran, ['route' => ['peran.update', $peran->id], 'role' => 'form', 'method' => 'put']) !!}
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