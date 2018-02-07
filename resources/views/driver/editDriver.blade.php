@extends('layout.master')
@section('style')
@endsection
@section('content')

<section class="content-header">
  <h1>
    DRIVER
    <small>Control Panel</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Driver</li>
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
              <form action="#" method="POST" id="frm-driver-edit" enctype ="multipart/form-data">
                {!! csrf_field() !!}
                <div class="row">

                  <div class="form-group">
              <label for="name" class="col-sm-3 control-label">Driver's Name: </label>
              <div class="col-sm-9">
                <input type="text" class="form-control" name="name" id="name" value="{{$drivers->name}}">
              </div>
            </div>

            <div class="form-group">
              <label for="ic_number" class="col-sm-3 control-label">IC Number: </label>
              <div class="col-sm-9">
                <input type="text" class="form-control" name="ic_number" id="ic_number" value="{{$drivers->ic_number}}">
              </div>
            </div>

            <div class="form-group">
              <label for="home_address" class="col-sm-3 control-label">Home Address: </label>
              <div class="col-sm-9">
              <textarea class="form-control" name="home_address" id="home_address" multiple="true">{{$drivers->home_address}}</textarea>
              </div>
            </div>

            <div class="form-group">
              <label for="phone_number" class="col-sm-3 control-label">Phone Number: </label>
              <div class="col-sm-9">
                <input type="text" class="form-control" name="phone_number" id="phone_number" value="{{$drivers->phone_number}}">
              </div>
            </div>

            <div class="form-group">
              <label for="license_number" class="col-sm-3 control-label">License Number: </label>
              <div class="col-sm-9">
              <input type="text" class="form-control" name="license_number" id="license_number" value="{{$drivers->license_number}}">
              </div>
            </div>

            <div class="form-group">
              <label for="drivers_license" class="col-sm-3 control-label">Driver License: </label>
              <div class="col-sm-9">
                <input type="file" class="form-control" name="drivers_license" id="drivers_license" value="{{$drivers->drivers_license}}">
              </div>
            </div>

            <div class="form-group">
              <label for="roadtax_expiry" class="col-sm-3 control-label">Roadtax Expiry: </label>
              <div class="col-sm-9">
                <input type="date" class="form-control" name="roadtax_expiry" id="roadtax_expiry" value="{{$drivers->roadtax_expiry}}">
              </div>
            </div>

            <div class="form-group">
              <label for="type_of_lorry" class="col-sm-3 control-label">Type of Lorry: </label>
              <div class="col-sm-9">
                <input type="text" class="form-control" name="type_of_lorry" id="type_of_lorry" value="{{$drivers->type_of_lorry}}">
              </div>
            </div>

            <div class="form-group">
              <label for="lorry_capacity" class="col-sm-3 control-label">Lorry Capacity: </label>
              <div class="col-sm-9">
                <input type="text" class="form-control" name="lorry_capacity" id="lorry_capacity" value="{{$drivers->lorry_capacity}}">
              </div>
            </div>

            <div class="form-group">
              <label for="location_to_cover" class="col-sm-3 control-label">Location Covered: </label>
              <div class="col-sm-9">
                <input type="text" class="form-control" name="location_to_cover" id="location_to_cover" value="{{$drivers->location_to_cover}}">
              </div>
            </div>

            <div class="form-group">
              <label for="lorry_plate_number" class="col-sm-3 control-label">Lorry Plate No.: </label>
              <div class="col-sm-9">
                <input type="text" class="form-control" name="lorry_plate_number" id="lorry_plate_number" value="{{$drivers->lorry_plate_number}}">
              </div>
            </div>

            <div class="form-group">
              <label for="bank_name" class="col-sm-3 control-label">Bank Name: </label>
              <div class="col-sm-9">
                <input type="text" class="form-control" name="bank_name" id="bank_name" value="{{$drivers->bank_name}}">
              </div>
            </div>

            <div class="form-group">
              <label for="bank_acc_holder_name" class="col-sm-3 control-label">Acc Holder Name: </label>
              <div class="col-sm-9">
                <input type="text" class="form-control" name="bank_acc_holder_name" id="bank_acc_holder_name" value="{{$drivers->bank_acc_holder_name}}">
              </div>
            </div>

            <div class="form-group">
              <label for="bank_acc_number" class="col-sm-3 control-label">Bank Acc Number: </label>
              <div class="col-sm-9">
                <input type="text" class="form-control" name="bank_acc_number" id="bank_acc_number" value="{{$drivers->bank_acc_number}}">
              </div>
            </div>

                </div>
                <input type="hidden" name="driver_id" value="{{$drivers->driver_id}}">
                <div class="box-footer">
                  <button type="submit" onclick="window.location='{{ url("/driver") }}'" class="btn btn-primary">Save Change</button>
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
<script src="https://cdn.ckeditor.com/4.7.3/standard/ckeditor.js"></script>

<script>
  $(document).ready(function()
  {
    CKEDITOR.replace('home_address');
    $('#frm-driver-edit').on('submit',function(e)
    {
      e.preventDefault();
      console.log('pressed');
      var data = $(this).serialize();
      console.log(data);
      var formData = new FormData($(this)[0]);
      formData.append('home_address', CKEDITOR.instances.home_address.getData());

      $.ajax(
      {
        url:"{{route('updateDriver')}}", 
        type: "POST",
        data: formData,
        async: false,
        success: function(response)
        {
          console.log(response);
          $("[data-dismiss = modal]").trigger({type: "click"});
        },
        cache: false,
        contentType: false,
        processData: false
      });
    });
  });

</script>
@endsection