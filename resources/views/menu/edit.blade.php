@extends('template.template')

@section('title')
@include('menu.title')
@endsection

@section('nav')
@include('menu.nav')
@endsection

@section('content')
<div class="row">
	<div class="col-md-12">
		<div class="box box-primary">
			<div class="box-header with-border">
				<h3 class="box-title">Ubah Menu</h3>
			</div>

			{!! Form::model($menu, ['route' => ['menu.update', $menu->id], 'role' => 'form', 'method' => 'put']) !!}
				@include('menu.form')

				<div class="box-footer">
					<button type="submit" class="btn btn-success">Simpan</button>
					<a href="{{route('menu.index', ['id' => $menu->parent_id ?: null])}}" class="btn btn-info">Batal</a>
				</div>
			{!! Form::close() !!}
		</div>
	</div>
</div>
@endsection