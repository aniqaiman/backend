@extends('layout.master') @section('style') @endsection @section('content')

<section class="content-header">
  <h1>
    Order Management
  </h1>

  <ol class="breadcrumb">
    <li>
      <a href="{{ route('dashboard') }}">
        <i class="fa fa-dashboard"></i>Dashboard</a>
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
        <h4 class="modal-title" id="myModalLabel">Add Order</h4>
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
  <div class="row">
    <div class="col-md-12">
      <div class="box box-success">
        <div class="box-header">
          <h3 class="box-title">Order Receipt</h3>
        </div>
        <div class="box-body">
          <div class="table-responsive">
            <table class="table table-bordered" id="order-table">
              <thead>
                <tr class="bg-black">
                  <th>
                    <center>Date</center>
                  </th>
                  <th>
                    <center>Order#</center>
                  </th>
                  <th class="text-nowrap">Buyer Name</th>
                  <th>
                    <center>Buyer#</center>
                  </th>
                  <th>Location</th>
                  <th>Items</th>
                  <th>
                    <center>Total</center>
                  </th>
                  <th>
                    <center>Status</center>
                  </th>
                  <th class="text-nowrap">
                    <center>Lorry Assigned</center>
                  </th>
                  <!-- <th></th> -->
                </tr>
              </thead>

              <tbody>
                @foreach($orders as $order)
                <tr>
                  <td>
                    <center>{{ $order->created_at }}</center>
                  </td>
                  <td>
                    <center>{{ $order->id }}</center>
                  </td>
                  <td>
                    {{ $order->user->name }}
                  </td>
                  <td>
                    <center>{{ $order->user->id }}</center>
                  </td>
                  <td>
                    {{ $order->user->address }}
                    <a href="https://www.google.com/maps/search/?api=1&query={{ $order->user->latitude }},{{ $order->user->longitude }}" target="_blank">
                      <i class="fa fa-map-marker"></i>
                    </a>
                  </td>
                  <td>
                    <ul class="list-unstyled">
                      @foreach ($order->products as $product)
                      <li>
                        {{ $product->name }} x {{ $product->pivot->quantity }}kg = RM {{ number_format($product->pivot->quantity * $product->latest_price->price_a,
                        2) }}
                      </li>
                      @endforeach
                    </ul>
                  </td>
                  <td>
                    <center>
                      <span class="badge">{{ $order->total_quantity }}kg</span>
                      <span class="badge">RM {{ number_format($order->total_price, 2) }}</span>
                    </center>
                  </td>
                  <td class="text-nowrap">
                    <center>
                      <div class="btn-group-vertical btn-group-sm" role="group">
                        <a href="" class="btn btn-success">Approve</a>
                        <a href="" class="btn btn-danger">Reject</a>
                      </div>
                    </center>
                  </td>
                  <td>
                    <div class="btn-group">
                      <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Assign Lorry
                        <span class="caret"></span>
                      </button>
                      <ul class="dropdown-menu">
                        <li>
                          <a href="#">Lorry 1</a>
                        </li>
                        <li>
                          <a href="#">Lorry 2</a>
                        </li>
                        <li>
                          <a href="#">Lorry 3</a>
                        </li>
                        <li>
                          <a href="#">Lorry 4</a>
                        </li>
                        <li>
                          <a href="#">Lorry 5</a>
                        </li>
                      </ul>
                    </div>
                  </td>
                  <!-- <td class="text-nowrap">
                    <center>
                      {{ Form::open(array('url' => 'order/' . $order->id, 'class' => 'pull-right')) }} {{ Form::hidden('_method', 'DELETE') }}
                      <div class="btn-group-vertical btn-group-sm">
                        <a class="btn btn-success" href="{{ route('editOrder', ['order_id'=> $order->order_id]) }}">Edit</a>                        {{ Form::submit('Delete', ['class' => 'btn btn-warning']) }} {{ Form::close() }}
                      </div>
                    </center>
                  </td> -->
                </tr>
                @endforeach

              </tbody>
            </table>
          </div>
        </div>
      </div>
      <!-- /.box -->
    </div>
  </div>
  <!-- Main content -->
</section>
@endsection @section('script')
<script>
  $(document).ready(function () {
    $('#order-table').DataTable({
      "ordering": false
    });

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