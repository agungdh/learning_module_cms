@extends('template.template')

@section('title')
@include('bagian.title')
@endsection

@section('nav')
@include('bagian.nav')
@endsection

@section('content')
<div class="row">
	<div class="col-md-12">
		<div class="box box-primary">
            <div class="box-header">
              <h3 class="box-title">Data Bagian</h3>
              <p>Modul: {{$modul->modul}}</p>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
            	<a class="btn btn-success btn-sm" href="{{route('bagian.create', $modul->id)}}">
                  <i class="glyphicon glyphicon-plus"></i> Tambah
                </a><br><br>
              <table class="table table-bordered table-hover datatable" style="width: 100%">
                <thead>
	                <tr>
	                  <th>Bagian</th>
	                  <th>Proses</th>
	                </tr>
                </thead>
                <tbody>
                	@foreach($bagians as $item)
                	<tr>
                		<td>{{$item->bagian}}</td>
                		
                		<td>

			                {!! Form::open(['id' => 'formHapus' . $item->id, 'route' => ['bagian.destroy', $item->id], 'method' => 'delete']) !!}
                                <a class="btn btn-primary btn-sm" href="{{route('bagian.index', $item->id)}}">
                                  <i class="glyphicon glyphicon-pencil"></i> Bagian
                                </a>

	                			<a class="btn btn-primary btn-sm" href="{{route('bagian.edit', $item->id)}}">
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
</script>
@endsection