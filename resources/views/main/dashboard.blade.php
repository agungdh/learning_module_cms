@extends('template.template')

@section('title')
Dashboard
@endsection

@section('nav')
<li><a href="{{ route('main.index') }}"><i class="fa fa-home"></i> Dashboard</a></li>
@endsection

@section('content')
<div class="row">
	<div class="col-md-12">
		<div class="box box-primary">
            <div class="box-header">
              
            </div>
            <!-- /.box-header -->
            <div class="box-body">
            	<textarea>Hello, World!</textarea>
            </div>
            <!-- /.box-body -->
          </div>
	</div>
</div>
@endsection

@section('js')
<script src="{{asset('storage/assets')}}/tinymce/tinymce/js/tinymce/tinymce.min.js"></script>
<script>
tinymce.init({
	selector:'textarea',
	plugins: 'print preview fullpage searchreplace autolink directionality visualblocks visualchars fullscreen image link media template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists wordcount imagetools textpattern help',
  	toolbar: 'formatselect | bold italic strikethrough forecolor backcolor formatpainter | link image media | alignleft aligncenter alignright alignjustify  | numlist bullist outdent indent | removeformat | addcomment',
});
</script>
@endsection