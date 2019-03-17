@extends('template.template')

@section('title')
@include('hakakses.title')
@endsection

@section('html-title')
@include('hakakses.title')
@endsection

@section('nav')
@include('hakakses.nav')
@endsection

@section('content')
<div class="row">
	<div class="col-md-12">
    <div class="box box-primary">
        <div class="box-header">
          <h3 class="box-title">Data User: {{"{$user->username} => {$user->nama}"}}</h3>
        </div>
        <!-- /.box-header -->

        <div class="box-body">
          <div class="form-group">
            <button class="btn btn-success" type="button" onclick="globalCheckAll()">Global Check All</button>
            <button class="btn btn-danger" type="button" onclick="globalUncheckAll()">Global Uncheck All</button> 
            <br><br>
            <select class="form-control select2" id="select_route">
            @foreach(ADHhelper::getGroupRouteList() as $grl)
              <option data-toggle="tab" role="menuitem" tabindex="-1" value="{{$grl}}" {{$grl == $data->last_active_route ? "Selected" : null}}>{{$grl}}</option>
            @endforeach
            </select>
          </div>
      
          {!! Form::model($data, ['url' => route('hakakses.update', $user->id), 'method' => 'put']) !!}

          {!! Form::hidden('last_active_route', null, ['id' => 'last_active_route']) !!}

          @foreach(ADHhelper::getGroupRouteList() as $grl)
          <div id="div__{{$grl}}">
            <button class="btn btn-success" type="button" onclick="checkAll('{{$grl}}')">Check All</button>
            <button class="btn btn-danger" type="button" onclick="uncheckAll('{{$grl}}')">Uncheck All</button>
              <table>
                <tbody>
                @foreach(ADHhelper::getChildOfGroupRoute($grl) as $cgr)
                  <tr>
                    <td>{!!Form::label(null, $cgr)!!}</td>
                    <td>{!!Form::checkbox('route_list[]', $cgr, null, ['class' => "__{$grl}"])!!}</td>
                  </tr>
                @endforeach
                </tbody>
              </table>
            </div>
          @endforeach
          <button class="btn btn-primary" type="submit">Submit</button>

          {!! Form::close() !!}
        </div>
      </div>
  </div>
</div>
@endsection

@section('js')
<script type="text/javascript">
  function checkAll(id) {
    $(".__"+id).prop("checked", true);
  }

  function uncheckAll(id) {
    $(".__"+id).prop("checked", false);
  }

  function globalCheckAll(id) {
    @foreach(ADHhelper::getGroupRouteList() as $grl)
      $(".__{{$grl}}").prop("checked", true);
    @endforeach
  }

  function globalUncheckAll(id) {
    @foreach(ADHhelper::getGroupRouteList() as $grl)
      $(".__{{$grl}}").prop("checked", false);
    @endforeach
  }

  $("#select_route").change(function() {
    showRoute($("#select_route").val());
  });

  function showRoute(route) {
    @foreach(ADHhelper::getGroupRouteList() as $grl)
      $("#div__{{$grl}}").hide();
    @endforeach
      $("#div__" + route).show();
      $("#last_active_route").val(route);
  }

  $(function () {
    if ($("#select_route").val() !== null) {
      showRoute($("#select_route").val());
    }
  });
</script>
@endsection