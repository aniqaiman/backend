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
              <form action="#" method="POST" id="frm-product-edit" enctype ="multipart/form-data">
                {!! csrf_field() !!}
                <div class="row">

                  <div class="form-group">
              <label for="product_image" class="col-sm-3 control-label">Fruit Image: </label>
              <div class="col-sm-9">
                <input type="file" class="form-control" name="product_image" id="product_image" value="{{$fruits->product_image}}">
              </div>
            </div>

            <div class="form-group">
              <label for="quantity" class="col-sm-3 control-label">Fruit Quantity: </label>
              <div class="col-sm-9">
                <input type="text" class="form-control" name="quantity" id="quantity" value="{{$fruits->quantity}}">
              </div>
            </div>

            <div class="form-group">
              <label for="product_name" class="col-sm-3 control-label">Fruit Name: </label>
              <div class="col-sm-9">
                <input type="text" class="form-control" name="product_name" id="product_name" value="{{$fruits->product_name}}">
              </div>
            </div>

            <div class="form-group">
              <label for="product_desc" class="col-sm-3 control-label">Fruit Desc: </label>
              <div class="col-sm-9">
              <textarea class="form-control" name="product_desc" id="product_desc">{{$fruits->product_desc}}</textarea>
              </div>
            </div>

            <div class="form-group">
              <label for="short_desc" class="col-sm-3 control-label">Short Desc: </label>
              <div class="col-sm-9">
              <textarea class="form-control" name="short_desc" id="short_desc">{{$fruits->short_desc}}</textarea>
              </div>
            </div>

                </div>
                <input type="hidden" name="product_id" value="{{$fruits->product_id}}">
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
 <script src="https://cdn.ckeditor.com/4.7.3/standard/ckeditor.js"></script>

<script>
CKEDITOR.replace('product_desc');
  $('#frm-product-edit').on('submit',function(e){
    e.preventDefault();
    console.log('pressed');
    var data = $(this).serialize();
    console.log(data);
    var formData = new FormData($(this)[0]);
    formData.append('product_desc', CKEDITOR.instances.product_desc.getData());

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