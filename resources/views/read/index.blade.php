@extends('template.readtemplate')

@section('title')
{{$modul->modul}}
@endsection

@section('nav')
<li><a href="{{ route('read.index', $modul->id) }}"><i class="fa fa-home"></i> {{$modul->modul}}</a></li>
@endsection

@section('content')
<div class="row">
	<div class="col-md-12">
	   <div class="box box-primary">
        <div class="box-header with-border">
			<h3 class="box-title">Table Of Content</h3>
		</div>
        <!-- /.box-header -->
        <div class="box-body">
          <ol>
          	@foreach($modul->bagians as $menuBagian)
            <li>{{$menuBagian->bagian}}
              <ol>
          		@foreach($menuBagian->childs as $menuSubBagian)
            	<li><a href="{{route('read.read', [$modul->id, $menuBagian->posisi, $menuSubBagian->posisi])}}">{{$menuSubBagian->bagian}}</li></a>
          		@endforeach
              </ol>
            </li>
          	@endforeach
          </ol>
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->
    </div>
    <!-- ./col -->
</div>
@endsection