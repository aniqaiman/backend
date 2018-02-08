@extends('layout.master')
@section('style')
@endsection
@section('content')

<section class="content-header">
  <h1>
    VEGETABLE
    <small>Control Panel</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i>Home</a></li>
    <li class="active">Vegetable</li>
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
              <form action="#" method="POST" id="frm-vegetable-edit" enctype ="multipart/form-data">
                {!! csrf_field() !!}
                <div class="row">

            <div class="form-group">
              <label for="vegetable_image" class="col-sm-3 control-label">Vegetable Image: </label>
              <div class="col-sm-9">
                <input type="file" class="form-control" name="vegetable_image" id="vegetable_image" value="{{$vegetables->vegetable_image}}">
              </div>
            </div>

            <div class="form-group">
              <label for="vegetable_price" class="col-sm-3 control-label">Vegetable Price(RM/Unit): </label>
              <div class="col-sm-9">
                <input type="text" class="form-control" name="vegetable_price" id="vegetable_price" value="{{$vegetables->vegetable_price}}">
              </div>
            </div>

            <div class="form-group">
              <label for="vegetable_name" class="col-sm-3 control-label">Vegetable Name: </label>
              <div class="col-sm-9">
                <input type="text" class="form-control" name="vegetable_name" id="vegetable_name" value="{{$vegetables->vegetable_name}}">
              </div>
            </div>

            <div class="form-group">
              <label for="vegetable_desc" class="col-sm-3 control-label">Vegetable Description: </label>
              <div class="col-sm-9">
              <textarea class="form-control" name="vegetable_desc" id="vegetable_desc" multiple="true">{{$vegetables->vegetable_desc}}</textarea>
              </div>
            </div>

                </div>
                <input type="hidden" name="vegetable_id" value="{{$vegetables->vegetable_id}}">
                <div class="box-footer">
                  <button type="submit" onclick="window.location='{{ url("/vegetable") }}'" class="btn btn-primary">Save Change</button>
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
$(document).ready(function(){
  CKEDITOR.replace('vegetable_desc');
  $('#frm-vegetable-edit').on('submit',function(e){
    e.preventDefault();
    console.log('pressed');
    var data = $(this).serialize();
    console.log(data);
    var formData = new FormData($(this)[0]);
    formData.append('vegetable_desc', CKEDITOR.instances.vegetable_desc.getData());

    $.ajax({
      url:"{{route('updateVegetable')}}", 
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
});

</script>
@endsection