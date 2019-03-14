@extends('template.readtemplate')

@section('title')
{{$modul->modul}}
@endsection

@section('nav')
<li><i class="fa fa-home"></i> {{$modul->modul}}</li>
<li>{{$bagian->bagian}}</li>
<li>{{$subbagian->bagian}}</li>
@endsection

@section('content')
<div class="row">
	<div class="col-md-12">
		<div class="box box-primary">
			<p>Hello, World!</p>
		</div>
	</div>
</div>
@endsection