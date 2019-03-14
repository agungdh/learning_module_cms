@extends('template.template')

@section('title')
@include('gambar.title')
@endsection

@section('nav')
@include('gambar.nav')
@endsection

@section('content')
<div class="row">
	<div class="col-md-12">
		<div class="box box-primary">
            <div class="box-header">
              <h3 class="box-title">Data Gambar</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
            	<a class="btn btn-success btn-sm" href="{{route('gambar.create')}}">
                  <i class="glyphicon glyphicon-plus"></i> Tambah
                </a><br><br>
              <table class="table table-bordered table-hover datatable" style="width: 100%">
                <thead>
	                <tr>
	                  <th>Deskripsi</th>
	                  <th>Proses</th>
	                </tr>
                </thead>
                <tbody>
                	@foreach($gambars as $item)
                	<tr>
                		<td>{{$item->deskripsi}}</td>
                		
                		<td>

			                {!! Form::open(['id' => 'formHapus' . $item->id, 'route' => ['gambar.destroy', $item->id], 'method' => 'delete']) !!}

                                <a class="btn btn-primary btn-sm" href="{{route('gambar.edit', $item->id)}}">
                                  <i class="glyphicon glyphicon-pencil"></i> Edit
                                </a>

                                <button type="button" class="btn btn-primary btn-sm" onclick="lihatGambar('{{$item->id}}', '{{$item->deskripsi}}')">
                                  <i class="glyphicon glyphicon-eye-open"></i> Lihat Gambar
                                </button>

	                			<button type="button" class="btn btn-primary btn-sm" onclick="salinAlamat('{{$item->id}}')">
				                  <i class="glyphicon glyphicon-copy"></i> Salin Alamat
				                </button>

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

<div class="modal fade" id="imagemodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">              
      <div class="modal-body">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <strong><p id="deskripsi" style="text-align: center;"></p></strong>
        <img src="" class="imagepreview" style="width: 100%;" >
      </div>
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
function lihatGambar(id, deskripsi) {
    $("#deskripsi").text(deskripsi);
    $('.imagepreview').attr('src', "{{asset('storage/files/gambar')}}/" + id);
    $('#imagemodal').modal('show'); 
}
function salinAlamat(str) {
    // Create new element
    var el = document.createElement('textarea');
    // Set value (string to be copied)
    el.value = "{{asset('storage/files/gambar')}}/" + str;
    // Set non-editable to avoid focus and move outside of view
    el.setAttribute('readonly', '');
    el.style = {position: 'absolute', left: '-9999px'};
    document.body.appendChild(el);
    // Select text inside element
    el.select();
    // Copy text to clipboard
    document.execCommand('copy');
    // Remove temporary element
    document.body.removeChild(el);

    swal('Berhasil !!!', 'Alamat telah di salin', 'success');
}
</script>
@endsection