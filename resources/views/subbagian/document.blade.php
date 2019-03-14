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
			<div class="box-header with-border">
				<h3 class="box-title">Document Sub Bagian</h3>
				<p>
	                Modul: {{$modul->modul}}
	                <br>
	                Bagian: {{$bagian->bagian}}
	                <br>
	                Sub Bagian: {{$subbagian->bagian}}
              	</p>
			</div>

			{!! Form::open(['route' => ['subbagian.saveDocument', $subbagian->id], 'role' => 'form', 'method' => 'put']) !!}

				<div class="box-body">

            	<textarea name="text">{!! $subbagian->text !!}</textarea>
					
				</div>

				<div class="box-footer">
					<button type="submit" class="btn btn-success">Simpan</button>
					<a href="{{route('subbagian.index', $bagian->id)}}" class="btn btn-info">Batal</a>
				</div>
			{!! Form::close() !!}
		</div>
	</div>
</div>
@endsection

@section('js')
<script src="{{asset('storage/assets')}}/tinymce_5.0.2/tinymce/js/tinymce/tinymce.min.js"></script>
<script>
tinymce.init({
	selector:'textarea',
	plugins: 'print preview searchreplace autolink directionality visualblocks visualchars fullscreen image link media template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists wordcount imagetools textpattern code help',
  	toolbar: 'formatselect | bold italic strikethrough forecolor backcolor formatpainter | link image media | alignleft aligncenter alignright alignjustify  | numlist bullist outdent indent | removeformat | addcomment code preview',
  	height: 400,
 	image_class_list: [
    	{title: 'Responsive', value: 'img-responsive'}
    ]
});
</script>
@endsection

@section('css')
<style type="text/css">
iframe, object, embed {
        max-width: 100%;
        max-height: 100%;
}
</style>
@endsection