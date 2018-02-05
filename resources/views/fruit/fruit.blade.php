@extends('layout.master')
@section('style')
<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.16/css/jquery.dataTables.css">
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

<div class="modal modal-info fade" id="add-fruit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Add Fruit</h4>

      </div>
      <div class="modal-body">
        <!-- Custom Tabs (Pulled to the right) -->
        <form action="#" method="POST" id="frm-fruit-create" enctype ="multipart/form-data">
          {!! csrf_field() !!}
          <div class="row">

            <div class="form-group">
              <label for="fruit_name" class="col-sm-3 control-label">Fruit Name: </label>
              <div class="col-sm-9">
                <input type="text" class="form-control" name="fruit_name" id="fruit_name" multiple="true">
              </div>
            </div>

            <div class="form-group">
              <label for="fruit_grade" class="col-sm-3 control-label">Fruit Grade: </label>
              <div class="col-sm-9">
                <input type="text" class="form-control" name="fruit_grade" id="fruit_grade" multiple="true">
              </div>
            </div>

            <div class="form-group">
              <label for="fruit_price" class="col-sm-3 control-label">Fruit Price: </label>
              <div class="col-sm-9">
                <input type="text" class="form-control" name="fruit_price" id="fruit_price" multiple="true">
              </div>
            </div>

            <div class="form-group">
              <label for="fruit_image" class="col-sm-3 control-label">Fruit Image: </label>
              <div class="col-sm-9">
                <input type="file" class="form-control" name="fruit_image" id="fruit_image" multiple="true">
              </div>
            </div>

            <div class="form-group">
              <label for="fruit_quantity" class="col-sm-3 control-label">Fruit Quantity: </label>
              <div class="col-sm-9">
                <input type="text" class="form-control" name="fruit_quantity" id="fruit_quantity" multiple="true">
              </div>
            </div>

            <div class="form-group">
              <label for="fruit_harvest_duration" class="col-sm-3 control-label">Fruit Harvest Duration: </label>
              <div class="col-sm-9">
                <input type="text" class="form-control" name="fruit_harvest_duration" id="fruit_harvest_duration" multiple="true">
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
          <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#add-fruit">Add Fruit</button></li>
        </ul>
        <div class="tab-content">
          <div class="tab-pane active" id="tab_1">
            <div class="box">

              <!-- /.box-header -->
              <div class="box-body no-padding">
                <div class="mailbox-controls">

                </div>
                <div class="table-responsive mailbox-messages">
                  <table class="table table-hover table-striped" id="fruit-table">
                   <thead>

                      <tr class="info bg-black">
                      
                        <th><input type="checkbox"></th>
                        <!-- <th class="mailbox-star"><center><a href="#">Driver ID</a></center></th> -->
                        <th class="mailbox-star"><center><a href="#">Fruit Name</a></center></th>
                        <th class="mailbox-star"><center><a href="#">Fruit Grade</a></center></th>
                        <th class="mailbox-star"><center><a href="#">Fruit Price(RM)</a></center></th>
                        <!-- <th class="mailbox-star"><center><a href="#">Fruit Image</a></center></th> -->
                        <th class="mailbox-star"><center><a href="#">Fruit Quantity(KG)</a></center></th>
                        <th class="mailbox-star"><center><a href="#">Fruit Harvest Duration(Month)</a></center></th>
                        <!-- <th class="mailbox-star"><center><a href="#">Fruit</a></center></th> -->
                        <th class="mailbox-subject"><center><a href="#">Operation</a></center></th>
                         
                      </tr>
                       </thead>
                       
                       <tbody>
                      @foreach($fruits as $fruit) 
                      <tr class="info">
                        <td><input type="checkbox"></td>
                        <td class="mailbox-name"><center><a href="#">{{$fruit->fruit_name}}</a></center></td>
                        <td class="mailbox-date"><center><a href="#">{{$fruit->fruit_grade}}</a></center></td>
                        <td class="mailbox-date"><center><a href="#">{{$fruit->fruit_price}}</a></center></td>
                        <!-- <td class="mailbox-date"><center><a href="#">{{$fruit->fruit_image}}</a></center></td> -->
                        <td class="mailbox-date"><center><a href="#">{{$fruit->fruit_quantity}}</a></center></td>
                        <td class="mailbox-date"><center><a href="#">{{$fruit->fruit_harvest_duration}}</a></center></td>
                        <td class="mailbox-subject"><center><div class="btn-group">
                            <a class="button btn btn-success btn-sm" href="#"><i class="fa fa-edit"></i> Edit</a>
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
  <!-- <script src="https://cdn.ckeditor.com/4.7.3/standard/ckeditor.js"></script> -->
  <script type="text/javascript" charset="utf8" src="//cdn.datatables.net/1.10.16/js/jquery.dataTables.js"></script>

  <script>
$(document).ready(function()
{
    $('#fruit-table').DataTable();
    // CKEDITOR.replace('home_address');

    $('#frm-fruit-create').on('submit',function(e)
    {
      e.preventDefault();
      console.log('pressed');
      var data = $(this).serialize();

      console.log(data);
      var formData = new FormData($(this)[0]);
   // formData.append('home_address', CKEDITOR.instances.home_address.getData());
   // console.log(CKEDITOR.instances.description.getData());
      $.ajax(
      {
        url:"{{route('createFruit')}}", 
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