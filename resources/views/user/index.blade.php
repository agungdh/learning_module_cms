@extends('template.template')

@section('title')
@include('user.title')
@endsection

@section('nav')
@include('user.nav')
@endsection

@section('content')
<div class="row">
	<div class="col-md-12">
		<div class="box box-primary">
            <div class="box-header">
              <h3 class="box-title">Data User</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
            	<a class="btn btn-success btn-sm" href="{{route('user.create')}}">
                  <i class="glyphicon glyphicon-plus"></i> Tambah
                </a><br><br>
              <table class="table table-bordered table-hover datatable" style="width: 100%">
                <thead>
	                <tr>
	                  <th>Username</th>
                    <th>Nama</th>
                    <th>Peran</th>
	                  <th>Proses</th>
	                </tr>
                </thead>
                <tbody>
                	@foreach($users as $item)
                	<tr>
                		<td>{{$item->username}}</td>
                    <td>{{$item->nama}}</td>
                    <td>{{$item->peran->peran}}</td>
                		
                		<td>

			                {!! Form::open(['id' => 'formHapus' . $item->id, 'route' => ['user.destroy', $item->id], 'method' => 'delete']) !!}
    {{--                     <a class="btn btn-primary btn-sm" href="{{route('user.index', $item->id)}}">
                          <i class="glyphicon glyphicon-pencil"></i> Hak Akses
                        </a>
 --}}
                        <a class="btn btn-primary btn-sm" onclick="sync('{{route('user.sync', $item->id)}}')">
                          <i class="glyphicon glyphicon-refresh"></i> Sync
                        </a>

	                			<a class="btn btn-primary btn-sm" href="{{route('user.edit', $item->id)}}">
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

function sync(urlString) {
  swal({
    title: "Yakin Sync ???",
    text: "Data yang sudah disinkron tidak dapat dikembalikan lagi !!!",
    type: "warning",
    showCancelButton: true,
    confirmButtonColor: "#70BA17",
    confirmButtonText: "Sync",
  }, function(){
    window.location = urlString;
  });
}
</script>
@endsection