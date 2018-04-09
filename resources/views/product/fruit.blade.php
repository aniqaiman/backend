@extends('layout.master') 
@section('style')
@endsection
 
@section('content')

<section class="content-header">
  <h1>
    FRUIT
    <small>Control panel</small>
  </h1>

  <ol class="breadcrumb">
    <li><a href="{{route('dashboard')}}"><i class="fa fa-dashboard"></i>Home</a></li>
    <li class="active">Fruit</li>
  </ol>
</section>


<div class="modal modal-info fade" id="add-product" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Add Fruit</h4>
      </div>

      <form action="#" method="POST" id="frm-product-create" enctype="multipart/form-data" class="form-horizontal">
        <div class="modal-body">
          <!-- Custom Tabs (Pulled to the right) -->
          {!! csrf_field() !!}

          <div class="form-group">
            <label for="product_image" class="col-sm-3 control-label">Fruit Image: </label>
            <div class="col-sm-9">
              <input type="file" class="form-control" name="product_image" id="product_image" required/>
            </div>
          </div>

          <div class="form-group">
            <label for="product_name" class="col-sm-3 control-label">Fruit Name: </label>
            <div class="col-sm-9">
              <input type="text" class="form-control" name="product_name" id="product_name" required/>
            </div>
          </div>

          <div class="form-group">
            <label for="quantity" class="col-sm-3 control-label">Fruit Quantity: </label>
            <div class="col-sm-9">
              <input type="number" class="form-control" name="quantity" id="quantity" min="1" value="1" required/>
            </div>
          </div>

          <div class="form-group">
            <label for="product_desc" class="col-sm-3 control-label">Fruit Desc: </label>
            <div class="col-sm-9">
              <textarea class="form-control" name="product_desc" id="product_desc" required/></textarea>
            </div>
          </div>

          <div class="form-group">
            <label for="short_desc" class="col-sm-3 control-label">Short Desc: </label>
            <div class="col-sm-9">
              <textarea class="form-control" name="short_desc" id="short_desc" required/></textarea>
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
  <div class="row">
    <div class="col-md-12">
      <div class="box box-info">
        <div class="box-header">
          <h3 class="box-title">Fruit List</h3>
          <!-- tools box -->
          <div class="pull-right box-tools">
            <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#add-product">Add Fruit</button>
          </div>
          <!-- /. tools -->
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <div class="table-responsive">
            <table class="table table-bordered" id="product-table">
              <thead>
                <tr class="bg-black">
                  <th class="mailbox-star">
                    <center>Fruit Image</center>
                  </th>
                  <th class="mailbox-star">
                    <center>Fruit Name</center>
                  </th>
                  <!-- <th class="mailbox-star"><center>Short Description</center></th> -->
                  <!-- <th class="mailbox-star"><center>Latest Price</center></th> -->
                  <th class="mailbox-star">
                    <center>Fruit Quantity</center>
                  </th>
                  <th class="mailbox-star">
                    <center>Operation</center>
                  </th>
                </tr>
              </thead>

              <tbody>
                @foreach($fruits as $fruit)
                <tr>
                  <td class="col-sm-3">
                    <center>
                      <img style="width: 25%" src="{{ env('APP_PHOTO_URL') }}{{$fruit->product_image}}"></a>
                    </center>
                  </td>
                  <td class="mailbox-name">
                    <center>{{$fruit->product_name}}</center>
                  </td>
                  <!-- <td class="mailbox-date"><center>{{$fruit->short_desc}}</center></td> -->
                  <!-- <td class="mailbox-date"><center>{{$fruit->prices}}</center></td> -->
                  <td class="mailbox-date">
                    <center>{{$fruit->quantity}}</center>
                  </td>
                  <td class="mailbox-subject">
                    <center>
                      <div class="btn-group">
                        <a class="button btn btn-success btn-sm" href="{{route('editFruit', ['product_id'=> $fruit->product_id])}}"><i class="fa fa-edit"></i> Edit</a>
                        <a class="button btn btn-primary btn-sm" href="{{route('getFruitDetail', ['product_id'=> $fruit->product_id])}}">
                          <i class="fa fa-eye"></i> Details & Price
                        </a>
                        {{ Form::open(array('url' => 'fruit/' . $fruit->product_id, 'class' => 'pull-right')) }}
                        {{ Form::hidden('_method', 'DELETE') }}
                        {{ Form::submit('Delete', array('class' => 'button btn btn-warning btn-sm')) }}
                        {{ Form::close() }}
                      </div>
                    </center>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
            <!-- /.table -->
          </div>
        </div>
      </div>
      <!-- /.box -->
    </div>
  </div>
</section>
@endsection
 
@section('script')
<script>
  $(document).ready(function()
  {
    $('#product-table').DataTable();

    $('#frm-product-create').on('submit',function(e)
    {
      e.preventDefault();
      console.log('pressed');
      var data = $(this).serialize();

      console.log(data);
      var formData = new FormData($(this)[0]);

      $.ajax({
        url:"{{route('createFruit')}}",
        type: "POST",
        data: formData,
        async: false,
        success: function(response)
        {
          console.log(response);
          $("[data-dismiss = modal]").trigger({type: "click"});
          window.location.href = window.location.href;
        },
        cache: false,
        contentType: false,
        processData: false
      });
    });
  });

</script>
@endsection