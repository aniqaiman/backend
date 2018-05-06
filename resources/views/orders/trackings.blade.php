@extends('layout.master') @section('style') @endsection @section('content')
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h4 class="modal-title" id="exampleModalLabel">Title</h4>
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
            <tr>
              <td></td>
              <td></td>
              <td class="text-center" nowrap> kg</td>
              <td class="text-center" nowrap>RM</td>
              <td class="text-center" nowrap></td>
            </tr>
          </tbody>
        </table>
      </div>
      <div class="modal-footer">
        <span class="float-left">
          <span class="badge badge-secondary" *ngIf="selectedOrder.status === 0">Order Submitted</span>
          <span class="badge badge-info" *ngIf="isToday(selectedOrder) && selectedOrder.status === 1">Order Approved</span>
          <span class="badge badge-warning" *ngIf="!isToday(selectedOrder) && selectedOrder.status === 1">Order Pending</span>
          <span class="badge badge-danger" *ngIf="selectedOrder.status === 2">Order Rejected</span>
          <span class="badge badge-success" *ngIf="selectedOrder.status === 3">Order Completed</span>
        </span>
        <h3 class="text-right">
          Total:
          <span class="badge badge-dark">RM 000.00</span>
        </h3>
      </div>
    </div>
  </div>
</div>

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
            <button type="button" class="btn btn-box-tool" data-widget="collapse">
              <i class="fa fa-minus"></i>
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
                <th style="width: 1%;"></th>
              </tr>
            </thead>

            <tbody>
              @foreach($orders as $order)
              <tr>
                <td>{{ $order->created_at }}</td>
                <td>
                  <a href="#" data-id="{{ $order->id }}" data-type="order" data-date="{{ $order->created_at }}" data-toggle="modal" data-target="#exampleModal">
                    {{ $order->id }}
                  </a>
                </td>
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
                <td>
                  @if ($order->status === 1)
                  <span class="label label-warning">Pending</span>
                  @elseif ($order->status === 3)
                  <span class="label label-success">Completed</span>
                  @endif
                </td>
                <td>
                  @if ($order->status === 1)
                  <div class="btn-group-vertical btn-group-sm">
                    <button class="btn btn-success" data-id="{{ $order->id }}" data-type="order" onclick="completeOrderStock(this)">Completed</button>
                    <button class="btn btn-warning" disabled>Pending</button>
                  </div>
                  @elseif ($order->status === 3)
                  <div class="btn-group-vertical btn-group-sm">
                    <button class="btn btn-success" disabled>Completed</button>
                    <button class="btn btn-warning" data-id="{{ $order->id }}" data-type="order" onclick="pendingOrderStock(this)">Pending</button>
                  </div>
                  @endif
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
    </div>
    <!-- /.box -->
  </div>
  <div class="row">
    <div class="col-md-12">
      <div class="box box-success">
        <div class="box-header">
          <h3 class="box-title">Seller</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse">
              <i class="fa fa-minus"></i>
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
                <th style="width: 1%;"></th>
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
                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
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
                <td>
                  @if ($stock->status === 1)
                  <span class="label label-warning">Pending</span>
                  @elseif ($stock->status === 3)
                  <span class="label label-success">Completed</span>
                  @endif
                </td>
                <td>
                  @if ($stock->status === 1)
                  <div class="btn-group-vertical btn-group-sm">
                    <button class="btn btn-success" data-id="{{ $stock->id }}" data-type="stock" onclick="completeOrderStock(this)">Completed</button>
                    <button class="btn btn-warning" disabled>Pending</button>
                  </div>
                  @elseif ($stock->status === 3)
                  <div class="btn-group-vertical btn-group-sm">
                    <button class="btn btn-success" disabled>Completed</button>
                    <button class="btn btn-warning" data-id="{{ $stock->id }}" data-type="stock" onclick="pendingOrderStock(this)">Pending</button>
                  </div>
                  @endif
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
</section>
@endsection @section('script')
<script>
  $(document).ready(function () {
    $('#exampleModal').on('show.bs.modal', function (event) {
      var button = $(event.relatedTarget);
      var id = button.data('id');
      var date = button.data('date');

      var modal = $(this);
      modal.find('#exampleModalLabel').text(date + ' | ' + id);
      /*modal.find('#feedback-id').val(id);

      var type = button.data('type');
      if (type === 'order') {
        $("#feedback-submit").on("click", rejectBuyerOrder);
      } else if (type === 'stock') {
        $("#feedback-submit").on("click", rejectSellerOrder);
      }*/
    });

    $('#order-table').DataTable({
      'ordering': false,
      'paging': false,
      'info': false,
    });

    $('#stock-table').DataTable({
      'ordering': false,
      'paging': false,
      'info': false,
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

  function completeOrderStock(btn) {
    var data = {
      id: $(btn).data('id'),
      type: $(btn).data('type')
    }

    $.ajax("{{ route('orders.complete') }}", {
      data: data,
      dataType: "json",
      error: (jqXHR, textStatus, errorThrown) => {},
      method: "PUT",
      success: (data, textStatus, jqXHR) => {
        window.location.href = window.location.href;
      }
    });
  }

  function pendingOrderStock(btn) {
    var data = {
      id: $(btn).data('id'),
      type: $(btn).data('type')
    }

    $.ajax("{{ route('orders.pending') }}", {
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