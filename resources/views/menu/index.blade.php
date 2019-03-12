@extends('template.template')

@section('title')
@include('menu.title')
@endsection

@section('nav')
@include('menu.nav')
@endsection

@section('content')
<div class="row">
    <div class="col-md-4">
        <div class="box box-primary">
            <div class="box-body">
                <ul class="list-group">
                @php
                $currentRoute = ADHhelper::getCurrentRoute();

                $menusTree1 = ADHhelper::sortMenu($menusTree);
                @endphp
                @foreach($menusTree1 as $lvl1)
                        <li class="list-group-item">{!!"<i class='{$lvl1->icon}'></i>"!!}
                            @if($lvl1->id == $request->id || in_array($lvl1->id, $bolds))
                            <b><u>
                            @endif
                                {{$lvl1->menu}} 
                                @if($lvl1->route != null)
                               ({{$lvl1->route}})
                                @else
                            @if($lvl1->id == $request->id || in_array($lvl1->id, $bolds))
                            </b></u>
                            @endif
                                <span class="badge">{{count($lvl1->childs)}}</span></li> 
                                @endif
                    @php
                    $menusTree2 = ADHhelper::sortMenu($lvl1->childs);
                    @endphp
                    @foreach($menusTree2 as $lvl2)
                        <li class="list-group-item">{!!"<i class='{$lvl1->icon}'></i><i class='{$lvl2->icon}'></i>"!!}
                            @if($lvl2->id == $request->id || in_array($lvl2->id, $bolds))
                            <b><u>
                            @endif
                                {{$lvl2->menu}} 
                                @if($lvl2->route != null)
                               ({{$lvl2->route}})
                                @else
                            @if($lvl2->id == $request->id || in_array($lvl2->id, $bolds))
                            </b></u>
                            @endif
                                <span class="badge">{{count($lvl2->childs)}}</span></li> 
                                @endif
                        @php
                        $menusTree3 = ADHhelper::sortMenu($lvl2->childs);
                        @endphp
                        @foreach($menusTree3 as $lvl3)
                            <li class="list-group-item">{!!"<i class='{$lvl1->icon}'></i><i class='{$lvl2->icon}'></i><i class='{$lvl3->icon}'></i>"!!}
                                @if($lvl3->id == $request->id || in_array($lvl3->id, $bolds))
                                <b><u>
                                @endif
                                    {{$lvl3->menu}} 
                                    @if($lvl3->route != null)
                                   ({{$lvl3->route}})
                                    @else
                                @if($lvl3->id == $request->id || in_array($lvl3->id, $bolds))
                                </b></u>
                                @endif
                                    <span class="badge">{{count($lvl3->childs)}}</span></li> 
                                    @endif
                            @php
                            $menusTree4 = ADHhelper::sortMenu($lvl3->childs);
                            @endphp
                            @foreach($menusTree4 as $lvl4)
                                <li class="list-group-item">{!!"<i class='{$lvl1->icon}'></i><i class='{$lvl2->icon}'></i><i class='{$lvl3->icon}'></i><i class='{$lvl4->icon}'></i>"!!}
                                    @if($lvl4->id == $request->id || in_array($lvl4->id, $bolds))
                                    <b><u>
                                    @endif
                                        {{$lvl4->menu}} 
                                        @if($lvl4->route != null)
                                       ({{$lvl4->route}})
                                        @else
                                    @if($lvl4->id == $request->id || in_array($lvl4->id, $bolds))
                                    </b></u>
                                    @endif
                                        <span class="badge"></span></li> 
                                        @endif
                            @endforeach
                        @endforeach
                    @endforeach
                @endforeach
                </ul>
            </div>
        </div>
    </div>

	<div class="col-md-8">
		<div class="box box-primary">
            <div class="box-header">
              <h3 class="box-title">Data Menu</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                @if($menu)
                <a class="btn btn-info btn-sm" href="{{route('menu.index', ['id' => $menu->parent_id ?: null])}}">
                  <i class="glyphicon glyphicon-arrow-left"></i> Parent
                </a>
                @endif
            	<a class="btn btn-success btn-sm" href="{{route('menu.create', ['id' => $request->id ?: null])}}">
                  <i class="glyphicon glyphicon-plus"></i> Tambah
                </a><br><br>
              <table class="table table-bordered table-hover thisPageDatatable" style="width: 100%">
                <thead>
	                <tr>
                      <th>Move</th>
                      <th>Menu</th>
                      <th>Icon</th>
	                  <th>Route</th>
	                  <th>Proses</th>
	                </tr>
                </thead>
                <tbody>
                	@foreach($menus as $item)
                	<tr>
                        <td style="text-align: center;">
                            @if($item->posisi != 1)
                            <a class="btn btn-info btn-sm" href="{{route('menu.up', $item->id)}}">
                              <i class="glyphicon glyphicon-arrow-up"></i>
                            </a>
                            @endif
                            @if($item->posisi != count($menus))
                            <a class="btn btn-info btn-sm" href="{{route('menu.down', $item->id)}}">
                              <i class="glyphicon glyphicon-arrow-down"></i>
                            </a>
                            @endif
                        </td>
                        <td>{{$item->menu}}</td>
                        <td>{{$item->icon}}</td>
                		<td>{{$item->route}}</td>
                		
                		<td>

			                {!! Form::open(['id' => 'formHapus' . $item->id, 'route' => ['menu.destroy', $item->id], 'method' => 'delete']) !!}

                                @if($canGoToChilds && $item->route == null)
                                <a class="btn btn-info btn-sm" href="{{route('menu.index', ['id' => $item->id])}}">
                                  <i class="glyphicon glyphicon-arrow-right"></i> Childs
                                </a>
                                @endif

                                <a class="btn btn-primary btn-sm" href="{{route('menu.edit', $item->id)}}">
				                  <i class="glyphicon glyphicon-pencil"></i> Edit
				                </a>

			              		<button type="button" class="btn btn-danger btn-sm" onclick="hapus('{{ $item->id }}')"><i class="glyphicon glyphicon-trash"></i> Hapus</button>
			              	{!! Form::close() !!}
                		</td>
                	</tr>
                	@endforeach
                </tbody>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
	</div>
</div>
@endsection

@section('js')
<script type="text/javascript">
function hapus(id) {
	swal({
	  title: "Yakin Hapus ???",
	  text: "Data yang sudah dihapus tidak dapat dikembalikan lagi !!!",
	  type: "warning",
	  showCancelButton: true,
	  confirmButtonColor: "#DD6B55",
	  confirmButtonText: "Hapus",
	}, function(){
	  $("#formHapus" + id).submit();
	});
}
$('.thisPageDatatable').DataTable({
    responsive: false,
    "scrollX": true,
    "ordering": false,
});
</script>
@endsection