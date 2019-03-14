@extends('template.template')

@section('title')
@include('subbagian.title')
@endsection

@section('nav')
@include('subbagian.nav')
@endsection

@section('content')
<div class="row">
	<div class="col-md-12">
		<div class="box box-primary">
            <div class="box-header">
              <h3 class="box-title">Data Sub Bagian</h3>
              <p>
                Modul: {{$modul->modul}}
                <br>
                Bagian: {{$bagian->bagian}}
              </p>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
            	<a class="btn btn-success btn-sm" href="{{route('subbagian.create', $bagian->id)}}">
                  <i class="glyphicon glyphicon-plus"></i> Tambah
                </a><br><br>
              <table class="table table-bordered table-hover thisPageDatatable" style="width: 100%">
                <thead>
	                <tr>
	                  <th>Move</th>
                    <th>Sub Bagian</th>
	                  <th>Proses</th>
	                </tr>
                </thead>
                <tbody>
                	@foreach($subbagians as $item)
                	<tr>
                    <td style="text-align: center;">
                        @if($item->posisi != 1)
                        <a class="btn btn-info btn-sm" href="{{route('subbagian.up', $item->id)}}">
                          <i class="glyphicon glyphicon-arrow-up"></i>
                        </a>
                        @endif
                        @if($item->posisi != count($subbagians))
                        <a class="btn btn-info btn-sm" href="{{route('subbagian.down', $item->id)}}">
                          <i class="glyphicon glyphicon-arrow-down"></i>
                        </a>
                        @endif
                    </td>
                		<td>{{$item->bagian}}</td>
                		
                		<td>

			                {!! Form::open(['id' => 'formHapus' . $item->id, 'route' => ['subbagian.destroy', $item->id], 'method' => 'delete']) !!}

                        <a class="btn btn-primary btn-sm" href="{{route('subbagian.document', $item->id)}}">
                          <i class="fa fa-file-text"></i> Document
                        </a>

                        <a target="_blank" class="btn btn-primary btn-sm" href="{{route('read.read', [$modul->id, $bagian->posisi, $item->posisi])}}">
                          <i class="glyphicon glyphicon glyphicon-link"></i> Baca
                        </a>

	                			<a class="btn btn-primary btn-sm" href="{{route('subbagian.edit', $item->id)}}">
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