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

	<div class="box-footer" style="text-align: center;">
      <button type="submit" class="btn btn-primary"><i class="glyphicon glyphicon-triangle-left"></i> Simpan</button>
      @if($subbagian->posisi < count($bagian->childs))
      <a href="{{route('read.read', [$modul->id, $bagian->posisi, $subbagian->posisi + 1])}}" class="btn btn-primary">{{$bagian->childs[$subbagian->posisi]->bagian}} <i class="glyphicon glyphicon-triangle-right"></i></a>
      @elseif($bagian->posisi < count($modul->bagians) && count($modul->bagians[$bagian->posisi]->childs) > 0)
      <a href="{{route('read.read', [$modul->id, $bagian->posisi + 1, 1])}}" class="btn btn-primary">{{$modul->bagians[$bagian->posisi]->childs[0]->bagian}} <i class="glyphicon glyphicon-triangle-right"></i></a>
      @endif
    </div>
</div>
@endsection