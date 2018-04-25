@extends('layout.master') @section('style')
<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.16/css/jquery.dataTables.css"> @endsection @section('content')

<section class="content-header">
  <h1>
    Order
    <small>Control panel</small>
  </h1>

  <ol class="breadcrumb">
    <li>
      <a href="#">
        <i class="fa fa-dashboard"></i>Home</a>
    </li>
    <li class="active">Order</li>
  </ol>
</section>

<div class="modal modal-info fade" id="add-order" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h4 class="modal-title">Add Order</h4>

      </div>
      <div class="modal-body">
        <!-- Custom Tabs (Pulled to the right) -->
        <form action="#" method="POST" id="frm-order-create">
          {!! csrf_field() !!}
          <div class="row">



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
        <li class="active">
          <a href="#tab_1" data-toggle="tab">Active</a>
        </li>
        <li class="pull-right">
          <!-- <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#add-order">Add Order</button> -->
        </li>
      </ul>
      <div class="tab-content">
        <div class="tab-pane active" id="tab_1">
          <div class="box">

            <!-- /.box-header -->
            <div class="box-body no-padding">
              <div class="mailbox-controls">

              </div>
              <div class="table-responsive mailbox-messages">
                <table class="table table-bordered" id="order-table">

                  <thead>

                    <tr class="bg-black">
                      <th class="mailbox-subject">
                        <center>Date</center>
                      </th>
                      <th class="mailbox-subject">
                        <center>Order ID</center>
                      </th>
                      <th class="mailbox-subject">
                        Buyer Name
                      </th>
                      <th class="mailbox-subject">
                        <center>Buyer ID</center>
                      </th>
                      <th class="mailbox-subject">Location</th>
                      <th class="mailbox-subject">Items</th>
                      <th class="mailbox-subject">
                        <center>Item Quantity</center>
                      </th>
                      <th class="mailbox-subject">
                        <center>Total Price</center>
                      </th>
                      <th class="mailbox-subject">
                        <center>Status</center>
                      </th>
                      <th class="mailbox-subject">
                        <center>Operation</center>
                      </th>
                    </tr>
                  </thead>

                  <tbody>
                    @foreach($orders as $order)
                    <tr>
                      <td class="mailbox-subject">
                        <center>{{$order->created_at}}</center>
                      </td>
                      <td class="mailbox-subject">
                        <center>{{$order->id}}</center>
                      </td>
                      <td class="mailbox-subject">
                        {{$order->user->name}}
                      </td>
                      <td class="mailbox-subject">
                        <center>{{$order->user->id}}</center>
                      </td>
                      <td class="mailbox-subject">
                        {{$order->user->address}}
                        <a href="https://www.google.com/maps/search/?api=1&query={{ $order->user->latitude }},{{ $order->user->longitude }}" target="_blank">
                          <i class="fa fa-location-arrow"></i>
                        </a>
                      </td>
                      <td class="mailbox-subject">
                        <ul class="list-inline">
                          @foreach ($order->products as $product)
                          <li>{{ $product->name }} x {{ $product->pivot->quantity }}kg = RM {{ number_format($product->pivot->quantity
                            * $product->latest_price->price_a, 2) }}</li>
                          @endforeach
                        </ul>
                      </td>
                      <td class="mailbox-subject">
                        <center>{{$order->products->count()}}</center>
                      </td>
                      <td class="mailbox-subject">
                        <center>RM {{ number_format($order->total_price, 2) }}</center>
                      </td>
                      <td>
                        <div class="btn-group btn-group-justified" role="group">
                          <a href="" class="btn btn-success">Approve</a>
                          <a href="" class="btn btn-danger">Reject</a>
                        </div>
                      </td>
                      <td class="mailbox-subject">
                        <center>
                          <div class="btn-group btn-group-xs">
                            {{ Form::open(array('url' => 'order/' . $order->id, 'class' => 'pull-right')) }} {{ Form::hidden('_method', 'DELETE') }}
                            <a class="btn btn-success" href="{{route('editOrder', ['order_id'=> $order->order_id])}}">
                              <i class="fa fa-edit"></i> Edit
                            </a>
                            {{ Form::submit('Delete', array('class' => 'btn btn-warning')) }} {{ Form::close() }}
                          </div>
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
@endsection @section('script')
<script type="text/javascript" charset="utf8" src="//cdn.datatables.net/1.10.16/js/jquery.dataTables.js"></script>

<script>
  $(document).ready(function () {
    $('#order-table').DataTable();
    $('#frm-order-create').on('submit', function (e) {
      e.preventDefault();
      console.log('pressed');
      var data = $(this).serialize();
      console.log(data);
      $.post("{{route('createOrder')}}", data, function (response) {
        console.log(response);
        $("[data-dismiss = modal]").trigger({
          type: "click"
        });

      });
    });
  });
</script>
@endsection