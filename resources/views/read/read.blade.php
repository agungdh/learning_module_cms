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
        <div class="box-header with-border">
    			<h3 class="box-title">{{$subbagian->bagian}}</h3>
    		</div>
        <!-- /.box-header -->

        <div class="box-body">
          {!! $subbagian->text !!}
        </div>
        <!-- /.box-body -->

        <div class="box-footer" style="text-align: center;">
	      @if($subbagian->posisi > 1)
	      <a href="{{route('read.read', [$modul->id, $bagian->posisi, $subbagian->posisi - 1])}}" class="btn btn-primary"><i class="glyphicon glyphicon-triangle-left"></i> {{$bagian->childs[$subbagian->posisi - 2]->bagian}}</a>
	      @elseif($bagian->posisi > 1 && count($modul->bagians[$bagian->posisi - 2]->childs) > 0)
	      <a href="{{route('read.read', [$modul->id, $bagian->posisi - 1, count($modul->bagians[$bagian->posisi - 2]->childs)])}}" class="btn btn-primary"><i class="glyphicon glyphicon-triangle-left"></i> {{$modul->bagians[$bagian->posisi - 2]->childs[count($modul->bagians[$bagian->posisi - 2]->childs) - 1]->bagian}}</a>
	      @elseif($bagian->posisi == 1 && $subbagian->posisi == 1)
	      <a href="{{route('read.index', $modul->id)}}" class="btn btn-primary"><i class="glyphicon glyphicon-triangle-left"></i> Table Of Content</a>
	      @endif

	      @if($subbagian->posisi < count($bagian->childs))
	      <a href="{{route('read.read', [$modul->id, $bagian->posisi, $subbagian->posisi + 1])}}" class="btn btn-primary">{{$bagian->childs[$subbagian->posisi]->bagian}} <i class="glyphicon glyphicon-triangle-right"></i></a>
	      @elseif($bagian->posisi < count($modul->bagians) && count($modul->bagians[$bagian->posisi]->childs) > 0)
	      <a href="{{route('read.read', [$modul->id, $bagian->posisi + 1, 1])}}" class="btn btn-primary">{{$modul->bagians[$bagian->posisi]->childs[0]->bagian}} <i class="glyphicon glyphicon-triangle-right"></i></a>
	      @endif
	    </div>
      </div>
      <!-- /.box -->
    </div>
    <!-- ./col -->
</div>
@endsection

@section('css')
<style type="text/css">
iframe, object, embed {
        max-width: 100%;
        max-height: 100%;
}
</style>
@endsection