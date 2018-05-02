@extends('layout.master') 
@section('style')
@endsection
 
@section('content')
<div class="modal modal-danger fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="exampleModalLabel">Title</h4>
      </div>
      <div class="modal-body">
        <form>
          <div class="form-group">
            <label for="recipient-name" class="control-label">Topic:</label>
            <input type="text" class="form-control" id="recipient-name">
          </div>
          <div class="form-group">
            <label for="message-text" class="control-label">Description:</label>
            <textarea class="form-control" id="message-text" rows="3"></textarea>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-outline">Submit Feedback</button>
      </div>
    </div>
  </div>
</div>

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
      <div class="box box-success">
        <div class="box-header">
          <h3 class="box-title">Buyer</h3>

          <div class="box-tools pull-right">
            <span class="badge bg-light-blue">{{ $orders->count() }}</span>
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
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
                      <td>{{ $product->name }} (Grade {{ $product->pivot->grade }})</td>
                      <td>{{ $product->pivot->quantity }}kg</td>
                      <td>
                        @switch($product->pivot->grade)
                          @case("A")
                            RM {{ number_format($product->priceLatest()->price_a, 2) }}
                            @break
                          @case("B")
                            RM {{ number_format($product->priceLatest()->price_b, 2) }}
                            @break
                          @case("B")
                            RM {{ number_format($product->priceLatest()->price_c, 2) }}
                            @break
                        @endswitch
                      </td>
                      <td>
                        @switch($product->pivot->grade)
                          @case("A")
                            RM {{ number_format($product->pivot->quantity * $product->priceLatest()->price_a, 2) }}
                            @break
                          @case("B")
                            RM {{ number_format($product->pivot->quantity * $product->priceLatest()->price_b, 2) }}
                            @break
                          @case("B")
                            RM {{ number_format($product->pivot->quantity * $product->priceLatest()->price_c, 2) }}
                            @break
                        @endswitch
                      </td>
                    </tr>
                    @endforeach
                  </table>
                </td>
                <td>
                  <div class="btn-group-vertical btn-group-sm" role="group">
                    <button class="btn btn-success" data-id="{{ $order->id }}" onclick="approveBuyerOrder(this)">Approved</button>
                    <button class="btn btn-danger" data-id="{{ $order->id }}" data-toggle="modal" data-target="#exampleModal">Rejected</button>
                  </div>
                </td>
                <td>
                  {{ Form::open(array('url' => 'order/' . $order->id, 'class' => 'pull-right')) }} {{ Form::hidden('_method', 'DELETE') }}
                  <div class="btn-group-vertical btn-group-sm">
                    <a class="btn btn-success" href="{{ route('orders.edit', ['order_id'=> $order->order_id]) }}">Edit</a>{{
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
      <div class="box box-success">
        <div class="box-header">
          <h3 class="box-title">Seller</h3>

          <div class="box-tools pull-right">
            <span class="badge bg-light-blue">{{ $stocks->count() }}</span>
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
            </button>
          </div>
        </div>
        <div class="box-body">
          <table class="table table-bordered" id="stock-table" style="width:100%">
            <thead>
              <tr class="bg-black">
                <th>Date</th>
                <th>Stock#</th>
                <th class="text-nowrap">Seller Name</th>
                <th>Seller#</th>
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
                      <td>{{ $product->name }} (Grade {{ $product->pivot->grade }})</td>
                      <td>{{ $product->pivot->quantity }}kg</td>
                      <td>
                        @switch($product->pivot->grade)
                          @case("A")
                            RM {{ number_format($product->priceLatest()->price_a, 2) }}
                            @break
                          @case("B")
                            RM {{ number_format($product->priceLatest()->price_b, 2) }}
                            @break
                          @case("B")
                            RM {{ number_format($product->priceLatest()->price_c, 2) }}
                            @break
                        @endswitch
                      </td>
                      <td>
                        @switch($product->pivot->grade)
                          @case("A")
                            RM {{ number_format($product->pivot->quantity * $product->priceLatest()->price_a, 2) }}
                            @break
                          @case("B")
                            RM {{ number_format($product->pivot->quantity * $product->priceLatest()->price_b, 2) }}
                            @break
                          @case("B")
                            RM {{ number_format($product->pivot->quantity * $product->priceLatest()->price_c, 2) }}
                            @break
                        @endswitch
                      </td>
                    </tr>
                    @endforeach
                  </table>
                </td>
                <td>
                  <div class="btn-group-vertical btn-group-sm" role="group">
                    <button class="btn btn-success" data-id="{{ $stock->id }}" onclick="approveSellerStock(this)">Approved</button>
                    <button class="btn btn-danger" data-id="{{ $stock->id }}" data-toggle="modal" data-target="#exampleModal">Rejected</button>
                  </div>
                </td>
                <td>
                  {{ Form::open(array('url' => 'orders/' . $stock->id, 'class' => 'pull-right')) }} {{ Form::hidden('_method', 'DELETE') }}
                  <div class="btn-group-vertical btn-group-sm">
                    <a class="btn btn-success" href="{{ route('orders.edit', ['order_id'=> $stock->stock_id]) }}">Edit</a>{{
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
    $('#exampleModal').on('show.bs.modal', function (event) {
      var button = $(event.relatedTarget);
      var id = button.data('id');
      var modal = $(this);
      modal.find('#exampleModalLabel').text('Rejected Order Feedback | ' + id);
    });

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
      $.post("{{route('orders.create')}}", data, function (response) {
        console.log(response);
        $("[data-dismiss = modal]").trigger({
          type: "click"
        });

      });
    });
  });

  function approveBuyerOrder(btn) {
    var data = {
      id: $(btn).data('id'),
      status: $(btn).data('status')
    }

    $.ajax("{{ route('orders.buyers.approve') }}", {
      data: data,
      dataType: "json",
      error: (jqXHR, textStatus, errorThrown) => {},
      method: "PUT",
      success: (data, textStatus, jqXHR) => {
        //window.location.href = window.location.href;
      }
    });
  }

  function approveSellerStock(btn) {
    var data = {
      id: $(btn).data('id'),
      status: $(btn).data('status')
    }

    $.ajax("{{ route('orders.sellers.approve') }}", {
      data: data,
      dataType: "json",
      error: (jqXHR, textStatus, errorThrown) => {},
      method: "PUT",
      success: (data, textStatus, jqXHR) => {
        window.location.href = window.location.href;
      }
    });
  }

  function updateStatus(btn) {
    var data = {
      id: $(btn).data('id'),
      status: $(btn).data('status'),
      type: $(btn).data('type')
    }

    $.ajax("{{ route('orders.status') }}", {
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