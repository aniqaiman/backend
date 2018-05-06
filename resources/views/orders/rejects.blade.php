@extends("layout.master") 
@section("style")
@endsection
 
@section("content")

@foreach($orders as $order)
<div class="modal fade" id="order_{{ $order->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel_{{ $order->id }}">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h4 class="modal-title" id="exampleModalLabel_{{ $order->id }}">{{ $order->created_at }} | {{ $order->id }}</h4>
      </div>
      <div class="modal-body">
        <table class="table table-striped">
          <thead>
            <th>#</th>
            <th>Item</th>
            <th class="text-center">Quantity</th>
            <th class="text-center">Price</th>
            <th class="text-center">Total</th>
          </thead>
          <tbody>
            @foreach ($order->products as $key => $product)
            <tr>
              <td>{{ $key }}</td>
              <td>{{ $product->name }}</td>
              <td class="text-center" nowrap>{{ $product->pivot->quantity }} kg</td>
              <td class="text-center" nowrap>
                @switch($product->pivot->grade) 
                  @case("A") RM {{ number_format($product->priceLatest()->price_a, 2) }} @break
                  @case("B") RM {{ number_format($product->priceLatest()->price_b, 2) }} @break
                  @case("B") RM {{ number_format($product->priceLatest()->price_c, 2) }} @break
                @endswitch
              </td>
              <td class="text-center" nowrap>
                @switch($product->pivot->grade) 
                  @case("A") RM {{ number_format($product->pivot->quantity * $product->priceLatest()->price_a, 2) }} @break
                  @case("B") RM {{ number_format($product->pivot->quantity * $product->priceLatest()->price_b, 2) }} @break
                  @case("B") RM {{ number_format($product->pivot->quantity * $product->priceLatest()->price_c, 2) }} @break
                @endswitch
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
      <div class="modal-footer">
        <span class="pull-left">
          <span class="label label-danger">Rejected</span>
        </span>
        <h3 class="pull-right">
          Total:
          <span class="label label-default">RM {{ number_format($order->totalPrice(), 2) }}</span>
        </h3>
      </div>
    </div>
  </div>
</div>
@endforeach

@foreach($stocks as $stock)
<div class="modal fade" id="stock_{{ $stock->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel_{{ $stock->id }}">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h4 class="modal-title" id="exampleModalLabel_{{ $stock->id }}">{{ $stock->created_at }} | {{ $stock->id }}</h4>
      </div>
      <div class="modal-body">
        <table class="table table-striped">
          <thead>
            <th>#</th>
            <th>Item</th>
            <th class="text-center">Quantity</th>
            <th class="text-center">Price</th>
            <th class="text-center">Total</th>
          </thead>
          <tbody>
            @foreach ($stock->products as $key => $product)
            <tr>
              <td>{{ $key }}</td>
              <td>{{ $product->name }}</td>
              <td class="text-center" nowrap>{{ $product->pivot->quantity }} kg</td>
              <td class="text-center" nowrap>
                @switch($product->pivot->grade) 
                  @case("A") RM {{ number_format($product->priceLatest()->price_a, 2) }} @break
                  @case("B") RM {{ number_format($product->priceLatest()->price_b, 2) }} @break
                  @case("B") RM {{ number_format($product->priceLatest()->price_c, 2) }} @break
                @endswitch
              </td>
              <td class="text-center" nowrap>
                @switch($product->pivot->grade) 
                  @case("A") RM {{ number_format($product->pivot->quantity * $product->priceLatest()->price_a, 2) }} @break
                  @case("B") RM {{ number_format($product->pivot->quantity * $product->priceLatest()->price_b, 2) }} @break
                  @case("B") RM {{ number_format($product->pivot->quantity * $product->priceLatest()->price_c, 2) }} @break
                @endswitch
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
      <div class="modal-footer">
        <span class="pull-left">
          <span class="label label-danger">Rejected</span>
        </span>
        <h3 class="pull-right">
          Total:
          <span class="label label-default">RM {{ number_format($stock->totalPrice(), 2) }}</span>
        </h3>
      </div>
    </div>
  </div>
</div>
@endforeach

<section class="content-header">
  <h1>
    Order Management
    <small>Rejects</small>
  </h1>

  <ol class="breadcrumb">
    <li>
      <a href="{{ route('dashboard') }}">
        <i class="fa fa-dashboard"></i>Dashboard</a>
    </li>
    <li class="active">Order Management</li>
  </ol>
</section>

<section class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="box box-success">
        <div class="box-header">
          <h3 class="box-title">Buyer</h3>

          <div class="box-tools pull-right">
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
                <th>Feedback Topic</th>
                <th>Feedback Description</th>
                <th>Feedback Response</th>
                <th class="text-center" style="width: 1%;">Status</th>
                <th style="width: 1%;"></th>
              </tr>
            </thead>

            <tbody>
              @foreach($orders as $order)
              <tr>
                <td>{{ $order->created_at }}</td>
                <td>
                  <a href="#" data-toggle="modal" data-target="#order_{{ $order->id }}">
                    {{ $order->id }}
                  </a>
                </td>
                <td>{{ $order->user->name }}</td>
                <td>{{ $order->user->id }}</td>
                <td>{{ $order->feedback_topic }}</td>
                <td>{{ $order->feedback_description }}</td>
                <td>
                  @if (empty($stock->feedback_response))
                  None
                  @else
                  {{ $stock->feedback_response }}
                  @endif
                </td>
                <td>
                  <span class="label label-danger">Rejected</span>
                </td>
                <td class="text-center">
                  <button class="btn btn-primary btn-sm" data-id="{{ $order->id }}" onclick="approveBuyerOrder(this)">Approved</button>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>

          <div class="pull-right">
            {{ $orders->links() }}
          </div>
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
                <th>Feedback Topic</th>
                <th>Feedback Description</th>
                <th>Feedback Response</th>
                <th class="text-center" style="width: 1%;">Status</th>
                <th style="width: 1%;"></th>
              </tr>
            </thead>

            <tbody>
              @foreach($stocks as $stock)
              <tr>
                <td>{{ $stock->created_at }}</td>
                <td>
                  <a href="#" data-toggle="modal" data-target="#stock_{{ $stock->id }}">
                    {{ $stock->id }}
                  </a>
                </td>
                <td>{{ $stock->user->name }}</td>
                <td>{{ $stock->user->id }}</td>
                <td>{{ $stock->feedback_topic }}</td>
                <td>{{ $stock->feedback_description }}</td>
                <td>
                  @if (empty($stock->feedback_response))
                  None
                  @else
                  {{ $stock->feedback_response }}
                  @endif
                </td>
                <td>
                  <span class="label label-danger">Rejected</span>
                </td>
                <td class="text-center">
                  <button class="btn btn-primary btn-sm" data-id="{{ $stock->id }}" onclick="approveSellerStock(this)">Approved</button>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>

          <div class="pull-right">
            {{ $stocks->links() }}
          </div>
        </div>
      </div>
    </div>
    <!-- /.box -->
  </div>
  </div>
</section>
@endsection
 
@section("script")
<script>
  $(document).ready(function () {
    $("#order-table").DataTable({
      "ordering": false,
      'paging': false,
      'info': false,
    });

    $("#stock-table").DataTable({
      "ordering": false,
      'paging': false,
      'info': false,
    });

  });

  function approveBuyerOrder(btn) {
    var data = {
      id: $(btn).data('id'),
      status: $(btn).data('status')
    }

    $(btn).prop('disabled', true);
    $(btn).html('<i class="fa fa-spinner fa-spin"></i> Updating...');

    $.ajax("{{ route('orders.buyers.approve') }}", {
      data: data,
      dataType: "json",
      error: (jqXHR, textStatus, errorThrown) => {},
      method: "PUT",
      success: (data, textStatus, jqXHR) => {
        window.location.href = window.location.href;
      }
    });
  }

  function approveSellerStock(btn) {
    var data = {
      id: $(btn).data('id'),
      status: $(btn).data('status')
    }

    $(btn).prop('disabled', true);
    $(btn).html('<i class="fa fa-spinner fa-spin"></i> Updating...');

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

</script>
@endsection