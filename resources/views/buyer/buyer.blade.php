@extends('layout.master')
@section('style')
<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.16/css/jquery.dataTables.css">
@endsection
@section('content')

<section class="content-header">
  <h1>
    BUYER
    <small>Control panel</small>
  </h1>

  <ol class="breadcrumb">
    <li><a href="{{route('dashboard')}}"><i class="fa fa-dashboard"></i>Home</a></li>
    <li class="active">BUYER</li>
  </ol>
</section>

<div class="modal modal-info fade" id="add-buyer" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Add Buyer</h4>

      </div>
      <div class="modal-body">
        <!-- Custom Tabs (Pulled to the right) -->
        <form action="#" method="POST" id="frm-buyer-create" enctype ="multipart/form-data">
          {!! csrf_field() !!}
          <div class="row">

            <div class="form-group">
              <label for="name" class="col-sm-3 control-label">Owner Name: </label>
              <div class="col-sm-9">
                <input type="text" class="form-control" name="name" id="name" multiple="true">
              </div>
            </div>

            <div class="form-group">
              <label for="company_name" class="col-sm-3 control-label">Company Name: </label>
              <div class="col-sm-9">
                <input type="text" class="form-control" name="company_name" id="company_name" multiple="true">
              </div>
            </div>

            <div class="form-group">
              <label for="company_reg_ic_number" class="col-sm-3 control-label">Reg No./IC No.: </label>
              <div class="col-sm-9">
                <input type="text" class="form-control" name="company_reg_ic_number" id="company_reg_ic_number" multiple="true">
              </div>
            </div>

            <div class="form-group">
              <label for="address" class="col-sm-3 control-label">Company Address: </label>
              <div class="col-sm-9">
                <textarea class="form-control" name="address" id="address"></textarea>
              </div>
            </div>

            <div class="form-group">
              <label for="buss_hour" class="col-sm-3 control-label">Business Hour: </label>
              <div class="col-sm-9">
                <input type="text" class="form-control" name="buss_hour" id="buss_hour" multiple="true">
              </div>
            </div>

            <div class="form-group">
              <label for="phonenumber" class="col-sm-3 control-label">Phone No.: </label>
              <div class="col-sm-9">
                <input type="text" class="form-control" name="phonenumber" id="phonenumber" multiple="true">
              </div>
            </div>

            <div class="form-group">
              <label for="handphone_number" class="col-sm-3 control-label">Handphone No.: </label>
              <div class="col-sm-9">
                <input type="text" class="form-control" name="handphone_number" id="handphone_number" multiple="true">
              </div>
            </div>

            <div class="form-group">
              <label for="email" class="col-sm-3 control-label">Email Address: </label>
              <div class="col-sm-9">
                <input type="text" class="form-control" name="email" id="email" multiple="true">
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
          <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#add-buyer">Add Buyer</button></li>
        </ul>
        <div class="tab-content">
          <div class="tab-pane active" id="tab_1">
            <div class="box">

              <!-- /.box-header -->
              <div class="box-body no-padding">
                <div class="mailbox-controls">

                </div>
                <div class="table-responsive mailbox-messages">
                  <table class="table table-bordered" id="buyer-table">
                   <thead>

                    <tr class="bg-black">
                      <!-- <th class="mailbox-star"><center><a href="#">Owner Name</a></center></th> -->
                      <th class="mailbox-star"><center>Company Name</center></th>
                      <!-- <th class="mailbox-star"><center><a href="#">Company Reg Number</a></center></th> -->
                      <th class="mailbox-star"><center>Company Address</center></th>
                      <th class="mailbox-star"><center>Business Hour</center></th>
                      <th class="mailbox-star"><center>Handphone Number</center></th>
                      <th class="mailbox-subject"><center>Operation</center></th>
                      
                    </tr>
                  </thead>
                  
                  <tbody>
                    @foreach($buyers as $buyer) 
                    <tr>
                      <!-- <td class="mailbox-name"><center><a href="#">{{$buyer->owner_name}}</a></center></td> -->
                      <td class="mailbox-date"><center>{{$buyer->company_name}}</center></td>
                      <!-- <td class="mailbox-date"><center><a href="#">{{$buyer->company_reg_number}}</a></center></td> -->
                      <td class="mailbox-date"><center>{{$buyer->address}}</center></td>
                      <td class="mailbox-date"><center>{{$buyer->buss_hour}}</center></td>
                      <td class="mailbox-date"><center>{{$buyer->handphone_number}}</center></td>
                      <td class="mailbox-subject"><center><div class="btn-group">
                        <a class="button btn btn-success btn-sm" href="{{route('editBuyer', ['user_id'=> $buyer->user_id])}}"><i class="fa fa-edit"></i> Edit</a>
                        <a class="button btn btn-primary btn-sm" href="{{route('editBuyer', ['user_id'=> $buyer->user_id])}}"><i class="fa fa-edit"></i> View</a>
                        {{ Form::open(array('url' => 'buyer/' . $buyer->buyer_id, 'class' => 'pull-right')) }}
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
$(document).ready(function(){
  $('#buyer-table').DataTable();
  // CKEDITOR.replace('address');

  $('#frm-buyer-create').on('submit',function(e){
    e.preventDefault();
    console.log('pressed');
    var data = $(this).serialize();

    console.log(data);
    var formData = new FormData($(this)[0]);
    // formData.append('address', CKEDITOR.instances.address.getData());
   // console.log(CKEDITOR.instances.description.getData());
   $.ajax({
    url:"{{route('createBuyer')}}", 
    type: "POST",
    data: formData,
    async: false,
    success: function(response){
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