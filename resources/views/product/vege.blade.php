@extends('layout.master')
@section('style')
<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.16/css/jquery.dataTables.css">
@endsection
@section('content')

<section class="content-header">
  <h1>
    VEGETABLE
    <small>Control panel</small>
  </h1>

  <ol class="breadcrumb">
    <li><a href="{{route('dashboard')}}"><i class="fa fa-dashboard"></i>Home</a></li>
    <li class="active">Vegetable</li>
  </ol>
</section>

<div class="modal modal-info fade" id="add-product" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Add Vegetable</h4>

      </div>
      <div class="modal-body">
        <!-- Custom Tabs (Pulled to the right) -->
        <form action="#" method="POST" id="frm-product-create" enctype ="multipart/form-data">
          {!! csrf_field() !!}
          <div class="row">

            <div class="form-group">
              <label for="product_image" class="col-sm-3 control-label">Vege Image: </label>
              <div class="col-sm-9">
                <input type="file" class="form-control" name="product_image" id="product_image" multiple="true">
              </div>
            </div>

            <div class="form-group">
              <label for="product_name" class="col-sm-3 control-label">Vege Name: </label>
              <div class="col-sm-9">
                <input type="text" class="form-control" name="product_name" id="product_name" multiple="true">
              </div>
            </div>

            <div class="form-group">
              <label for="quantity" class="col-sm-3 control-label">Vege Quantity: </label>
              <div class="col-sm-9">
                <input type="text" class="form-control" name="quantity" id="quantity" multiple="true">
              </div>
            </div>

            <div class="form-group">
              <label for="product_desc" class="col-sm-3 control-label">Vege Desc: </label>
              <div class="col-sm-9">
              <textarea class="form-control" name="product_desc" id="product_desc"></textarea>
              </div>
            </div>

            <div class="form-group">
              <label for="short_desc" class="col-sm-3 control-label">Short Desc: </label>
              <div class="col-sm-9">
              <textarea class="form-control" name="short_desc" id="short_desc"></textarea>
              </div>
            </div>


          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Save changes</button>
        </div>
      </form>
    </div>
  </div>
</div>

<section class="content">
  <div class="col-md-12">
    <!-- Custom Tabs (Pulled to the right) -->
    <div class="nav-tabs-custom">
      <ul class="nav nav-tabs ">
        <li class="active"><a href="#tab_1" data-toggle="tab">Active</a></li>
        <li class="pull-right"> 
          <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#add-product">Add Vegetable</button></li>
        </ul>
        <div class="tab-content">
          <div class="tab-pane active" id="tab_1">
            <div class="box">

              <!-- /.box-header -->
              <div class="box-body no-padding">
                <div class="mailbox-controls">

                </div>
                <div class="table-responsive mailbox-messages">
                  <table class="table table-bordered" id="product-table">
                   <thead>

                    <tr class="info bg-white">

                      <th><input type="checkbox"></th>
                      <th class="mailbox-star"><center>Vege Image</center></th>
                      <th class="mailbox-star"><center>Vege Name</center></th>
                      <!-- <th class="mailbox-star"><center>Short Description</center></th> -->
                      <!-- <th class="mailbox-star"><center>Vege Price</center></th> -->
                      <th class="mailbox-star"><center>Vege Quantity</center></th>
                      <th class="mailbox-star"><center>Operation</center></th>

                    </tr>
                  </thead>

                  <tbody>
                    @foreach($vegs as $veg) 
                    <tr class="info">
                      <td><input type="checkbox"></td>
                      <td class="col-sm-3"><center><img style="width: 25%" src="{{ env('APP_PHOTO_URL') }}{{$veg->product_image}}"></a></center></td>
                      <td class="mailbox-name"><center>{{$veg->product_name}}</center></td>
                      <!-- <td class="mailbox-date"><center>{{$veg->short_desc}}</center></td> -->
                      <!-- <td class="mailbox-date"><center>{{$veg->product_price}}</center></td> -->
                      <td class="mailbox-date"><center>{{$veg->quantity}}</center></td>
                      <td class="mailbox-subject"><center><div class="btn-group">
                        <a class="button btn btn-success btn-sm" href="{{route('editVege', ['product_id'=> $veg->product_id])}}"><i class="fa fa-edit"></i> Edit</a>
                        <a class="button btn btn-primary btn-sm" href="{{route('getVegeDetail', ['product_id'=> $veg->product_id])}}"><i class="fa fa-eye"></i> Details & Price</a>
                        {{ Form::open(array('url' => 'vege/' . $veg->product_id, 'class' => 'pull-right')) }}
                        {{ Form::hidden('_method', 'DELETE') }}
                        {{ Form::submit('Delete', array('class' => 'button btn btn-warning btn-sm')) }}
                        {{ Form::close() }}
                      </center>
                    </td>
                  </tr>
                  @endforeach


                </tbody>

              </table>
              <!-- /.table -->
            </div>
            <!-- /.mail-box-messages -->
          </div>
          <!-- /.box-body -->
        </div>
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
<script type="text/javascript" charset="utf8" src="//cdn.datatables.net/1.10.16/js/jquery.dataTables.js"></script>

<script>
  $(document).ready(function()
  {
    $('#product-table').DataTable();
    CKEDITOR.replace('product_desc');

    $('#frm-product-create').on('submit',function(e)
    {
      e.preventDefault();
      console.log('pressed');
      var data = $(this).serialize();

      console.log(data);
      var formData = new FormData($(this)[0]);
   formData.append('product_desc', CKEDITOR.instances.product_desc.getData());
   // console.log(CKEDITOR.instances.description.getData());
   $.ajax(
   {
    url:"{{route('createVege')}}", 
    type: "POST",
    data: formData,
    async: false,
    success: function(response)
    {
      console.log(response);
      $("[data-dismiss = modal]").trigger({type: "click"});
      window.location.reload();
      
    },  
    cache: false,
    contentType: false,
    processData: false
  });
 });
  });

</script>
@endsection 