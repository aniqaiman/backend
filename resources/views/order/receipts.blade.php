@extends('layout.master') 
@section('style')
@endsection
 
@section('content')

<section class="content-header">
  <h1>
    Order Management
    <small>Receipts</small>
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
      <div class="box box-success collapsed-box">
        <div class="box-header">
          <h3 class="box-title">Buyer</h3>

          <div class="box-tools pull-right">
            <span class="badge bg-light-blue">{{ $orders->count() }}</span>
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
            </button>
          </div>
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
                <th style="width: 1%;">Status</th>
                <th style="width: 1%;"></th>
              </tr>
            </thead>

            <tbody>
              @foreach($orders as $order)
              <tr id="order_{{ $order->id }}">
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
                  <div class="lead">
                    <span class="label label-default">{{ $order->totalQuantity() }}kg</span>
                    <span class="label label-default">RM {{ number_format($order->totalPrice(), 2) }}</span>
                  </div>
                  <table class="table">
                    @foreach ($order->products as $product)
                    <tr>
                      <td>{{ $product->name }}</td>
                      <td>{{ $product->pivot->quantity }}kg</td>
                      <td>RM {{ number_format($product->priceLatest()->price_a, 2) }}</td>
                      <td>RM {{ number_format($product->pivot->quantity * $product->priceLatest()->price_a, 2) }}</td>
                    </tr>
                    @endforeach
                  </table>
                </td>
                <td class="text-nowrap">
                  <div class="btn-group-vertical btn-group-sm" role="group">
                    <button class="btn btn-success" data-id="{{ $order->id }}" data-status="1" data-type="order" onclick="updateStatus(this)">Approve</button>
                    <button class="btn btn-danger" data-id="{{ $order->id }}" data-status="2" data-type="order" onclick="updateStatus(this)">Reject</button>
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

  <div class="row">
    <div class="col-md-12">
      <div class="box box-success collapsed-box">
        <div class="box-header">
          <h3 class="box-title">Seller</h3>

          <div class="box-tools pull-right">
            <span class="badge bg-light-blue">{{ $stocks->count() }}</span>
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
            </button>
          </div>
        </div>
        <div class="box-body">
          <table class="table table-bordered" id="stock-table" style="width:100%">
            <thead>
              <tr class="bg-black">
                <th>Date</th>
                <th>Stock#</th>
                <th class="text-nowrap">Buyer Name</th>
                <th>Buyer#</th>
                <th>Location</th>
                <th>Items</th>
                <th style="width: 1%;">Status</th>
                <th style="width: 1%;"></th>
              </tr>
            </thead>

            <tbody>
              @foreach($stocks as $stock)
              <tr id="stock_{{ $stock->id }}">
                <td>{{ $stock->created_at }}</td>
                <td>{{ $stock->id }}</td>
                <td>{{ $stock->user->name }}</td>
                <td>{{ $stock->user->id }}</td>
                <td>
                  {{ $stock->user->address }}
                  <a href="https://www.google.com/maps/search/?api=1&query={{ $stock->user->latitude }},{{ $stock->user->longitude }}" target="_blank">
                      <i class="fa fa-map-marker"></i>
                    </a>
                </td>
                <td>
                  <div class="lead">
                    <span class="label label-default">{{ $stock->totalQuantity() }}kg</span>
                    <span class="label label-default">RM {{ number_format($stock->totalPrice(), 2) }}</span>
                  </div>
                  <table class="table">
                    @foreach ($stock->products as $product)
                    <tr>
                      <td>{{ $product->name }}</td>
                      <td>Grade {{ $product->pivot->grade }}</td>
                      <td>{{ $product->pivot->quantity }}kg</td>
                      <td>RM {{ number_format($product->priceLatest()->price_a, 2) }}</td>
                      <td>RM {{ number_format($product->pivot->quantity * $product->priceLatest()->price_a, 2) }}</td>
                    </tr>
                    @endforeach
                  </table>
                </td>
                <td class="text-nowrap">
                  <div class="btn-group-vertical btn-group-sm" role="group">
                    <button class="btn btn-success" data-id="{{ $stock->id }}" data-status="1" data-type="stock" onclick="updateStatus(this)">Approve</button>
                    <button class="btn btn-danger" data-id="{{ $stock->id }}" data-status="2" data-type="stock" onclick="updateStatus(this)">Reject</button>
                  </div>
                </td>
                <td class="text-nowrap">
                  {{ Form::open(array('url' => 'order/' . $stock->id, 'class' => 'pull-right')) }} {{ Form::hidden('_method', 'DELETE') }}
                  <div class="btn-group-vertical btn-group-sm">
                    <a class="btn btn-success" href="{{ route('editOrder', ['order_id'=> $stock->stock_id]) }}">Edit</a>{{
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
</section>
@endsection
 
@section('script')
<script>
  $(document).ready(function () {
    $('#order-table').DataTable({
      'ordering': false,
    });

    $('#stock-table').DataTable({
      'ordering': false,
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
    var data = {
      id: $(btn).data('id'),
      status: $(btn).data('status'),
      type: $(btn).data('type')
    }

    $.ajax("{{ route('order.status') }}", {
      data: data,
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