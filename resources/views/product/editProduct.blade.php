@extends('layout.master')
@section('style')
@endsection
@section('content')

<section class="content-header">
  <h1>
    PRODUCT
    <small>Control Panel</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i>Home</a></li>
    <li class="active">Product</li>
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
              <label for="product_image" class="col-sm-3 control-label">Product Image: </label>
              <div class="col-sm-9">
                <input type="file" class="form-control" name="product_image" id="product_image" value="{{$products->product_image}}">
              </div>
            </div>

            <div class="form-group">
              <label for="product_price" class="col-sm-3 control-label">Product Price: </label>
              <div class="col-sm-9">
                <input type="text" class="form-control" name="product_price" id="product_price" value="{{$products->product_price}}">
              </div>
            </div>

            <div class="form-group">
              <label for="product_name" class="col-sm-3 control-label">Product Name: </label>
              <div class="col-sm-9">
                <input type="text" class="form-control" name="product_name" id="product_name" value="{{$products->product_name}}">
              </div>
            </div>

            <div class="form-group">
                    <label for="category" class="col-sm-3 control-label">Category: </label>
                    <div class="col-sm-9">
                      <select class="form-control" name="category" id="category" data-placeholder="Select " style="width: 100%;">
                      @foreach($categories as $category)
                          @if ($category->cat_id === $products->category)
                             <option value="{{$category->cat_id}}" selected="selected">{{$category->cat_name}}</option>
                          @else
                          <option value="{{$category->cat_id}}">{{$category->cat_name}}</option>
                          @endif
                            @endforeach
                          </select>
                    </div>
                  </div>

            <div class="form-group">
              <label for="product_desc" class="col-sm-3 control-label">Product Desc: </label>
              <div class="col-sm-9">
              <textarea class="form-control" name="product_desc" id="product_desc">{{$products->product_desc}}</textarea>
              </div>
            </div>

                </div>
                <input type="hidden" name="product_id" value="{{$products->product_id}}">
                <div class="box-footer">
                  <button type="submit" onclick="window.location='{{ url("/product") }}'" class="btn btn-primary">Save Change</button>
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
      url:"{{route('updateProduct')}}", 
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