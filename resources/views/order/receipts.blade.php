@extends('layout.master') 
@section('style')
@endsection
 
@section('content')

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

<section class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="box box-success">
        <div class="box-header">
          <h3 class="box-title">Order Receipts</h3>
        </div>
        <div class="box-body">
          <table class="table table-bordered" id="order-table" style="width:100%">
            <thead>
              <tr class="bg-black">
                <th>Date</th>
                <th>Order#</th>
                <th class="text-nowrap">Buyer Name</th>
                <th>Buyer#</th>
                <th>Location</th>
                <th>Items</th>
                <th>Total</th>
                <th class="col-xs-1">Status</th>
                <th class="col-xs-1"></th>
              </tr>
            </thead>

            <tbody>
              @foreach($orders as $order)
              <tr>
                <td>{{ $order->created_at }}</td>
                <td>{{ $order->id }}</td>
                <td>{{ $order->user->name }}</td>
                <td>{{ $order->user->id }}</td>
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
                      {{ $product->name }} - {{ $product->pivot->quantity }}kg x RM {{ number_format($product->price_latest->price_a, 2) }} = RM
                      {{ number_format($product->pivot->quantity * $product->price_latest->price_a, 2) }}
                    </li>
                    @endforeach
                  </ul>
                </td>
                <td>
                  <span class="badge">{{ $order->total_quantity }}kg</span>
                  <span class="badge">RM {{ number_format($order->total_price, 2) }}</span>
                </td>
                <td class="text-nowrap">
                  <div class="btn-group-vertical btn-group-sm" role="group">
                    <button class="btn btn-success" data-id="{{ $order->id }}" data-status="1" onclick="updateStatus(this)">Approved</button>
                    <button class="btn btn-danger" data-id="{{ $order->id }}" data-status="2" onclick="updateStatus(this)">Rejected</button>
                  </div>
                </td>
                <td class="text-nowrap">
                  {{ Form::open(array('url' => 'order/' . $order->id, 'class' => 'pull-right')) }} {{ Form::hidden('_method', 'DELETE') }}
                  <div class="btn-group-vertical btn-group-sm">
                    <a class="btn btn-success" href="{{ route('editOrder', ['order_id'=> $order->order_id]) }}">Edit</a>{{
                    Form::submit('Delete', ['class' => 'btn btn-warning']) }}
                  </div>
                  {{ Form::close() }}
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
      <!-- /.box -->
    </div>
  </div>
  <!-- Main content -->
</section>
@endsection
 
@section('script')
<script>
  $(document).ready(function () {
    $('#order-table').DataTable({
      'ordering': false,
      'responsive': true,
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

  function updateStatus(btn) {
    var order = {
      order_id: $(btn).data('id'),
      status: $(btn).data('status')
    }

    $.ajax("{{ route('order.status') }}", {
      data: order,
      dataType: "json",
      error: (jqXHR, textStatus, errorThrown) => {},
      method: "PUT",
      success: (data, textStatus, jqXHR) => {
        window.location.href = window.location.href;
      }
    });
  }

</script>
@endsection