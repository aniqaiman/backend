@extends('layout.master') 
@section('style')
@endsection
 
@section('content')

<section class="content-header">
  <h1>
    Order Management
    <small>Trackings</small>
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
          <table class="table table-bordered" id="order-table">
            <thead>
              <tr class="bg-black">
                <th>Date</th>
                <th>Order#</th>
                <th class="text-nowrap">Buyer Name</th>
                <th>Buyer#</th>
                <th>Location</th>
                <th class="text-nowrap">Lorry Assigned</th>
                <th style="width: 1%;">Status</th>
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
                  <div class="btn-group">
                    <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        No Lorry Assigned
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
                <td class="text-nowrap">{{$order->status}}
                  @if ($order->status === 1)
                  <button class="btn btn-success btn-sm" data-id="{{ $order->id }}" data-status="3" data-type="order" onclick="updateStatus(this)">Completed</button>
                  @elseif ($order->status !== 3)
                  <button class="btn btn-success btn-sm" disabled>Completed</button>
                  @endif
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
          <table class="table table-bordered" id="stock-table">
            <thead>
              <tr class="bg-black">
                <th>Date</th>
                <th>Order#</th>
                <th class="text-nowrap">Seller Name</th>
                <th>Seller#</th>
                <th>Location</th>
                <th class="text-nowrap">Lorry Assigned</th>
                <th style="width: 1%;">Status</th>
              </tr>
            </thead>

            <tbody>
              @foreach($stocks as $stock)
              <tr>
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
                  <div class="btn-group">
                    <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        No Lorry Assigned
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
                <td class="text-nowrap">
                  @if ($stock->status === 2)
                  <button class="btn btn-success btn-sm" data-id="{{ $stock->id }}" data-status="3" data-type="stock" onclick="updateStatus(this)">Completed</button>
                  @elseif ($stock->status === 3)
                  <button class="btn btn-success btn-sm" disabled>Completed</button>
                  @endif
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