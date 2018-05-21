@extends("layout.master") 
@section("style")
@endsection
 
@section("content") @foreach($orders as $order)
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
              <td>{{ $key + 1 }}</td>
              <td>{{ $product->name }} (Grade {{ $product->pivot->grade }})</td>
              <td class="text-center" nowrap>{{ $product->pivot->quantity }} kg</td>
              <td class="text-center" nowrap>
                @switch($product->pivot->grade) @case("A") RM {{ number_format($product->priceLatest()["buyer_price_a"], 2) }} @break @case("B")
                RM {{ number_format($product->priceLatest()["buyer_price_b"], 2) }} @break @endswitch
              </td>
              <td class="text-center" nowrap>
                @switch($product->pivot->grade) @case("A") RM {{ number_format($product->pivot->quantity * $product->priceLatest()["buyer_price_a"],
                2) }} @break @case("B") RM {{ number_format($product->pivot->quantity * $product->priceLatest()["buyer_price_b"],
                2) }} @break @endswitch
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
@endforeach @foreach($stocks as $stock)
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
              <td>{{ $key + 1 }}</td>
              <td>{{ $product->name }} (Grade {{ $product->pivot->grade }})</td>
              <td class="text-center" nowrap>{{ $product->pivot->quantity }} kg</td>
              <td class="text-center" nowrap>
                @switch($product->pivot->grade) @case("A") RM {{ number_format($product->priceLatest()["buyer_price_a"], 2) }} @break @case("B")
                RM {{ number_format($product->priceLatest()["buyer_price_b"], 2) }} @break @endswitch
              </td>
              <td class="text-center" nowrap>
                @switch($product->pivot->grade) @case("A") RM {{ number_format($product->pivot->quantity * $product->priceLatest()["buyer_price_a"],
                2) }} @break @case("B") RM {{ number_format($product->pivot->quantity * $product->priceLatest()["buyer_price_b"],
                2) }} @break @endswitch
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
    <li>Order Management</li>
    <li class="active">Rejects</li>
  </ol>
</section>

<section class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="nav-tabs-custom">
        <ul class="nav nav-tabs">
          <li class="{{ $order_active }}">
            <a href="#tab_1" data-toggle="tab">Buyer</a>
          </li>
          <li class="{{ $stock_active }}">
            <a href="#tab_2" data-toggle="tab">Supplier</a>
          </li>
        </ul>
        <div class="tab-content clearfix">
          <div class="tab-pane {{ $order_active }}" id="tab_1">
            <div class="table-responsive">
              <table class="table table-bordered" id="order-table" style="width:100%">
                <thead>
                  <tr class="bg-black">
                    <th class="text-center">Date</th>
                    <th class="text-center">Order#</th>
                    <th class="text-nowrap">Buyer Name</th>
                    <th class="text-center">Buyer#</th>
                    <th>Feedback Topic</th>
                    <th>Feedback Description</th>
                    <th>Feedback Response</th>
                    <th class="text-center" style="width: 1%;">Status</th>
                  </tr>
                </thead>

                <tbody>
                  @foreach($orders as $order)
                  <tr>
                    <td class="text-center">{{ $order->created_at }}</td>
                    <td class="text-center">
                      <a href="#" data-toggle="modal" data-target="#order_{{ $order->id }}">
                        {{ $order->id }}
                      </a>
                    </td>
                    <td>{{ $order->user->name }}</td>
                    <td class="text-center">{{ $order->user->id }}</td>
                    <td>{{ $order->feedback->topic }}</td>
                    <td>{{ $order->feedback->description }}</td>
                    <td>
                      @if (empty($stock->feedback->response)) None @else {{ $stock->feedback->response }} @endif
                    </td>
                    <td class="text-center">
                      <span class="label label-danger">Rejected</span>
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>

            <div class="pull-right">
              {{ $orders->links() }}
            </div>
          </div>
            <div class="tab-pane {{ $stock_active }}" id="tab_2">
              <table class="table table-bordered" id="stock-table" style="width:100%">
                <thead>
                  <tr class="bg-black">
                    <th class="text-center">Date</th>
                    <th class="text-center">Stock#</th>
                    <th class="text-nowrap">Supplier Name</th>
                    <th class="text-center">Supplier#</th>
                    <th>Feedback Topic</th>
                    <th>Feedback Description</th>
                    <th>Feedback Response</th>
                    <th class="text-center" style="width: 1%;">Status</th>
                  </tr>
                </thead>

                <tbody>
                  @foreach($stocks as $stock)
                  <tr>
                    <td class="text-center">{{ $stock->created_at }}</td>
                    <td class="text-center">
                      <a href="#" data-toggle="modal" data-target="#stock_{{ $stock->id }}">
                        {{ $stock->id }}
                      </a>
                    </td>
                    <td>{{ $stock->user->name }}</td>
                    <td class="text-center">{{ $stock->user->id }}</td>
                    <td>{{ $stock->feedback_topic }}</td>
                    <td>{{ $stock->feedback_description }}</td>
                    <td>
                      @if (empty($stock->feedback_response)) None @else {{ $stock->feedback_response }} @endif
                    </td>
                    <td class="text-center">
                      <span class="label label-danger">Rejected</span>
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
            <div class="pull-right">
              {{ $stocks->links() }}
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection
 
@section("script")
<script>
  $(document).ready(function () {
    $("#order-table").DataTable({
      'order': [],
      "ordering": true,
      'paging': false,
      'info': false,
    });

    $("#stock-table").DataTable({
      'order': [],
      "ordering": true,
      'paging': false,
      'info': false,
    });

  });

</script>
@endsection