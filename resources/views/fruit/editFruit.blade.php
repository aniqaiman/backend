@extends('layout.master')
@section('style')
@endsection
@section('content')

<section class="content-header">
  <h1>
    FRUIT
    <small>Control Panel</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i>Home</a></li>
    <li class="active">Fruit</li>
  </ol>
</section>

<section class="content">
  <div class="col-md-12">
    <!-- Custom Tabs (Pulled to the right) -->
    <div class="nav-tabs-custom">

      <ul class="nav nav-tabs ">
        <li class="active"><a href="#tab_1" data-toggle="tab">Active</a></li> 
      </ul>

      <div class="tab-content">
        <div class="tab-pane active" id="tab_1">
          <div class="box">

            <!-- /.box-header -->
            <div class="modal-body">
              <!-- Custom Tabs (Pulled to the right) -->
              <form action="#" method="POST" id="frm-fruit-edit" enctype ="multipart/form-data">
                {!! csrf_field() !!}
                <div class="row">

                  <div class="form-group">
              <label for="fruit_name" class="col-sm-3 control-label">Fruit Name: </label>
              <div class="col-sm-9">
                <input type="text" class="form-control" name="fruit_name" id="fruit_name" value="{{$fruits->fruit_name}}">
              </div>
            </div>

            <div class="form-group">
              <label for="fruit_grade" class="col-sm-3 control-label">Fruit Grade: </label>
              <div class="col-sm-9">
                <input type="text" class="form-control" name="fruit_grade" id="fruit_grade" value="{{$fruits->fruit_grade}}">
              </div>
            </div>

            <div class="form-group">
              <label for="fruit_price" class="col-sm-3 control-label">Fruit Price(RM): </label>
              <div class="col-sm-9">
                <input type="text" class="form-control" name="fruit_price" id="fruit_price" value="{{$fruits->fruit_price}}">
              </div>
            </div>

            <div class="form-group">
              <label for="fruit_image" class="col-sm-3 control-label">Fruit Image: </label>
              <div class="col-sm-9">
                <input type="file" class="form-control" name="fruit_image" id="fruit_image" value="{{$fruits->fruit_image}}">
              </div>
            </div>

            <div class="form-group">
              <label for="fruit_quantity" class="col-sm-3 control-label">Fruit Quantity(KG): </label>
              <div class="col-sm-9">
                <input type="text" class="form-control" name="fruit_quantity" id="fruit_quantity" value="{{$fruits->fruit_quantity}}">
              </div>
            </div>

            <div class="form-group">
              <label for="fruit_harvest_duration" class="col-sm-3 control-label">Fruit Harvest Duration(month): </label>
              <div class="col-sm-9">
                <input type="text" class="form-control" name="fruit_harvest_duration" id="fruit_harvest_duration" value="{{$fruits->fruit_harvest_duration}}">
              </div>
            </div>

                </div>
                <input type="hidden" name="fruit_id" value="{{$fruits->fruit_id}}">
                <div class="box-footer">
                  <button type="submit" onclick="window.location='{{ url("/fruit") }}'" class="btn btn-primary">Save Change</button>
                </div>
              </form>
            </div>
          </div>
          <!-- /.box-body -->
        </div>
        <!-- /.tab-pane -->

      </div>
      <!-- /.tab-content -->
    </div>
    <!-- nav-tabs-custom -->
  </div>
  <!-- Main content -->
</section>
@endsection

@section('script')

<script>
  $('#frm-fruit-edit').on('submit',function(e){
    e.preventDefault();
    console.log('pressed');
    var data = $(this).serialize();
    console.log(data);
    var formData = new FormData($(this)[0]);

    $.ajax({
      url:"{{route('updateFruit')}}", 
      type: "POST",
      data: formData,
      async: false,
      success: function(response){
        console.log(response);
        $("[data-dismiss = modal]").trigger({type: "click"});

      },
      cache: false,
      contentType: false,
      processData: false
    });
  });

</script>
@endsection